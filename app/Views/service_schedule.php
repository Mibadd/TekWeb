<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>

<div class="content">
    <div class="content-header">
        <h2>Jadwal Service</h2>
        <!-- Tombol "+ Tambah Jadwal" sudah dihapus sesuai permintaan -->
    </div>

    <table class="service-table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis Service</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <a href="<?= base_url('/service-schedule/create'); ?>" class="btn btn-primary">+ Tambah Jadwal</a>
        </thead>
            <tbody>
            <?php foreach($schedules as $schedule): ?>
                <tr>
                    <td><?= esc($schedule['date']); ?></td>
                    <td><?= esc($schedule['service_type']); ?></td>
                    <td class="status-<?= strtolower(str_replace(' ', '-', $schedule['status'])); ?>">
                        <?= esc($schedule['status']); ?>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="<?= base_url('service-schedule/'.$schedule['id']); ?>" class="btn btn-info"><i class="fa fa-eye"></i> Detail</a>
                            <form method="post" action="<?= base_url('service-schedule/delete/'.$schedule['id']); ?>" style="display:inline;">
                                <?= csrf_field(); ?>
                                <button type="submit" onclick="return confirm('Yakin ingin hapus?');"><i class="fa fa-trash"></i> Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
    </table>
</div>

<style>
    body {
        display: flex;
        background-color: #f5f5f5;
        height: 100vh;
    }

    .content {
        width: 155%;
        max-width: 1500px;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        margin: 30px;
        margin-top: 10px;
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .content-header h2 {
        margin: 0;
    }

    .service-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .service-table th, .service-table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .service-table th {
        background-color: rgb(236, 236, 236);
        color: #000;
    }

    .service-table tr:hover {
        background-color: #f4f4f9;
    }

    .status-selesai { color: green; font-weight: bold; }
    .status-tertunda { color: orange; font-weight: bold; }
    .status-belum-dilaksanakan { color: red; font-weight: bold; }

    .action-buttons button {
        background: none;
        border: none;
        color: rgb(5, 5, 5);
        cursor: pointer;
        font-size: 14px;
        margin-right: 5px;
    }

    .action-buttons button:hover {
        text-decoration: underline;
    }

    /* Tambahan agar tombol di link tidak terlalu besar */
    .action-buttons a button {
        padding: 4px 8px;
    }
</style>

<?= $this->endSection(); ?>
