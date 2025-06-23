<?= $this->extend('layouts/sidebar') ?>
<?= $this->section('content') ?>

<h4>Selamat Datang, <?= session('username') ?>!</h4>
<p>Ini adalah halaman dashboard admin untuk monitoring penggunaan ruangan.</p>

<div class="row mt-4">
  <div class="col-md-4">
    <div class="card border-primary">
      <div class="card-body">
        <h5 class="card-title">Total Ruangan</h5>
        <p class="card-text display-6"><?= esc($total_rooms) ?></p>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card border-success">
      <div class="card-body">
        <h5 class="card-title">Jadwal Hari Ini</h5>
        <p class="card-text display-6"><?= esc($today_schedules) ?></p>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card border-info">
      <div class="card-body">
        <h5 class="card-title">Total Pengguna</h5>
        <p class="card-text display-6"><?= esc($total_users) ?></p>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
