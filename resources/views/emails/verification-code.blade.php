<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .code-box {
            background: #f0fdf4;
            border: 2px dashed #10b981;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            color: #059669;
            letter-spacing: 8px;
        }
        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌿 EcoCarFinder</h1>
            <p>Verifikasi Email Anda</p>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $name }}</strong>,</p>
            <p>Terima kasih telah mendaftar di EcoCarFinder! Gunakan kode verifikasi berikut untuk mengaktifkan akun Anda:</p>
            
            <div class="code-box">
                <div class="code">{{ $code }}</div>
            </div>
            
            <p><strong>Kode ini berlaku selama 15 menit.</strong></p>
            <p>Jika Anda tidak merasa mendaftar, abaikan email ini.</p>
            
            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 20px 0;">
            
            <p style="color: #6b7280; font-size: 14px;">
                Butuh bantuan? Hubungi kami di support@ecocarfinder.com
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} EcoCarFinder. All rights reserved.
        </div>
    </div>
</body>
</html>