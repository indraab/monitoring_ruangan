<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="60">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monitoring Penggunaan Ruangan - PLN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
    }
    .logo-pln {
      height: 50px;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px 5px;
    }
    .header-title {
      line-height: 1.2;
    }
    .judul-tanggal {
      background-color: #007bff;
      color: white;
      font-weight: bold;
      text-align: center;
      padding: 5px;
      margin: 10px 30px 0;
      border-radius: 3px;
      font-size: 1.2rem;
    }
    .visi-misi {
      background-color: white;
      padding: 10px 15px;
      border: 2px solid #007bff;
      border-radius: 5px;
      margin-bottom: 10px;
    }
    .visi-misi h6 {
      font-weight: bold;
      color: #004481;
    }
    .striped-row:nth-child(odd) {
      background-color: #f2f2f2;
    }
    .table th, .table td {
      vertical-align: middle !important;
    }
    /* Tambahkan ini */
table tbody tr:nth-child(odd) {
  background-color: #ffffff; /* Putih */
}

table tbody tr:nth-child(even) {
  background-color: #f2f2f2; /* Abu terang */
}
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header">
    <img src="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" class="logo-pln" alt="PLN">
    <div class="header-title text-center flex-grow-1">
      <div class="fw-bold">PT PLN (Persero)</div>
      <div class="fw-semibold">Pusat Pendidikan dan Pelatihan</div>
    </div>
    <div class="text-end">
      <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/Logo_PLN.svg" class="logo-pln" alt="PLN Right">
      <div style="font-size: 12px;">Simple, Inspiring, Performing, Phenomenal</div>
    </div>
  </div>

  <!-- Tanggal -->
  <div class="judul-tanggal" id="judulTanggal"></div>

  <!-- Main Content -->
  <div class="container-fluid mt-3 px-4">
    <div class="row">
      <!-- Visi Misi -->
      <div class="col-md-4">
        <div class="visi-misi">
          <h6>Visi</h6>
          <p>Menjadi pusat pendidikan setara kelas dunia dalam menyiapkan insan PLN yang profesional, bersemangat dan berintegritas guna mendukung penciptaan nilai korporasi yang berkelanjutan.</p>
        </div>
        <div class="visi-misi">
          <h6>Misi</h6>
          <p>Mengembangkan, Memelihara dan Meningkatkan kualitas insan PLN melalui penyelenggaraan pembelajaran dan asesmen untuk mewujudkan nilai tambah bagi stakeholder.</p>
        </div>
      </div>

      <!-- Tabel Jadwal -->
      <div class="col-md-8">
        <table class="table table-bordered text-center align-middle">
          <thead class="table-light">
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
      <tr>
        <td><?= date('H:i', strtotime($item['start_time'])) ?> - <?= date('H:i', strtotime($item['end_time'])) ?> WIB</td>
        <td><?= esc($item['notes']) ?></td>
        <td><?= esc($item['room']) ?></td>
        <td><?= esc($item['pic_name']) ?></td>
      </tr>
    <?php endforeach ?>
  <?php else : ?>
    <tr>
      <td colspan="4">Belum ada jadwal untuk hari ini.</td>
    </tr>
  <?php endif ?>
</tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
  function updateTanggal() {
    const now = new Date();
    const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    const namaHari = hari[now.getDay()];
    const tanggal = now.getDate().toString().padStart(2, '0');
    const namaBulan = bulan[now.getMonth()];
    const tahun = now.getFullYear();

    const jam = now.getHours().toString().padStart(2, '0');
    const menit = now.getMinutes().toString().padStart(2, '0');

    const fullTanggal = `${namaHari}, ${tanggal} ${namaBulan} ${tahun} - ${jam}:${menit} WIB`;
    document.getElementById('judulTanggal').textContent = fullTanggal;
  }

  // Jalankan saat halaman dimuat
  updateTanggal();

  // Jalankan ulang setiap 60 detik
  setInterval(updateTanggal, 60000);
</script>



</body>
</html>
