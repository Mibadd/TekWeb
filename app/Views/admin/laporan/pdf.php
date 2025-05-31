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

    <table>
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
            <?php foreach ($laporan as $item): ?>
            <tr>
                <td><?= $item['tanggal'] ?></td>
                <td><?= $item['nama_pelanggan'] ?></td>
                <td><?= $item['kendaraan'] ?></td>
                <td><?= $item['jenis_servis'] ?></td>
                <td><?= number_format($item['total'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total">Total Pendapatan: Rp <?= number_format($total, 0, ',', '.') ?></div>

</body>
</html>
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

    <table>
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
            <?php foreach ($laporan as $item): ?>
            <tr>
                <td><?= $item['tanggal'] ?></td>
                <td><?= $item['nama_pelanggan'] ?></td>
                <td><?= $item['kendaraan'] ?></td>
                <td><?= $item['jenis_servis'] ?></td>
                <td><?= number_format($item['total'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total">Total Pendapatan: Rp <?= number_format($total, 0, ',', '.') ?></div>

</body>
</html>
