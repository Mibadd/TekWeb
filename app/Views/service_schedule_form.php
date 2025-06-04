<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>

<style>
    .form-container {
        max-width: 450px;
        background: #fff;
        padding: 25px 30px;
        margin: 40px auto;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    .form-group {
        margin-bottom: 18px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #444;
    }

    input[type="date"],
    input[type="text"] {
        width: 100%;
        padding: 10px 12px;
        border: 1.8px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    input[type="date"]:focus,
    input[type="text"]:focus {
        border-color: #007BFF;
        outline: none;
        box-shadow: 0 0 8px rgba(0,123,255,0.3);
    }

    .form-actions {
        margin-top: 25px;
        text-align: center;
    }

    button[type="submit"] {
        background-color: #007BFF;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 7px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .cancel-link {
        margin-left: 15px;
        font-size: 16px;
        color: #666;
        text-decoration: none;
        vertical-align: middle;
    }

    .cancel-link:hover {
        color: #007BFF;
        text-decoration: underline;
    }
</style>

<div class="form-container">
    <h2>Tambah Jadwal Service</h2>

    <form action="<?= base_url('/service-schedule/store'); ?>" method="post">
        <?= csrf_field(); ?>

        <div class="form-group">
            <label for="service_date">Tanggal Service:</label>
            <input type="date" id="service_date" name="service_date" required>
        </div>

        <div class="form-group">
            <label for="service_type">Jenis Service:</label>
            <input type="text" id="service_type" name="service_type" placeholder="Misal: Ganti Oli" required>
        </div>

        <div class="form-actions">
            <button type="submit">Simpan Jadwal</button>
            <a href="<?= base_url('/service-schedule'); ?>" class="cancel-link">Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>