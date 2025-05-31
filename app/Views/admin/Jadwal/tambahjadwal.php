<style>
    form {
        max-width: 450px;
        background: #fff;
        padding: 25px 30px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        margin: 20px auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        margin-top: 15px;
    }

    select, input[type="date"], input[type="text"] {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
        transition: border-color 0.3s;
    }

    select:focus, input[type="date"]:focus, input[type="text"]:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 4px rgba(0,123,255,0.5);
    }

    button {
        margin-top: 25px;
        width: 100%;
        background-color: #007bff;
        border: none;
        padding: 12px 0;
        border-radius: 6px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>

<form action="<?= base_url('manajemenjadwal/store') ?>" method="post">
    <label for="user_id">Pilih User:</label>
    <select name="user_id" id="user_id" required>
        <option value="" disabled selected>-- Pilih User --</option>
        <?php foreach ($users as $user) : ?>
            <option value="<?= $user['id'] ?>"><?= esc($user['name']) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="date">Tanggal Service:</label>
    <input type="date" name="date" id="date" required>

    <label for="service_type">Jenis Service:</label>
    <input type="text" name="service_type" id="service_type" placeholder="Masukkan jenis service" required>

    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="" disabled selected>-- Pilih Status --</option>
        <option value="Belum Dilaksanakan">Belum Dilaksanakan</option>
        <option value="Tertunda">Tertunda</option>
        <option value="Selesai">Selesai</option>
    </select>

    <button type="submit">Simpan Jadwal</button>
</form>
