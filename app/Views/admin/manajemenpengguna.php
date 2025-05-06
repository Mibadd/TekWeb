<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bengkel Admin - Manajemen Pengguna</title>
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
        }
        
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
            flex-direction: column; /* Susunan vertikal */
        }

        .menu-item {
            padding: 15px 20px;
            cursor: pointer;
            color: #333;
            transition: background-color 0.2s;
            border-bottom: 1px solid #f5f5f5;
            text-decoration: none; /* Hilangkan underline */
            display: block; /* Pastikan menu memenuhi lebar penuh */
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
        
        .main-content {
            flex: 1;
            margin-left: 215px;
            padding: 20px;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .page-title {
            font-size: 24px;
            color: #333;
        }
        
        .btn-add {
            background-color: #d32f2f;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        
        .btn-add:hover {
            background-color: #b71c1c;
        }
        
        .btn-add::before {
            content: "+";
            margin-right: 5px;
            font-size: 18px;
        }
        
        .user-table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .user-table th {
            background-color: #f5f5f5;
            text-align: left;
            padding: 12px 15px;
            font-weight: 500;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .user-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .user-table tr:last-child td {
            border-bottom: none;
        }
        
        .action-links {
            display: flex;
            gap: 10px;
        }
        
        .action-links a {
            text-decoration: none;
        }
        
        .edit-link {
            color: #2196f3;
        }
        
        .delete-link {
            color: #d32f2f;
        }
        
        /* Modal styles */
        .modal {
            display: none;
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
            border-radius: 5px;
            width: 500px;
            max-width: 90%;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .modal-title {
            font-size: 18px;
            color: #333;
        }
        
        .close-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #666;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        
        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .form-select {
            width: 100%;
            padding: 8px 12px;
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
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }
        
        .btn-primary {
            background-color: #d32f2f;
            color: white;
        }
        
        .btn-secondary {
            background-color: #f5f5f5;
            color: #333;
            border: 1px solid #ddd;
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
            <a href="<?= base_url('admin/dashboard') ?>" class="menu-item active">Dashboard</a>
            <a href="<?= base_url('admin/manajemenpengguna') ?>" class="menu-item">Manajemen Pengguna</a>
            <a href="<?= base_url('admin/datakendaraan') ?>" class="menu-item">Data Kendaraan</a>
            <a href="<?= base_url('admin/sukucadang') ?>" class="menu-item">Suku Cadang</a>
            <a href="<?= base_url('admin/statistik') ?>" class="menu-item">Statistik</a>
            <a href="<?= base_url('admin/laporan') ?>" class="menu-item">Laporan</a>
            <a href="<?= base_url('admin/logaktivitas') ?>" class="menu-item">Log Aktivitas</a>
        </div>
        <div class="logout">
            Logout
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Manajemen Pengguna</h1>
            <button class="btn-add" id="btnTambahPengguna">Tambah Pengguna</button>
        </div>
        
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
                <tr>
                    <td>Rudi Hartono</td>
                    <td>rudi@example.com</td>
                    <td>Admin</td>
                    <td>
                        <div class="action-links">
                            <a href="#" class="edit-link" onclick="openEditModal('Rudi Hartono', 'rudi@example.com', 'Admin')">Edit</a>
                            <a href="#" class="delete-link" onclick="confirmDelete('Rudi Hartono')">Hapus</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Dina Pratiwi</td>
                    <td>dina@example.com</td>
                    <td>Teknisi</td>
                    <td>
                        <div class="action-links">
                            <a href="#" class="edit-link" onclick="openEditModal('Dina Pratiwi', 'dina@example.com', 'Teknisi')">Edit</a>
                            <a href="#" class="delete-link" onclick="confirmDelete('Dina Pratiwi')">Hapus</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Tambah Pengguna Baru</h2>
                <button class="close-btn" onclick="closeModal('addUserModal')">&times;</button>
            </div>
            <form id="addUserForm">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" class="form-select" required>
                        <option value="">Pilih Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Teknisi">Teknisi</option>
                        <option value="Kasir">Kasir</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="konfirmasi_password">Konfirmasi Password</label>
                    <input type="password" id="konfirmasi_password" class="form-control" required>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addUserModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Pengguna</h2>
                <button class="close-btn" onclick="closeModal('editUserModal')">&times;</button>
            </div>
            <form id="editUserForm">
                <div class="form-group">
                    <label for="edit_nama">Nama</label>
                    <input type="text" id="edit_nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit_email">Email</label>
                    <input type="email" id="edit_email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit_role">Role</label>
                    <select id="edit_role" class="form-select" required>
                        <option value="Admin">Admin</option>
                        <option value="Teknisi">Teknisi</option>
                        <option value="Kasir">Kasir</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_password">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" id="edit_password" class="form-control">
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editUserModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Show modal function
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }
        
        // Close modal function
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
        
        // Open add user modal
        document.getElementById('btnTambahPengguna').addEventListener('click', function() {
            openModal('addUserModal');
        });
        
        // Open edit user modal with pre-filled data
        function openEditModal(nama, email, role) {
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;
            openModal('editUserModal');
        }
        
        // Confirm delete user
        function confirmDelete(nama) {
            if(confirm(`Apakah Anda yakin ingin menghapus pengguna ${nama}?`)) {
                alert(`Pengguna ${nama} telah dihapus.`);
                // In a real app, you would send a request to your backend here
            }
        }
        
        // Form submit handlers
        document.getElementById('addUserForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const nama = document.getElementById('nama').value;
            const email = document.getElementById('email').value;
            const role = document.getElementById('role').value;
            const password = document.getElementById('password').value;
            const konfirmasi = document.getElementById('konfirmasi_password').value;
            
            // Simple validation
            if(password !== konfirmasi) {
                alert('Password dan konfirmasi password tidak sama!');
                return;
            }
            
            // In a real app, you would send this data to your backend
            alert(`Pengguna baru telah ditambahkan:\nNama: ${nama}\nEmail: ${email}\nRole: ${role}`);
            
            // Close modal and reset form
            closeModal('addUserModal');
            this.reset();
        });
        
        document.getElementById('editUserForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const nama = document.getElementById('edit_nama').value;
            const email = document.getElementById('edit_email').value;
            const role = document.getElementById('edit_role').value;
            
            // In a real app, you would send this data to your backend
            alert(`Pengguna telah diupdate:\nNama: ${nama}\nEmail: ${email}\nRole: ${role}`);
            
            // Close modal
            closeModal('editUserModal');
        });
        
        // Active menu item
        document.querySelectorAll('.sidebar-menu li').forEach(item => {
            item.addEventListener('click', () => {
                document.querySelectorAll('.sidebar-menu li').forEach(el => el.classList.remove('active'));
                item.classList.add('active');
            });
        });
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = "none";
            }
        }
    </script>
</body>
</html>