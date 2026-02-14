<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EcoCarFinder</title>
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
        .register-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }
        .register-header {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 40px;
            text-align: center;
        }
        .register-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        .register-body {
            padding: 40px;
        }
        .form-control:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
        }
        .btn-register {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
        .btn-register:hover {
            background: linear-gradient(135deg, #059669, #047857);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <div class="register-header">
                <i class="fas fa-user-plus register-icon"></i>
                <h2 class="mb-0">Daftar Akun Baru</h2>
                <small>EcoCarFinder</small>
            </div>
            <div class="register-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" class="form-control" name="name" 
                                   placeholder="Masukkan nama lengkap" 
                                   value="{{ old('name') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" name="email" 
                                   placeholder="Masukkan email" 
                                   value="{{ old('email') }}" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control" name="password" 
                                   placeholder="Minimal 6 karakter" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control" name="password_confirmation" 
                                   placeholder="Ulangi password" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-register w-100">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <p class="mb-0">Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #10b981;">
                            Login di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>