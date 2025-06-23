<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Monitoring Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid d-flex justify-content-between">
        <span class="navbar-brand mb-0 h1">Monitoring Ruangan</span>
        
        <div class="text-light">
            <?php if (session()->has('username')): ?>
                Selamat datang, <strong><?= session('username') ?></strong> |
                <a href="<?= site_url('auth/logout') ?>" class="text-warning text-decoration-none">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>


    <div class="container">
        <?= $this->renderSection('content') ?>
    </div>
</body>
</html>
