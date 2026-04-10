<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 400px;">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title text-center">Login Web</h3>

            <!-- Tempat menampilkan error atau pesan -->
            <div class="alert alert-danger d-none" id="error-message">
                <!-- Pesan error akan di-inject JS -->
            </div>

            <div class="mb-3">
                <label>userName</label>
                <input type="text" class="form-control" placeholder="Masukkan username">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Masukkan password">
            </div>
            <button type="button" class="btn btn-primary w-100">Login</button>
        </div>
    </div>
</div>
</body>
</html>