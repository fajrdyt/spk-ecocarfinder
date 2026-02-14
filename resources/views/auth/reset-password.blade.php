<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - EcoCarFinder</title>
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
        .reset-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }
        .reset-header {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 40px;
            text-align: center;
        }
        .reset-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        .reset-body {
            padding: 40px;
        }
        .btn-reset {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="reset-container">
            <div class="reset-header">
                <i class="fas fa-lock-open reset-icon"></i>
                <h2 class="mb-0">Reset Password</h2>
                <small>EcoCarFinder</small>
            </div>
            <div class="reset-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                    </div>
                @endif

                <p class="text-center text-muted mb-4">
                    Masukkan password baru Anda
                </p>

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
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
                    
                    <button type="submit" class="btn btn-primary btn-reset w-100">
                        <i class="fas fa-check-circle me-2"></i>Reset Password
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-decoration-none" style="color: #10b981;">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>