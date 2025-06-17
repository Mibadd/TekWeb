<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengguna</title>
    <style>
        /* === CSS MODAL === */
        .modal {
            display: block;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            width: 500px;
            max-width: 90%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eaeaea;
        }

        .modal-title {
            font-size: 18px;
            color: #1a3153;
            font-weight: 600;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #666;
            text-decoration: none;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        .form-control, .form-select {
            width: 95%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background-color: white;
        }

        .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            border: none;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #e74c3c;
            color: white;
        }

        .btn-primary:hover {
            background-color: #c0392b;
        }

        .btn-secondary {
            background-color: #f5f5f5;
            color: #333;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background-color: #e5e5e5;
        }

        .btn-logout {
            background-color: #d32f2f;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: block;
            text-align: center;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-logout:hover {
            background-color: #b62828;
        }
    </style>
</head>
<body>
    <div id="editUserModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Pengguna</h2>
                <a href="<?= base_url('admin/manajemenpengguna') ?>" class="close-btn">&times;</a>
            </div>
            <form id="editUserForm" method="POST" action="<?= base_url('admin/manajemenpengguna/edit') ?>">
                <input type="hidden" id="edit_id" name="id" value="<?= $user['id'] ?? '' ?>">
                
                <div class="form-group">
                    <label for="edit_nama">Nama</label>
                    <input type="text" id="edit_nama" name="name" class="form-control" value="<?= $user['name'] ?? '' ?>" required>
                </div>

                <div class="form-group">
                    <label for="edit_email">Email</label>
                    <input type="email" id="edit_email" name="email" class="form-control" value="<?= $user['email'] ?? '' ?>" required>
                </div>

                <div class="form-group">
                    <label for="edit_role">Role</label>
                    <select id="edit_role" name="role" class="form-select" required>
                        <option value="">Pilih Role</option>
                        <option value="Admin" <?= (isset($user['role']) && $user['role'] == 'Admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="User" <?= (isset($user['role']) && $user['role'] == 'User') ? 'selected' : '' ?>>User</option>
                    </select>
                </div>

                <div class="btn-group">
                    <a href="<?= base_url('admin/manajemenpengguna') ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
