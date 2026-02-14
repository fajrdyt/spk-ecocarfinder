<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - EcoCarFinder</title>
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
        .forgot-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }
        .forgot-header {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 40px;
            text-align: center;
        }
        .forgot-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        .forgot-body {
            padding: 40px;
        }
        .btn-submit {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="forgot-container">
            <div class="forgot-header">
                <i class="fas fa-key forgot-icon"></i>
                <h2 class="mb-0">Lupa Password?</h2>
                <small>EcoCarFinder</small>
            </div>
            <div class="forgot-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('warning') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                    </div>
                @endif

                <p class="text-center text-muted mb-4">
                    Masukkan email Anda dan kami akan mengirimkan link untuk reset password
                </p>

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" name="email" 
                                   placeholder="Masukkan email Anda" 
                                   value="{{ old('email') }}" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-submit w-100">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Link Reset
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