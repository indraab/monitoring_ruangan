<?= $this->extend('layouts/sidebar') ?>
<?= $this->section('content') ?>

<style>
  .pln-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid #ccc;
    padding: 10px 20px;
  }
  .pln-logo {
    height: 50px;
  }
  .welcome-box {
    padding: 30px;
    text-align: center;
  }
  .quick-menu .card {
    cursor: pointer;
    transition: 0.3s;
  }
  .quick-menu .card:hover {
    transform: scale(1.05);
  }
</style>

<div class="pln-header bg-light">
  <img src="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" class="pln-logo" alt="PLN Logo Kiri">
  <h4 class="text-center flex-grow-1 mb-0">DASHBOARD ADMIN</h4>
  <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/Logo_PLN.svg" class="pln-logo" alt="PLN Logo Kanan">
</div>

<div class="welcome-box">
  <h3>Selamat Datang, <?= esc(session()->get('username')) ?>!</h3>
  <p class="text-muted">Anda login sebagai <strong><?= esc(session()->get('role')) ?></strong>.</p>
</div>

<div class="container">
  <div class="row quick-menu justify-content-center">
    <div class="col-md-3 mb-3">
      <a href="<?= site_url('schedule?tanggal=' . date('Y-m-d')) ?>" class="text-decoration-none">
        <div class="card text-center border-primary">
          <div class="card-body">
            <div style="font-size: 2rem;">📅</div>
            <h6 class="mt-2">Manajemen Jadwal</h6>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-3 mb-3">
      <a href="<?= site_url('monitoring') ?>" class="text-decoration-none" target="_blank">
        <div class="card text-center border-success">
          <div class="card-body">
            <div style="font-size: 2rem;">👀</div>
            <h6 class="mt-2">Monitoring Publik</h6>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-3 mb-3">
      <a href="<?= site_url('logout') ?>" class="text-decoration-none" onclick="return confirm('Yakin ingin logout?')">
        <div class="card text-center border-danger">
          <div class="card-body">
            <div style="font-size: 2rem;">🚪</div>
            <h6 class="mt-2">Logout</h6>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
