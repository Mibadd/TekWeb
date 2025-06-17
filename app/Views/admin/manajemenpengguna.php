<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - GOODBIKE</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            display: flex;
            background-color: #f5f5f5;
            height: 100vh;
        }
        
        /* Sidebar Styles - Konsisten dengan dashboard */
        .sidebar {
            width: 215px;
            height: 100vh;
            background-color: white;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
        }

        .logo {
            padding: 20px 0;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
        }

        .logo h1 {
            color: #e74c3c;
            font-size: 20px;
            font-weight: 600;
        }

        .menu {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .menu-item {
            padding: 15px 20px;
            cursor: pointer;
            color: #333;
            transition: background-color 0.2s;
            border-bottom: 1px solid #f5f5f5;
            text-decoration: none;
            display: block;
        }

        .menu-item:hover,
        .menu-item.active {
            background-color: #f8f9fa;
        }
        
        .logout {
            border-top: 1px solid #e0e0e0;
            padding: 15px 20px;
            cursor: pointer;
            color: #333;
        }
        
        /* Content Styles */
        .content {
            flex: 1;
            padding: 30px;
            background-color: #f5f5f7;
            overflow-y: auto;
        }
        
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .content-header h2 {
            font-size: 24px;
            color: #1a3153;
            font-weight: 600;
        }
        
        .add-button {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
        }
        
        .add-button:hover {
            background-color: #c0392b;
        }
        
        .add-button::before {
            content: "+";
            margin-right: 5px;
            font-size: 18px;
        }
        
        .user-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 24px;
        }
        
        .user-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .user-table th {
            background-color: #f8fafc;
            text-align: left;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .user-table td {
            padding: 12px 16px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .user-table tr:nth-child(even) {
            background-color: #fafafa;
        }
        
        .action-links {
            display: flex;
            gap: 10px;
        }
        
        .action-links a {
            text-decoration: none;
        }
        
        .edit-link,
        .delete-link {
            padding: 5px 10px;
            font-size: 12px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            display: inline-block;
            transition: background-color 0.2s ease;
        }

        .edit-link {
            background-color: #2196f3;
            color: white;
        }

        .edit-link:hover {
            background-color: #1976d2;
        }

        .delete-link {
            background-color: #e53935;
            color: white;
        }

        .delete-link:hover {
            background-color: #c62828;
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
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h1>Admin GOODBIKE</h1>
        </div>
        <div class="menu">
            <a href="<?= base_url('admin/dashboard') ?>" class="menu-item">Dashboard</a>
            <a href="<?= base_url('admin/manajemenpengguna') ?>" class="menu-item active">Manajemen Pengguna</a>
            <a href="<?= base_url('admin/manajemenjadwal') ?>" class="menu-item">Manajemen Jadwal</a>
            <a href="<?= base_url('admin/sukucadang') ?>" class="menu-item">Suku Cadang</a>
            <a href="<?= base_url('admin/laporan') ?>" class="menu-item">Laporan</a>
        </div>
        <div class="logout">
            <a href="<?= base_url('auth/logout'); ?>" class="btn-logout">Logout</a>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="content-header">
            <h2>Manajemen Pengguna</h2>
            <a href="<?= base_url('admin/manajemenpengguna/formtambah') ?>" class="add-button">Tambah Pengguna</a>
        </div>

        <div class="user-container">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['name']) ?></td>
                        <td><?= esc($user['email']) ?></td>
                        <td><?= esc($user['role']) ?></td>
                        <td>
                            <div class="action-links">
                                <a href="<?= base_url('admin/manajemenpengguna/formedit/' . $user['id']) ?>" class="edit-link">Edit</a>
                                <a href="#" class="delete-link"
                                   onclick="confirmDelete(this)"
                                   data-id="<?= $user['id'] ?>"
                                   data-name="<?= esc($user['name']) ?>">
                                   Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Buka modal tambah
        document.getElementById('btnTambahPengguna').addEventListener('click', function() {
            openModal('addUserModal');
        });

        // Buka modal edit dan isi data
        function openEditModal(element) {
            document.getElementById('edit_id').value = element.getAttribute('data-id');
            document.getElementById('edit_nama').value = element.getAttribute('data-name');
            document.getElementById('edit_email').value = element.getAttribute('data-email');
            document.getElementById('edit_role').value = element.getAttribute('data-role');
            openModal('editUserModal');
        }

        // Konfirmasi hapus
        function confirmDelete(element) {
            const userId = element.getAttribute('data-id');
            const userName = element.getAttribute('data-name');
            if (confirm(`Apakah Anda yakin ingin menghapus pengguna ${userName}?`)) {
                // Redirect ke controller untuk proses hapus
                window.location.href = "<?= base_url('admin/manajemenpengguna/hapus') ?>/" + userId;
            }
        }
    </script>
</body>
</html>