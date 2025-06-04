<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>

<div class="content">
    <div class="content-header">
        <h2>Jadwal Service</h2>
    </div>

    <div class="table-responsive">
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
            <?php foreach($schedules as $schedule): ?>
                <tr>
                    <td data-label="Tanggal"><?= esc($schedule['date']); ?></td>
                    <td data-label="Jenis Service"><?= esc($schedule['service_type']); ?></td>
                    <td data-label="Status" class="status-<?= strtolower(str_replace(' ', '-', $schedule['status'])); ?>">
                        <?= esc($schedule['status']); ?>
                    </td>
                    <td data-label="Aksi">
                        <div class="action-buttons">
                            <a href="<?= base_url('service-schedule/'.$schedule['id']); ?>" class="btn btn-info"><i class="fa fa-eye"></i> <span class="btn-text">Detail</span></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    body {
        display: flex;
        background-color: #f5f5f5;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    .content {
        width: 180%;
        max-width: 1500px;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        margin: 20px;
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .content-header h2 {
        margin: 0;
        font-size: 1.5rem;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .service-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        min-width: 600px;
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

    .action-buttons a {
        text-decoration: none;
    }

    .action-buttons a .btn {
        padding: 6px 10px;
        color: white;
        background-color: #17a2b8;
        border-radius: 5px;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .action-buttons a .btn:hover {
        background-color: #138496;
    }

    @media (max-width: 768px) {
        .content {
            padding: 15px;
            margin: 10px;
        }
        
        .service-table {
            min-width: 100%;
        }
        
        .service-table thead {
            display: none;
        }
        
        .service-table tr {
            display: block;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .service-table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: right;
            padding-left: 50%;
            position: relative;
            border: none;
            border-bottom: 1px solid #eee;
        }
        
        .service-table td:before {
            content: attr(data-label);
            position: absolute;
            left: 15px;
            width: 45%;
            padding-right: 10px;
            font-weight: bold;
            text-align: left;
        }
        
        .service-table td:last-child {
            border-bottom: 0;
        }
        
        .action-buttons a .btn {
            margin-left: auto;
        }
        
        .btn-text {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .content-header h2 {
            font-size: 1.3rem;
        }
        
        .service-table td {
            padding-left: 40%;
        }
        
        .service-table td:before {
            width: 35%;
        }
    }
</style>

<?= $this->endSection(); ?>