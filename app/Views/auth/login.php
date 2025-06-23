<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - Monitoring Ruangan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .container-fluid {
      height: 100vh;
    }

    .left-panel {
      background-color: #000;
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .left-panel img {
      max-width: 150px;
      margin-bottom: 20px;
    }

    .right-panel {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #fff;
    }

    .login-box {
      width: 100%;
      max-width: 400px;
    }

    .form-control {
      border-radius: 8px;
    }

    .btn-login {
      background-color: #004481;
      color: white;
      font-weight: bold;
    }

    .btn-login:hover {
      background-color: #002f60;
    }

    .input-group-text {
      background-color: #fff;
      border-left: none;
    }

    .input-group .form-control {
      border-right: none;
    }

    .logo-kanan {
      width: 60px;
      display: block;
      margin: 0 auto 20px;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row h-100">
      <!-- KIRI -->
      <div class="col-md-6 left-panel text-center">
        <img src="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" alt="Logo PLN">
        <h2 class="fw-bold mt-3 text-white">MONITORING RUANGAN</h2>
      </div>

      <!-- KANAN -->
      <div class="col-md-6 right-panel">
        <div class="login-box">
          <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/Logo_PLN.svg" alt="Logo PLN Kanan" class="logo-kanan">
          <h4 class="text-center mb-4 fw-bold text-primary">Selamat Datang</h4>

          <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
          <?php endif; ?>

          <form action="<?= site_url('auth/login') ?>" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Email/ID</label>
              <div class="input-group">
                <input type="text" class="form-control" name="username" required>
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
            </div>

            <div class="mb-4">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <input type="password" class="form-control" name="password" required>
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-login">LOGIN</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
