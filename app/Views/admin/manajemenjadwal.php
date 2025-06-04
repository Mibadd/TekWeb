<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manajemen Jadwal | Admin GOODBIKE</title>
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
            min-height: 100vh;
            color: #333;
        }

        .sidebar {
            width: 215px;
            height: 100vh;
            background-color: white;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
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
            margin-left: 220px; /* sama dengan lebar sidebar */
            flex: 1;
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            margin-top: 30px;
            margin-bottom: 30px;
            max-width: calc(100vw - 260px);
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .content-header h2 {
            font-weight: 700;
            font-size: 28px;
            color: #222;
        }

        .add-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 22px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: background 0.3s;
        }

        .add-button:hover {
            background-color: #0056b3;
        }

        .service-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 15px;
        }

        .service-table th,
        .service-table td {
            padding: 14px 18px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: middle;
        }

        .service-table th {
            background-color: #ececec;
            color: #000;
            font-weight: 700;
        }

        .service-table tr:hover {
            background-color: #f4f4f9;
        }

        .status-selesai {
            color: green;
            font-weight: 700;
        }

        .status-tertunda {
            color: orange;
            font-weight: 700;
        }

        .status-belum {
            color: red;
            font-weight: 700;
        }

        .action-buttons button {
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
            font-size: 14px;
            margin-right: 10px;
            padding: 5px;
            transition: color 0.2s;
        }

        .action-buttons button:hover {
            color: #007bff;
            text-decoration: underline;
        }

        /* Icon placeholders if font-awesome not loaded */
        .fa {
            margin-right: 6px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>Admin GOODBIKE</h1>
        </div>
        <div class="menu">
            <a href="<?= base_url('admin/dashboard') ?>" class="menu-item ">Dashboard</a>
            <a href="<?= base_url('admin/manajemenpengguna') ?>" class="menu-item">Manajemen Pengguna</a>
            <a href="<?= base_url('admin/manajemenjadwal') ?>" class="menu-item active">Manajemen Jadwal</a>
            <a href="<?= base_url('admin/sukucadang') ?>" class="menu-item">Suku Cadang</a>
            <a href="<?= base_url('admin/laporan') ?>" class="menu-item">Laporan</a>
        </div>
        <div class="logout">
        <a href="<?= base_url('auth/logout'); ?>">Logout</a>
        </div>
    </div>

    <div class="content">
        <div class="content-header">
            <h2>Jadwal Service</h2>
            <button class="add-button" onclick="window.location.href='<?= base_url('manajemenjadwal/add'); ?>'">
                + Tambah Jadwal
            </button>

        </div>

        <table class="service-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis Service</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedules as $schedule) : ?>
                    <tr>
                        <td><?= esc($schedule['date']) ?></td>
                        <td><?= esc($schedule['service_type']) ?></td>
                        <td class="<?php
                            if ($schedule['status'] === 'Selesai') echo 'status-selesai';
                            elseif ($schedule['status'] === 'Tertunda') echo 'status-tertunda';
                            else echo 'status-belum';
                        ?>">
                            <?= esc($schedule['status']) ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button onclick="window.location.href='<?= base_url('manajemenjadwal/edit/' . $schedule['id']) ?>'">
                                    <i class="fa fa-eye"></i> Detail
                                </button>
                                <button onclick="if(confirm('Yakin ingin menghapus jadwal ini?')) window.location.href='<?= base_url('manajemenjadwal/delete/' . $schedule['id']) ?>'">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
