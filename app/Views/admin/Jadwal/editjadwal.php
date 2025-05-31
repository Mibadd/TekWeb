<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Jadwal | Admin GOODBIKE</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            margin: auto;
        }
        h2 {
            margin-bottom: 20px;
            color: #222;
        }
        label {
            display: block;
            margin: 15px 0 6px;
            font-weight: 600;
        }
        input[type="date"], select, input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
        }
        button {
            margin-top: 25px;
            background-color: #007bff;
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            color: #555;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Jadwal Service</h2>

    <form action="<?= base_url('manajemenjadwal/update/' . $schedule['id']) ?>" method="post">
        <label for="user_id">Pilih User</label>
        <select name="user_id" id="user_id" required>
            <option value="">-- Pilih User --</option>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['id'] ?>" <?= ($schedule['user_id'] == $user['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($user['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="date">Tanggal Service</label>
        <input type="date" id="date" name="date" value="<?= $schedule['date'] ?>" required>

        <label for="service_type">Jenis Service</label>
        <input type="text" id="service_type" name="service_type" value="<?= htmlspecialchars($schedule['service_type']) ?>" required>

        <label for="status">Status</label>
        <select name="status" id="status" required>
            <option value="belum" <?= $schedule['status'] == 'belum' ? 'selected' : '' ?>>Belum Dilaksanakan</option>
            <option value="tertunda" <?= $schedule['status'] == 'tertunda' ? 'selected' : '' ?>>Tertunda</option>
            <option value="selesai" <?= $schedule['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
        </select>

        <button type="submit">Update Jadwal</button>
    </form>

    <a href="<?= base_url('manajemenjadwal') ?>">← Kembali ke Daftar Jadwal</a>
</div>

</body>
</html>
