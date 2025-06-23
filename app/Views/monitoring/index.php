<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="60">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monitoring Ruangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #ffffff;
      overflow: hidden;
    }
    .logo-pln {
      height: 60px;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px 5px;
      border-bottom: 2px solid #ccc;
    }
    .jam-digital {
      font-size: 1.5rem;
      font-weight: bold;
      color: #333;
      text-align: center;
      margin-bottom: 5px;
    }
    .jadwal-container {
      padding: 20px;
      height: 100%;
      overflow-y: auto;
    }
    table {
      font-size: 1.3rem;
    }
    th {
      background-color: #004481;
      color: white;
    }
    .striped-row:nth-child(odd) {
      background-color: #f8f9fa;
    }
    .striped-row:nth-child(even) {
      background-color: #ffffff;
    }
  </style>
</head>
<body onload="masukFullscreen();">

  <!-- HEADER -->
  <div class="header">
    <img src="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" alt="Logo PLN Kiri" class="logo-pln">
    <div class="text-center flex-grow-1">
      <h2 class="mb-1">MONITORING PENGGUNAAN RUANGAN</h2>
      <div class="jam-digital" id="jamDigital">00:00</div>
    </div>
    <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/Logo_PLN.svg" alt="Logo PLN Kanan" class="logo-pln">
  </div>

  <!-- ISI UTAMA -->
  <div class="container-fluid">
    <div class="row" style="height: calc(100vh - 110px);">
      <div class="col-12">
        <div class="jadwal-container">
          <h4 class="text-center mb-4" id="judulTanggal">Jadwal Penggunaan Ruangan</h4>
          <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th>Waktu</th>
                <th>Agenda</th>
                <th>Tempat</th>
                <th>Penyelenggara</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($usages)) : ?>
                <?php foreach ($usages as $item) : ?>
                  <tr class="striped-row">
                    <td><?= date('H:i', strtotime($item['start_time'])) ?> - <?= date('H:i', strtotime($item['end_time'])) ?></td>
                    <td><?= esc($item['notes']) ?></td>
                    <td><?= esc($item['room']) ?></td>
                    <td><?= esc($item['pic_name']) ?></td>
                  </tr>
                <?php endforeach ?>
              <?php else : ?>
                <tr><td colspan="4">Belum ada jadwal untuk hari ini.</td></tr>
              <?php endif ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- JS Jam Digital & Hari -->
  <script>
    function updateJam() {
      const now = new Date();
      const jam = now.getHours().toString().padStart(2, '0');
      const menit = now.getMinutes().toString().padStart(2, '0');
      document.getElementById('jamDigital').textContent = `${jam}:${menit}`;

      const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
      const bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

      const namaHari = hari[now.getDay()];
      const tanggal = now.getDate().toString().padStart(2, '0');
      const namaBulan = bulan[now.getMonth()];
      const tahun = now.getFullYear();

      const fullTanggal = `${namaHari}, ${tanggal} ${namaBulan} ${tahun}`;
      document.getElementById('judulTanggal').textContent = `Jadwal Penggunaan Ruangan - ${fullTanggal}`;
    }

    function masukFullscreen() {
      const elem = document.documentElement;
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.webkitRequestFullscreen) {
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) {
        elem.msRequestFullscreen();
      }
    }

    setInterval(updateJam, 1000);
    updateJam();
  </script>

</body>
</html>
