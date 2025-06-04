<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Laporan Servis</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        color: #333;
        margin: 20px;
    }

    h1 {
        text-align: center;
        font-size: 20px;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    thead tr {
        background-color: #2980b9;
        color: white;
        text-align: left;
        font-weight: bold;
    }

    th, td {
        padding: 8px 12px;
        border: 1px solid #ddd;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

    .total {
        font-weight: bold;
        font-size: 14px;
        text-align: right;
        margin-top: 10px;
        border-top: 2px solid #2980b9;
        padding-top: 10px;
    }
</style>

</head>
<body>

    <h1>Laporan Servis Kendaraan</h1>
    <?php if (!empty($_GET['start']) && !empty($_GET['end'])): ?>
    <p style="text-align:center;">
        Periode: <?= date('d-m-Y', strtotime($_GET['start'])) ?> s.d. <?= date('d-m-Y', strtotime($_GET['end'])) ?>
    </p>
    <?php endif; ?>

    <table class="report-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Kendaraan</th>
                        <th>Jenis Servis</th>
                        <th>Total (IDR)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($laporan) && is_array($laporan)): ?>
                        <?php foreach ($laporan as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['tanggal']) ?></td>
                                <td><?= htmlspecialchars($item['nama_pelanggan']) ?></td>
                                <td><?= htmlspecialchars($item['kendaraan']) ?></td>
                                <td><?= htmlspecialchars($item['jenis_servis']) ?></td>
                                <td><?= number_format($item['total'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align:center; font-style:italic; color:#777;">
                                Tidak ada data laporan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
    </table>

            <div class="total">
                Total Pendapatan: Rp <?= isset($total) ? number_format($total, 0, ',', '.') : '0' ?>
            </div>

</body>
</html>
