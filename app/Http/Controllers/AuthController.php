<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\VerificationCodeMail;
use App\Mail\ResetPasswordMail;

class AuthController extends Controller
{
    // ==================== LOGIN ====================
    
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        // Cek apakah user ada
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar.'])->onlyInput('email');
        }

        // Cek apakah email sudah diverifikasi
        if (!$user->hasVerifiedEmail()) {
            return back()->withErrors(['email' => 'Email belum diverifikasi. Silakan cek email Anda.'])->onlyInput('email');
        }

        // Cek password
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['password' => 'Password salah.'])->onlyInput('email');
        }

        // Login berhasil
        Auth::login($user, $request->filled('remember'));
        $request->session()->regenerate();

        return redirect()->intended('dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }

    // ==================== REGISTER ====================
    
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Auto-hashed di model
        ]);

        // Generate dan kirim kode verifikasi
        $code = $user->generateVerificationCode();
        
        try {
            Mail::to($user->email)->send(new VerificationCodeMail($code, $user->name));
            
            return redirect()->route('verification.notice')
                ->with('email', $user->email)
                ->with('success', 'Pendaftaran berhasil! Kode verifikasi telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            // Jika email gagal dikirim, tampilkan kode di halaman (untuk development)
            return redirect()->route('verification.notice')
                ->with('email', $user->email)
                ->with('verification_code', $code)
                ->with('warning', 'Email tidak dapat dikirim. Gunakan kode: ' . $code);
        }
    }

    // ==================== EMAIL VERIFICATION ====================
    
    public function showVerification()
    {
        return view('auth.verify-email');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|size:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('info', 'Email sudah terverifikasi. Silakan login.');
        }

        // Cek kode verifikasi
        if ($user->verification_code !== $request->code) {
            return back()->withErrors(['code' => 'Kode verifikasi salah.']);
        }

        // Cek apakah kode expired
        if ($user->verification_code_expires_at < now()) {
            return back()->withErrors(['code' => 'Kode verifikasi sudah kadaluarsa. Kirim ulang kode baru.']);
        }

        // Verifikasi berhasil
        $user->markEmailAsVerified();

        return redirect()->route('login')->with('success', 'Email berhasil diverifikasi! Silakan login.');
    }

    public function resendVerificationCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('info', 'Email sudah terverifikasi.');
        }

        // Generate kode baru
        $code = $user->generateVerificationCode();

        try {
            Mail::to($user->email)->send(new VerificationCodeMail($code, $user->name));
            return back()->with('success', 'Kode verifikasi baru telah dikirim!');
        } catch (\Exception $e) {
            return back()->with('verification_code', $code)
                ->with('warning', 'Email tidak dapat dikirim. Gunakan kode: ' . $code);
        }
    }

    // ==================== FORGOT PASSWORD ====================
    
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Generate reset token
        $token = $user->generateResetToken();
        $resetUrl = route('password.reset', ['token' => $token]);

        try {
            Mail::to($user->email)->send(new ResetPasswordMail($resetUrl, $user->name));
            return back()->with('success', 'Link reset password telah dikirim ke email Anda!');
        } catch (\Exception $e) {
            return back()->with('warning', 'Email tidak dapat dikirim. Link reset: ' . $resetUrl);
        }
    }

    // ==================== RESET PASSWORD ====================
    
    public function showResetPassword($token)
    {
        $user = User::where('reset_token', $token)
            ->where('reset_token_expires_at', '>', now())
            ->first();

        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Token reset tidak valid atau sudah kadaluarsa.']);
        }

        return view('auth.reset-password', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::where('reset_token', $request->token)
            ->where('reset_token_expires_at', '>', now())
            ->first();

        if (!$user) {
            return back()->withErrors(['error' => 'Token reset tidak valid atau sudah kadaluarsa.']);
        }

        // Update password
        $user->password = $request->password; // Auto-hashed
        $user->reset_token = null;
        $user->reset_token_expires_at = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil direset! Silakan login dengan password baru.');
    }

    // ==================== DASHBOARD ====================
    
    public function dashboard()
    {
        return view('dashboard');
    }
}