<?= $this->extend('layouts/sidebar') ?>
<?= $this->section('content') ?>

<h4>Manajemen User</h4>

<button class="btn btn-primary mb-3" id="btnAddUser">+ Tambah User</button>

<table class="table table-bordered" id="userTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($users as $user): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($user['username']) ?></td>
            <td><?= esc($user['role']) ?></td>
            <td>
                <button class="btn btn-sm btn-warning btnEditUser" data-id="<?= $user['id'] ?>">Edit</button>
                <a href="<?= site_url('admin/user/delete/' . $user['id']) ?>" onclick="return confirm('Yakin?')" class="btn btn-sm btn-danger">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<!-- Modal User -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formUser" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah / Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="id">
            <div class="mb-2">
                <label>Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <small>Kosongkan jika tidak ingin mengubah password</small>
            </div>
            <div class="mb-2">
                <label>Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="superadmin">Superadmin</option>
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
                </select>
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

<script>
$(document).ready(function() {
    $('#userTable').DataTable();
    var modal = new bootstrap.Modal(document.getElementById('userModal'));

    $('#btnAddUser').click(function() {
        $('#formUser')[0].reset();
        $('#id').val('');
        modal.show();
    });

    $('.btnEditUser').click(function() {
        var id = $(this).data('id');
        $.get('<?= site_url('admin/user/edit') ?>/' + id, function(res) {
            $('#id').val(res.id);
            $('#username').val(res.username);
            $('#role').val(res.role);
            $('#password').val('');
            modal.show();
        });
    });

    $('#formUser').submit(function(e) {
        e.preventDefault();
        $.post('<?= site_url('admin/user/save') ?>', $(this).serialize(), function(res) {
            if (res.status == 'success') {
                location.reload();
            }
        });
    });
});
</script>

<?= $this->endSection() ?>
