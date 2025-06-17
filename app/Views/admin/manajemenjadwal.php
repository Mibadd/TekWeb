<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manajemen Jadwal Servis - GOODBIKE</title>
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
            color: #fff;
            text-align: center;
        }
        .logout a {
            color: inherit;
            text-decoration: none;
            font-weight: 600;
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
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .add-button:hover {
            background-color: #c0392b;
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
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .add-button:hover {
            background-color: #c0392b;
        }
        .container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 24px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        thead {
            background-color: #f8f9fa;
        }
        thead th {
            background-color: #f8fafc;
            text-align: left;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }
        tbody tr {
            padding: 12px 16px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }
        tbody tr:nth-child(even) {
            background-color: #fafafa;
        }
        tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        /* Form elements inside table */
        .action-edit {
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 12px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
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
        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        select, input[type="checkbox"] {
            cursor: pointer;
        }
        .checkbox-group label {
            margin-right: 10px;
            user-select: none;
        }
        button.save-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        button.save-btn:hover {
            background-color: #c0392b;
        }

        /* Responsive tweaks */
        @media (max-width: 900px) {
            .content-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .add-button {
                margin-top: 10px;
            }
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            tbody tr {
                border: 1px solid #ddd;
                margin-bottom: 10px;
                border-radius: 8px;
                padding: 15px;
                background-color: white;
            }
            tbody td {
                border: none;
                padding-left: 50%;
                position: relative;
                text-align: left;
            }
            tbody td:before {
                position: absolute;
                top: 12px;
                left: 15px;
                width: 45%;
                white-space: nowrap;
                font-weight: 600;
                color: #1a3153;
            }
            tbody td:nth-of-type(1):before { content: "Jenis Motor"; }
            tbody td:nth-of-type(2):before { content: "Tanggal"; }
            tbody td:nth-of-type(3):before { content: "Jam"; }
            tbody td:nth-of-type(4):before { content: "Jenis Servis"; }
            tbody td:nth-of-type(5):before { content: "Status"; }
            tbody td:nth-of-type(6):before { content: "Suku Cadang"; }
            tbody td:nth-of-type(7):before { content: "Aksi"; }
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
            <a href="<?= base_url('admin/manajemenpengguna') ?>" class="menu-item">Manajemen Pengguna</a>
            <a href="<?= base_url('admin/manajemenjadwal') ?>" class="menu-item active">Manajemen Jadwal</a>
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
            <h2>Manajemen Jadwal Servis</h2>
            <a href="<?= base_url('admin/tambahjadwal') ?>" class="add-button">Tambah Jadwal</a>
        </div>

        <div class="container">
            <?php if (empty($jadwalList)): ?>
                <p>Belum ada jadwal servis.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Jenis Motor</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Jenis Servis</th>
                            <th>Suku Cadang Terpakai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jadwalList as $jadwal): ?>
                            <tr>
                                <td><?= esc($jadwal['jenis_motor']) ?></td>
                                <td><?= esc($jadwal['tanggal']) ?></td>
                                <td><?= esc($jadwal['jam']) ?></td>
                                <td><?= esc($jadwal['jenis_servis']) ?></td>
                                <td>
                                    <?php
                                    $sukucadangList = $sukucadangPerJadwal[$jadwal['id']] ?? [];
                                    if (!empty($sukucadangList)) {
                                        echo implode(', ', array_map('esc', $sukucadangList));
                                    } else {
                                        echo '<i>Tidak ada suku cadang</i>';
                                    }
                                    ?>
                                </td>
                                <td>
                                <?php if (!empty($jadwal['status'])): ?>
                                    <?= esc($jadwal['status']) ?>
                                <?php else: ?>
                                    <i>Belum ditentukan</i>
                                <?php endif; ?>
                                </td>
                                <td class="action-buttons">
                                    <a href="<?= base_url('admin/editjadwal/' . $jadwal['id']) ?>" class="action-edit">Edit</a>
                                    <form action="<?= base_url('admin/hapusjadwal/' . $jadwal['id']) ?>" method="post" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="action-delete" onclick="return confirm('Yakin ingin menghapus jadwal ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>