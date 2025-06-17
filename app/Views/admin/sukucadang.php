<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Suku Cadang - GOODBIKE</title>
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
        }
        .add-button:hover {
            background-color: #c0392b;
        }
        .sukucadang-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 24px;
        }
        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
            align-items: center;
        }
        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        label {
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }
        input[type="text"], select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            width: 180px;
        }
        .filter-button {
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .filter-button:hover {
            background-color: #1d4ed8;
        }
        .sukucadang-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .sukucadang-table th {
            background-color: #f8fafc;
            text-align: left;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }
        .sukucadang-table td {
            padding: 12px 16px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }
        .sukucadang-table tr:nth-child(even) {
            background-color: #fafafa;
        }
        .status-tersedia {
            color: #047857;
            font-weight: 500;
        }
        .status-menipis {
            color: #b45309;
            font-weight: 500;
        }
        .status-habis {
            color: #b91c1c;
            font-weight: 500;
        }
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        .action-edit {
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 12px;
            cursor: pointer;
        }
        .action-delete {
            background-color: #ef4444;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 12px;
            cursor: pointer;
        }
        .page-item {
            border: 1px solid #ddd;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
            user-select: none;
        }
        .page-item.active {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
        }
        /* Modal Styles */
        #modalTambah {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        #modalTambah .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            position: relative;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        #modalTambah h3 {
            margin-bottom: 16px;
        }
        #modalTambah label {
            font-weight: 600;
            margin-bottom: 4px;
            display: block;
            font-size: 14px;
            color: #333;
        }
        #modalTambah input[type="text"],
        #modalTambah input[type="number"],
        #modalTambah select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 12px;
        }
        #modalTambah .btn-group {
            text-align: right;
        }
        #modalTambah button {
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }
        #modalTambah #btnCloseModal {
            background: #ccc;
            margin-right: 10px;
            color: #333;
        }
        #modalTambah #btnCloseModal:hover {
            background: #b3b3b3;
        }
        #modalTambah button[type="submit"] {
            background: #e74c3c;
            color: white;
        }
        #modalTambah button[type="submit"]:hover {
            background: #c0392b;
        }

        #modalEdit {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
        }

        #modalEdit .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            position: relative;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        #modalEdit h3 {
            margin-bottom: 16px;
        }

        #modalEdit label {
            font-weight: 600;
            margin-bottom: 4px;
            display: block;
            font-size: 14px;
            color: #333;
        }

        #modalEdit input[type="text"],
        #modalEdit input[type="number"],
        #modalEdit select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 12px;
        }

        #modalEdit .btn-group {
            text-align: right;
        }

        #modalEdit button {
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }

        #modalEdit #btnCloseEditModal {
            background: #ccc;
            margin-right: 10px;
            color: #333;
        }

        #modalEdit #btnCloseEditModal:hover {
            background: #b3b3b3;
        }

        #modalEdit button[type="submit"] {
            background: #e74c3c;
            color: white;
        }

        #modalEdit button[type="submit"]:hover {
            background: #c0392b;
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
            <a href="<?= base_url('admin/manajemenpengguna') ?>" class="menu-item ">Manajemen Pengguna</a>
            <a href="<?= base_url('admin/manajemenjadwal') ?>" class="menu-item">Manajemen Jadwal</a>
            <a href="<?= base_url('admin/sukucadang') ?>" class="menu-item active">Suku Cadang</a>
            <a href="<?= base_url('admin/laporan') ?>" class="menu-item">Laporan</a>
        </div>
        <div class="logout">
            <a href="<?= base_url('auth/logout'); ?>" class="btn-logout">Logout</a>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="content-header">
            <h2>Data Suku Cadang</h2>
            <button class="add-button" id="btnOpenModal">Tambah Suku Cadang</button>
        </div>

        <div class="sukucadang-container">
            <!-- Filter -->
            <form method="GET" action="<?= base_url('admin/sukucadang') ?>" class="filter-container">
                <div class="filter-group">
                    <label for="filterKategori">Filter Kategori:</label>
                    <select name="kategori" id="filterKategori">
                        <option value="" <?= (isset($_GET['kategori']) && $_GET['kategori'] == '') ? 'selected' : '' ?>>Semua</option>
                        <option value="mesin" <?= (isset($_GET['kategori']) && $_GET['kategori'] == 'mesin') ? 'selected' : '' ?>>Mesin</option>
                        <option value="body" <?= (isset($_GET['kategori']) && $_GET['kategori'] == 'body') ? 'selected' : '' ?>>Body</option>
                    </select>
                </div>
                <div class="filter-group">
                    <button type="submit" class="filter-button">Terapkan</button>
                </div>
            </form>

            <!-- Tabel Data Suku Cadang -->
            <table class="sukucadang-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sukucadang as $item): ?>
                        <tr>
                            <td><?= esc($item['nama']) ?></td>
                            <td><?= esc($item['kategori']) ?></td>
                            <td><?= esc($item['stok']) ?></td>
                            <td class="<?= $item['stok'] == 0 ? 'status-habis' : ($item['stok'] < 5 ? 'status-menipis' : 'status-tersedia') ?>">
                                <?= $item['stok'] == 0 ? 'Habis' : ($item['stok'] < 5 ? 'Menipis' : 'Tersedia') ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-edit" onclick="openEditModal(<?= $item['id'] ?>)">Edit</button>
                                    <form action="<?= base_url('admin/sukucadang/hapus/' . $item['id']) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="action-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
<div id="modalTambah" class="modal">
    <div class="modal-content">
        <h3>Tambah Suku Cadang</h3>
        <form action="<?= base_url('admin/sukucadang/tambah') ?>" method="post">
            <?= csrf_field() ?>

            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required>

            <label for="kategori">Kategori:</label>
            <input type="text" name="kategori" id="kategori" required>

            <label for="stok">Stok:</label>
            <input type="number" name="stok" id="stok" required min="0">

            <label for="harga">Harga:</label>
            <input type="number" name="harga" id="harga" required min="0">

            <div class="btn-group">
                <button type="button" id="btnCloseModal">Batal</button>
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>


    <!-- Modal Edit (Kosong, akan diisi JS/Controller) -->
    <div id="modalEdit">
        <div class="modal-content">
            <h3>Edit Suku Cadang</h3>
            <form action="<?= base_url('admin/sukucadang/edit') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_id">
                <label for="edit_kode">Kode:</label>
                <input type="text" name="kode" id="edit_kode" required>

                <label for="edit_nama">Nama:</label>
                <input type="text" name="nama_sukucadang" id="edit_nama" required>

                <label for="edit_kategori">Kategori:</label>
                <input type="text" name="kategori" id="edit_kategori" required>

                <label for="edit_stok">Stok:</label>
                <input type="number" name="stok" id="edit_stok" required min="0">

                <div class="btn-group">
                    <button type="button" id="btnCloseEditModal">Batal</button>
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Modal -->
    <script>
        const modalTambah = document.getElementById("modalTambah");
        const modalEdit = document.getElementById("modalEdit");

        document.getElementById("btnOpenModal").addEventListener("click", () => {
            modalTambah.style.display = "flex";
        });

        document.getElementById("btnCloseModal").addEventListener("click", () => {
            modalTambah.style.display = "none";
        });

        document.getElementById("btnCloseEditModal").addEventListener("click", () => {
            modalEdit.style.display = "none";
        });

        function openEditModal(id) {
    const data = <?= json_encode($sukucadang) ?>;
    const item = data.find(i => i.id == id);

    if (item) {
        document.getElementById("edit_id").value = item.id;
        document.getElementById("edit_kode").value = item.kode;
        document.getElementById("edit_nama").value = item.nama;
        document.getElementById("edit_kategori").value = item.kategori;
        document.getElementById("edit_stok").value = item.stok;

        modalEdit.style.display = "flex";
    }
}

    </script>
</body>
</html>
