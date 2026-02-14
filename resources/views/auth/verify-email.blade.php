<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - EcoCarFinder</title>
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
        .verify-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }
        .verify-header {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 40px;
            text-align: center;
        }
        .verify-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        .verify-body {
            padding: 40px;
        }
        .code-input {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 10px;
        }
        .btn-verify {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="verify-container">
            <div class="verify-header">
                <i class="fas fa-envelope-circle-check verify-icon"></i>
                <h2 class="mb-0">Verifikasi Email</h2>
                <small>EcoCarFinder</small>
            </div>
            <div class="verify-body">
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

                @if(session('verification_code'))
                    <div class="alert alert-info">
                        <strong>Kode Verifikasi Anda:</strong> {{ session('verification_code') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                    </div>
                @endif

                <p class="text-center mb-4">
                    Masukkan kode verifikasi 6 digit yang telah dikirim ke:<br>
                    <strong>{{ session('email') }}</strong>
                </p>

                <form action="{{ route('verification.verify') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}">
                    
                    <div class="mb-4">
                        <input type="text" class="form-control code-input" name="code" 
                               placeholder="000000" maxlength="6" required 
                               pattern="[0-9]{6}" inputmode="numeric">
                        <small class="text-muted">Kode berlaku selama 15 menit</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-verify w-100">
                        <i class="fas fa-check-circle me-2"></i>Verifikasi
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <p class="mb-2">Tidak menerima kode?</p>
                    <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        <button type="submit" class="btn btn-link text-decoration-none" style="color: #10b981;">
                            <i class="fas fa-rotate me-1"></i>Kirim Ulang Kode
                        </button>
                    </form>
                </div>

                <hr>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-muted text-decoration-none">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>