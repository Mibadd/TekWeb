<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Jadwal Servis - GOODBIKE</title>
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
            min-height: 600px;
        }
        /* Sidebar Styles */
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
            text-align: center;
        }
        .logout a {
            color: inherit;
            text-decoration: none;
            font-weight: 600;
        }
        .logout a:hover {
            color: #e74c3c;
        }
        /* Content Styles */
        .content {
            flex: 1;
            padding: 20px 40px;
            background-color: #f5f5f7;
            overflow-y: auto;

            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
        .content > div {
            width: 100%;
            max-width: 900px;
        }
        .content-header {
            margin-bottom: 30px;
            width: 100%;
            text-align: center;
        }
        .content-header h2 {
            font-size: 28px;
            color: #1a3153;
            font-weight: 600;
        }
        /* Form Styles */
        .form-tambah {
            background-color: white;
            padding: 32px 40px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            width: 100%;
            box-sizing: border-box;
        }
        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: 600;
            margin-bottom: 10px;
            color: #1a3153;
            font-size: 16px;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 14px 18px;
            font-size: 16px;
            color: #334155;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 4px rgba(59, 130, 246, 0.5);
        }
        input[type="date"] {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 14px 18px;
            font-size: 16px;
            color: #334155;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }
        input[type="date"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 4px rgba(59, 130, 246, 0.5);
        }
        /* Button group */
        .button-group {
            display: flex-start;
            justify-content: space-between; 
            margin-top: 24px;
            max-width: 320px; 
            width: 100%;
        }
        button.submit-btn {
            background-color: #e74c3c;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 18px;
            padding: 14px 36px;
            cursor: pointer;
            transition: background-color 0.2s;
            min-width: 140px;
        }
        button.submit-btn:hover {
            background-color: #c0392b;
        }
        .cancel-btn {
            background-color: #6b7280;
            color: white;
            border-radius: 8px;
            padding: 14px 36px;
            text-align: center;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-weight: 600;
            font-size: 18px;
            transition: background-color 0.2s;
            min-width: 140px;
        }
        .cancel-btn:hover {
            background-color: #4b5563;
        }
        /* Responsive */
        @media (max-width: 640px) {
            body {
                flex-direction: column;
                height: auto;
            }
            .sidebar {
                width: 100%;
                height: auto;
                flex-direction: row;
                overflow-x: auto;
                border-right: none;
                border-bottom: 1px solid #e0e0e0;
            }
            .logo {
                flex: 1 0 auto;
                padding: 15px 10px;
                border-bottom: none;
                border-right: 1px solid #e0e0e0;
            }
            .menu {
                flex-direction: row;
                flex: 4 0 auto;
                overflow-x: auto;
            }
            .menu-item {
                flex: 0 0 auto;
                padding: 15px 12px;
                border-bottom: none;
                border-right: 1px solid #f5f5f5;
            }
            .logout {
                flex: 0 0 auto;
                border-top: none;
                border-left: 1px solid #e0e0e0;
                padding: 15px 12px;
            }
            .content {
                padding: 20px 15px;
                justify-content: center;
            }
            .form-tambah {
                padding: 24px 20px;
            }
            label {
                font-size: 14px;
            }
            input[type="text"],
            input[type="number"],
            select {
                font-size: 14px;
                padding: 12px 14px;
            }
            button.submit-btn,
            .cancel-btn {
                font-size: 16px;
                padding: 12px 24px;
                min-width: 100px;
            }
            .button-group {
                flex-direction: column;
                gap: 12px;
                margin-top: 20px;
            }
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
            <a href="<?= base_url('admin/manajemenpengguna') ?>" class="menu-item">Manajemen Pengguna</a>
            <a href="<?= base_url('admin/manajemenjadwal') ?>" class="menu-item">Manajemen Jadwal</a>
            <a href="<?= base_url('admin/sukucadang') ?>" class="menu-item active">Suku Cadang</a>
            <a href="<?= base_url('admin/laporan') ?>" class="menu-item">Laporan</a>
        </div>
        <div class="logout">
            <a href="<?= base_url('auth/logout') ?>">Logout</a>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div>
            <div class="content-header">
                <h2>Edit Jadwal Servis</h2>
            </div>
            <form action="<?= site_url('admin/manajemenjadwal/update/' . $jadwal['id']) ?>" method="POST" class="form-tambah">
                <div class="form-group">
                    <label for="jenis_motor">Jenis Motor</label>
                    <select name="jenis_motor" id="jenis_motor" required>
                        <option value="">-- Pilih Kendaraan --</option>
                        <option value="XMAX 250"     <?= $jadwal['jenis_motor'] === 'XMAX 250'    ? 'selected' : '' ?>>XMAX 250</option>
                        <option value="Grand Filano" <?= $jadwal['jenis_motor'] === 'Grand Filano'? 'selected' : '' ?>>Grand Filano</option>
                        <option value="XSR 155"      <?= $jadwal['jenis_motor'] === 'XSR 155'     ? 'selected' : '' ?>>XSR 155</option>
                        <option value="Vixion 155"   <?= $jadwal['jenis_motor'] === 'Vixion 155'  ? 'selected' : '' ?>>Vixion 155</option>
                        <option value="Gear Ultima"  <?= $jadwal['jenis_motor'] === 'Gear Ultima' ? 'selected' : '' ?>>Gear Ultima</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Servis</label>
                    <input type="date" name="tanggal" id="tanggal" required value="<?= esc($jadwal['tanggal']) ?>" />
                </div>
                <div class="form-group">
                    <label for="jam">Jam Servis</label>
                    <select name="jam" id="jam" required>
                        <option value="10:00" <?= $jadwal['jam'] === '10:00' ? 'selected' : '' ?>>10:00</option>
                        <option value="11:00" <?= $jadwal['jam'] === '11:00' ? 'selected' : '' ?>>11:00</option>
                        <option value="12:00" <?= $jadwal['jam'] === '12:00' ? 'selected' : '' ?>>12:00</option>
                        <option value="13:00" <?= $jadwal['jam'] === '13:00' ? 'selected' : '' ?>>13:00</option>
                        <option value="14:00" <?= $jadwal['jam'] === '14:00' ? 'selected' : '' ?>>14:00</option>
                        <option value="15:00" <?= $jadwal['jam'] === '15:00' ? 'selected' : '' ?>>15:00</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis_servis">Jenis Servis</label>
                    <select name="jenis_servis" id="jenis_servis" required>
                        <option value="Reguler" <?= $jadwal['jenis_servis'] === 'Reguler' ? 'selected' : '' ?>>Reguler</option>
                        <option value="Lainnya" <?= $jadwal['jenis_servis'] === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="suku_cadang">Suku Cadang yang Digunakan</label>
                    <?php if (!empty($sukuCadang)) : ?>
                        <?php foreach ($sukuCadang as $sc) : ?>
                            <div>
                                <input
                                    type="checkbox"
                                    name="suku_cadang[]"
                                    value="<?= $sc['id'] ?>"
                                    id="sc_<?= $sc['id'] ?>"
                                    <?= in_array($sc['id'], explode(',', $jadwal['suku_cadang'] ?? '')) ? 'checked' : '' ?>
                                />
                                <label for="sc_<?= $sc['id'] ?>"><?= esc($sc['nama']) ?></label>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Tidak ada suku cadang tersedia.</p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="status">Status Jadwal</label>
                    <select name="status" id="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Tersedia" <?= $jadwal['status'] == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                        <option value="Tidak Tersedia" <?= $jadwal['status'] == 'Tidak Tersedia' ? 'selected' : '' ?>>Tidak Tersedia</option>
                    </select>
                </div>
                <div class="button-group">
                    <a href="<?= base_url('admin/manajemenjadwal') ?>" class="cancel-btn">Batal</a>
                    <button type="submit" class="submit-btn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
