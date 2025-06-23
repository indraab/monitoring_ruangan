<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header d-flex align-items-center">
      <a class="navbar-brand" href="<?= base_url('dashboard') ?>">
        <img src="<?= base_url('assets/img/brand/logo.png') ?>" class="navbar-brand-img" alt="...">
      </a>
    </div>
    <div class="navbar-inner">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="ni ni-tv-2 text-primary"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('schedule') ?>">
            <i class="ni ni-calendar-grid-58 text-orange"></i>
            <span class="nav-link-text">Jadwal Ruangan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('monitoring') ?>">
            <i class="ni ni-world-2 text-success"></i>
            <span class="nav-link-text">Monitoring Publik</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" href="<?= base_url('logout') ?>">
            <i class="ni ni-button-power"></i>
            <span class="nav-link-text">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
