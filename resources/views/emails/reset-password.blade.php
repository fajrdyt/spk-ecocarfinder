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
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
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
            <h1>🔐 Reset Password</h1>
            <p>EcoCarFinder</p>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $name }}</strong>,</p>
            <p>Kami menerima permintaan untuk reset password akun Anda. Klik tombol di bawah ini untuk membuat password baru:</p>
            
            <div style="text-align: center;">
                <a href="{{ $resetUrl }}" class="button">Reset Password</a>
            </div>
            
            <p><strong>Link ini berlaku selama 1 jam.</strong></p>
            
            <p>Jika Anda tidak meminta reset password, abaikan email ini dan password Anda tidak akan berubah.</p>
            
            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 20px 0;">
            
            <p style="color: #6b7280; font-size: 12px;">
                Jika tombol tidak berfungsi, copy dan paste link berikut ke browser Anda:<br>
                <a href="{{ $resetUrl }}" style="color: #10b981;">{{ $resetUrl }}</a>
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} EcoCarFinder. All rights reserved.
        </div>
    </div>
</body>
</html>