<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EcoCarFinder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #10b981, #059669);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }
        
        .login-left {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 60px 40px;
            text-align: center;
        }
        
        .login-right {
            padding: 60px 40px;
        }
        
        .login-icon {
            font-size: 4rem;
            margin-bottom: 20px;
        }
        
        .form-control:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
        
        .btn-login:hover {
            background: linear-gradient(135deg, #059669, #047857);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="row g-0">
                <div class="col-md-5 login-left">
                    <i class="fas fa-leaf login-icon"></i>
                    <h2 class="mb-3">EcoCarFinder</h2>
                    <p class="mb-0">Sistem Pendukung Keputusan</p>
                    <p>Rekomendasi Kendaraan Ramah Lingkungan</p>
                    <hr style="border-color: rgba(255,255,255,0.3); margin: 30px 0;">
                    <p class="small">Metode Simple Additive Weighting (SAW)</p>
                </div>
                <div class="col-md-7 login-right">
                    <h3 class="mb-4">Login</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            @if($errors->has('email'))
                                {{ $errors->first('email') }}
                            @elseif($errors->has('password'))
                                {{ $errors->first('password') }}
                            @else
                                {{ $errors->first('error') }}
                            @endif
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
                            </div>
                        </div>

                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: #10b981;">
                                Lupa Password?
                            </a>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-login w-100">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="mb-0">Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #10b981;">
                                Daftar Sekarang
                            </a>
                        </p>
                    </div>

                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>