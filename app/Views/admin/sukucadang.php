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
            <a href="<?= base_url('auth/logout'); ?>" class="menu-item">Logout</a>
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
                    <select id="filterKategori" name="filter_kategori">
                        <option value="">Semua</option>
                        <option value="Rantai" <?= (isset($_GET['filter_kategori']) && $_GET['filter_kategori'] === 'Rantai') ? 'selected' : '' ?>>Rantai</option>
                        <option value="Gear" <?= (isset($_GET['filter_kategori']) && $_GET['filter_kategori'] === 'Gear') ? 'selected' : '' ?>>Gear</option>
                        <option value="Rem" <?= (isset($_GET['filter_kategori']) && $_GET['filter_kategori'] === 'Rem') ? 'selected' : '' ?>>Rem</option>
                        <option value="Ban" <?= (isset($_GET['filter_kategori']) && $_GET['filter_kategori'] === 'Ban') ? 'selected' : '' ?>>Ban</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="status">Status:</label>
                    <select id="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="menipis">Stok Menipis</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="filterNama">Cari Nama:</label>
                    <input type="text" id="filterNama" name="filter_nama" value="<?= isset($_GET['filter_nama']) ? htmlspecialchars($_GET['filter_nama']) : '' ?>" placeholder="Cari berdasarkan nama suku cadang" />
                </div>
                <button type="submit" class="filter-button">Cari</button>
            </form>

            <!-- Table Data -->
            <table class="sukucadang-table">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($sukucadang)): ?>
            <?php foreach ($sukucadang as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['id']) ?></td>  <!-- Kode -->
                    <td><?= htmlspecialchars($item['nama']) ?></td>  <!-- Nama -->
                    <td><?= htmlspecialchars($item['kategori']) ?></td>  <!-- Kategori -->
                    <td><?= (int)$item['stok'] ?></td>  <!-- Stok -->
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>  <!-- Harga -->
                    <td>
                        <?php
                            $stok = (int)$item['stok'];
                            if ($stok == 0) {
                                echo '<span class="status-habis">Habis</span>';
                            } elseif ($stok <= 5) {
                                echo '<span class="status-menipis">Menipis</span>';
                            } else {
                                echo '<span class="status-tersedia">Tersedia</span>';
                            }
                        ?>
                    </td>
                    <td class="action-buttons">
                        <button class="action-edit" type="button" onclick="editSukuCadang(<?= $item['id'] ?>)">Edit</button>
                        <button class="action-delete" type="button" onclick="deleteSukuCadang(<?= $item['id'] ?>)">Hapus</button>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr><td colspan="7" style="text-align:center; padding:20px;">Data tidak ditemukan.</td></tr>
        <?php endif ?>
    </tbody>
</table>
        </div>
    </div>

    <!-- Modal Tambah Suku Cadang -->
    <div id="modalTambah">
        <div class="modal-content">
            <h3>Tambah Suku Cadang</h3>
<form action="<?= base_url('admin/sukucadang/tambah') ?>" method="POST">
    <label for="kode">Kode:</label>
    <input type="text" id="kode" name="kode" required />

    <label for="namaSukuCadang">Nama Suku Cadang:</label>
    <input type="text" id="namaSukuCadang" name="nama_sukucadang" required />

    <label for="kategoriModal">Kategori:</label>
    <select id="kategoriModal" name="kategori" required>
        <option value="">Pilih kategori</option>
        <option value="Rantai">Rantai</option>
        <option value="Gear">Gear</option>
        <option value="Rem">Rem</option>
        <option value="Ban">Ban</option>
    </select>

    <label for="stok">Stok:</label>
    <input type="number" id="stok" name="stok" min="0" required />

    <label for="harga">Harga (Rp):</label>
    <input type="number" id="harga" name="harga" min="0" required />

    <div class="btn-group">
        <button type="button" id="btnCloseModal">Batal</button>
        <button type="submit">Simpan</button>
    </div>
</form>


        </div>
    </div>

    <!-- Modal Edit Suku Cadang -->
<div id="modalEdit" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
     background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:1000;">
    <div class="modal-content">
        <h3>Edit Suku Cadang</h3>
        <form id="formEdit" action="<?= base_url('admin/sukucadang/edit') ?>" method="POST">
            <input type="hidden" id="editId" name="id">
            
            <label for="editKode">Kode:</label>
            <input type="text" id="editKode" name="kode" required />

            <label for="editNamaSukuCadang">Nama Suku Cadang:</label>
            <input type="text" id="editNamaSukuCadang" name="nama_sukucadang" required />

            <label for="editKategoriModal">Kategori:</label>
            <select id="editKategoriModal" name="kategori" required>
                <option value="">Pilih kategori</option>
                <option value="Rantai">Rantai</option>
                <option value="Gear">Gear</option>
                <option value="Rem">Rem</option>
                <option value="Ban">Ban</option>
            </select>

            <label for="editStok">Stok:</label>
            <input type="number" id="editStok" name="stok" min="0" required />

            <label for="editHarga">Harga (Rp):</label>
            <input type="number" id="editHarga" name="harga" min="0" required />

            <div class="btn-group">
                <button type="button" id="btnCloseEditModal">Batal</button>
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Tambahkan notifikasi untuk menampilkan pesan -->
<?php if (session()->getFlashdata('success')) : ?>
<div id="notification" style="position:fixed; top:20px; right:20px; background:#4CAF50; color:white; 
     padding:15px; border-radius:4px; box-shadow:0 2px 10px rgba(0,0,0,0.1); z-index:9999;">
    <?= session()->getFlashdata('success') ?>
</div>
<script>
    setTimeout(function() {
        document.getElementById('notification').style.display = 'none';
    }, 3000);
</script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
<div id="notification" style="position:fixed; top:20px; right:20px; background:#F44336; color:white; 
     padding:15px; border-radius:4px; box-shadow:0 2px 10px rgba(0,0,0,0.1); z-index:9999;">
    <?= session()->getFlashdata('error') ?>
</div>
<script>
    setTimeout(function() {
        document.getElementById('notification').style.display = 'none';
    }, 3000);
</script>
<?php endif; ?>

<script>
    const modalTambah = document.getElementById('modalTambah');
    const modalEdit = document.getElementById('modalEdit');
    const btnOpenModal = document.getElementById('btnOpenModal');
    const btnCloseModal = document.getElementById('btnCloseModal');
    const btnCloseEditModal = document.getElementById('btnCloseEditModal');

    btnOpenModal.addEventListener('click', () => {
        modalTambah.style.display = 'flex';
    });

    btnCloseModal.addEventListener('click', () => {
        modalTambah.style.display = 'none';
    });
    
    btnCloseEditModal.addEventListener('click', () => {
        modalEdit.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modalTambah) {
            modalTambah.style.display = 'none';
        }
        if (e.target === modalEdit) {
            modalEdit.style.display = 'none';
        }
    });

    function editSukuCadang(id) {
        // Tampilkan modal edit
        modalEdit.style.display = 'flex';
        
        // Ambil data dengan AJAX
        fetch(`<?= base_url('admin/sukucadang/getById') ?>/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Error: ' + data.error);
                    return;
                }
                
                // Isi form dengan data yang diambil
                document.getElementById('editId').value = data.id;
                document.getElementById('editKode').value = data.kode;
                document.getElementById('editNamaSukuCadang').value = data.nama;
                document.getElementById('editKategoriModal').value = data.kategori;
                document.getElementById('editStok').value = data.stok;
                document.getElementById('editHarga').value = data.harga;
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data.');
            });
    }

    function deleteSukuCadang(id) {
        if (confirm('Yakin ingin menghapus suku cadang ini?')) {
            // Redirect ke route hapus
            window.location.href = `<?= base_url('admin/sukucadang/hapus') ?>/${id}`;
        }
    }
</script>
    
</body>
</html>
