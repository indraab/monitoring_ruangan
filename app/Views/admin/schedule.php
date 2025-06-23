<?= $this->extend('layouts/sidebar') ?>
<?= $this->section('content') ?>

<h4>Jadwal Penggunaan Ruangan - <?= date('d M Y', strtotime($tanggal)) ?></h4>

<div class="d-flex justify-content-between align-items-center mb-3">
    <form method="get" class="d-flex gap-2 align-items-center">
        <label for="tanggal" class="form-label mb-0">Pilih Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?= $tanggal ?>" class="form-control" style="width: 200px;">
        <button type="submit" class="btn btn-outline-primary">Tampilkan</button>
    </form>

    <button class="btn btn-primary" id="btnAdd">+ Tambah Jadwal</button>
</div>

<table class="table table-bordered table-striped" id="scheduleTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama PIC</th>
            <th>Ruangan</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Keperluan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($usages as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($row['pic_name']) ?></td>
            <td><?= esc($row['room']) ?></td>
            <td><?= esc($row['start_time']) ?></td>
            <td><?= esc($row['end_time']) ?></td>
            <td><?= esc($row['notes']) ?></td>
            <td>
                <button class="btn btn-sm btn-warning btnEdit" data-id="<?= $row['id'] ?>">Edit</button>
                <button class="btn btn-sm btn-danger btnDelete" data-id="<?= $row['id'] ?>">Hapus</button>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<!-- Modal Form -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formSchedule" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Tambah / Edit Jadwal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- Error alert -->
            <div id="errorAlert" class="alert alert-danger d-none" role="alert"></div>

            <input type="hidden" name="id" id="id">

            <div class="mb-2">
                <label>Nama PIC</label>
                <input type="text" name="pic_name" id="pic_name" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Ruangan</label>
                <select name="room_name" id="room_name" class="form-control" required>
                    <?php foreach ($rooms as $room): ?>
                        <option value="<?= $room['id'] ?>"><?= $room['room_name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-2">
                <label>Tanggal</label>
                <input type="date" name="date" id="date" class="form-control" value="<?= $tanggal ?>" required>
            </div>
            <div class="mb-2">
                <label>Jam Mulai</label>
                <input type="time" name="start_time" id="start_time" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Jam Selesai</label>
                <input type="time" name="end_time" id="end_time" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Keperluan</label>
                <textarea name="notes" id="notes" class="form-control" rows="2"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalDeleteLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus jadwal ini?
        <input type="hidden" id="delete_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="btnConfirmDelete">Hapus</button>
      </div>
    </div>
  </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function () {
    $('#scheduleTable').DataTable();
    var modal = new bootstrap.Modal(document.getElementById('modalForm'));
    var modalDelete = new bootstrap.Modal(document.getElementById('modalDelete'));

    $('#btnAdd').click(function () {
        $('#formSchedule')[0].reset();
        $('#id').val('');
        $('#errorAlert').addClass('d-none').text('');
        modal.show();
    });

    $('.btnEdit').click(function () {
        var id = $(this).data('id');
        $.get('<?= site_url('schedule/get') ?>/' + id, function (res) {
            $('#id').val(res.id);
            $('#pic_name').val(res.pic_name);
            $('#room_name').val(res.room_name);
            $('#start_time').val(res.start_time);
            $('#end_time').val(res.end_time);
            $('#notes').val(res.notes);
            $('#date').val(res.date);
            $('#errorAlert').addClass('d-none').text('');
            modal.show();
        });
    });

    $('.btnDelete').click(function () {
        var id = $(this).data('id');
        $('#delete_id').val(id);
        modalDelete.show();
    });

    $('#btnConfirmDelete').click(function () {
        var id = $('#delete_id').val();
        $.post('<?= site_url('schedule/delete') ?>/' + id, function (res) {
            if (res.status === 'deleted') {
                modalDelete.hide();
                location.reload();
            } else {
                alert('Gagal menghapus jadwal.');
            }
        }).fail(function () {
            alert('Terjadi kesalahan saat menghapus.');
        });
    });

    $('#formSchedule').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?= site_url('schedule') ?>',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (res) {
                if (res.status === 'success') {
                    $('#errorAlert').addClass('d-none').text('');
                    modal.hide();
                    location.reload();
                } else {
                    $('#errorAlert').removeClass('d-none').text(res.message);
                }
            },
            error: function () {
                $('#errorAlert').removeClass('d-none').text('Terjadi kesalahan saat menyimpan.');
            }
        });
    });

    $('#formSchedule input, #formSchedule select, #formSchedule textarea').on('input change', function () {
        $('#errorAlert').addClass('d-none').text('');
    });
});
</script>

<?= $this->endSection() ?>
