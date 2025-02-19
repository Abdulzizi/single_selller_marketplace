<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Berhasil Direset</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 50px; text-align: center; }
        .container { max-width: 400px; background: white; padding: 20px; border-radius: 8px; margin: auto; }
        a { display: inline-block; margin-top: 10px; padding: 10px 20px; background: #28a745; color: white; text-decoration: none; border-radius: 5px; }
        a:hover { background: #218838; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Password Berhasil Direset</h2>
        <p>Silakan login dengan password baru Anda.</p>
        <a href="{{ env('FRONTEND_URL') }}/login">Kembali ke Login</a>
    </div>
</body>
</html>
