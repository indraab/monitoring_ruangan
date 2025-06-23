<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= esc($title ?? 'Monitoring Ruangan') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      width: 250px;
      height: 100vh;
      background-color: #343a40;
      color: white;
      position: fixed;
      padding: 20px;
    }
    .sidebar a {
      display: block;
      color: white;
      padding: 10px;
      text-decoration: none;
      margin-bottom: 10px;
      border-radius: 4px;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .content {
      margin-left: 270px;
      padding: 20px;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h5>Monitoring Ruangan</h5>
  <a href="<?= site_url('dashboard') ?>">🏠 Dashboard</a>
  <a href="<?= site_url('schedule') ?>">📅 Jadwal Ruangan</a>
  <a href="<?= site_url('monitoring') ?>">👀 Monitoring Publik</a>
  <a href="<?= site_url('auth/logout') ?>" onclick="return confirm('Yakin ingin logout?')">🚪 Logout</a>
</div>

<div class="content">
  <?= $this->renderSection('content') ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</body>
</html>
