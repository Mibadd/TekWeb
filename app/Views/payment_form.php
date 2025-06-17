<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            background-color: #f3f4f6; 
            font-family: Arial, sans-serif; 
        }

        .payment-card {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .payment-card h2 { 
            font-size: 22px;
            text-align: center;
            margin-bottom: 15px;
        }

         .payment-card h5 { font-size: 18px; font-weight: 600; margin-bottom: 15px; }

        .payment-card .card { 
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

        .payment-summary { 
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }

        .mb-3 { margin-bottom: 20px; }

        .mb-3 > label { 
            display: block;
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 16px;
            color: #333;
        }

        .mb-3 > div {
            padding-left: 10px; /* agar radio buttons agak masuk ke dalam */
        }

        .mb-3 label > input[type="radio"] {
            margin-right: 8px; /* jarak antara tombol radio dan teks */
            vertical-align: middle;
            cursor: pointer;
        }

        .mb-3 label {
            display: block;  /* setiap label di baris baru */
            margin-bottom: 6px;
            font-size: 14px;
            color: #555;
            cursor: pointer;
        }

        .fw-bold { 
            font-weight: 700; 
            color: #007bff; 
            font-size: 16px; 
            text-align: right; 
        }

        .form-control { 
            border: 1px solid #ced4da; 
            border-radius: 5px;
            padding: 8px 12px;
            width: 100%;
            background-color: #fff;
        }

        .btn-success { 
            width: 100%;
            color: #fff;
            background-color: #007bff;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
        }

        .btn-success:hover { background-color: #0056b3; }

        .payment-history-link { 
            display: block;
            text-align: center;
            margin-top: 12px;
            color: #fff;
            background-color: #007bff;
            padding: 10px 0;
            border-radius: 5px;
        }

        .payment-history-link:hover { background-color: #0056b3; }

    </style>
</head>
<body>

<div class="payment-card">
    <h2>Pembayaran Servis</h2>

    <form action="<?= base_url('/payment/process'); ?>" method="post" enctype="multipart/form-data">
        <div class="card">
            <h5>Ringkasan Tagihan</h5>

            <!-- Jenis Servis -->
            <div class="mb-2 mt-3">
                <strong>Jenis Servis:</strong>
                <div class="payment-summary">
                    <?php if (isset($jadwal)) : ?>
                        <span><?= esc($jadwal['jenis_servis']) ?></span>
                        <span>Rp <?= number_format((int)$jadwal['biaya_jasa'], 0, ',', '.') ?></span>
                    <?php else : ?>
                        <span>Belum ada data jadwal.</span>
                        <span>Rp 0</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Suku Cadang -->
            <div class="mb-2 mt-3">
                <strong>Suku Cadang:</strong>
                <?php 
                    $totalHargaSukuCadang = 0;
                    if (isset($jadwal) && !empty($jadwal['suku_cadang_dibeli'])):
                        foreach ($jadwal['suku_cadang_dibeli'] as $item):
                            $subtotal = $item['harga'] * $item['jumlah'];
                            $totalHargaSukuCadang += $subtotal;
                ?>
                    <div class="payment-summary">
                        <span><?= esc($item['nama']) ?> (<?= esc($item['jumlah']) ?>× Rp <?= number_format($item['harga'], 0, ',', '.') ?>)</span>
                        <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                    </div>
                <?php 
                        endforeach;
                    else:
                ?>
                    <div class="payment-summary">
                        <span>Tidak ada suku cadang</span>
                        <span>Rp 0</span>
                    </div>
                <?php endif; ?>
            </div>

            <?php 
                $hargaServis = isset($jadwal) ? (int)$jadwal['biaya_jasa'] : 0;
                $totalBayar = $hargaServis + $totalHargaSukuCadang;
            ?>

            <hr>
            <div class="payment-summary fw-bold">
                <span>Total</span>
                <span>Rp <?= number_format($totalBayar, 0, ',', '.') ?></span>
            </div>

            <!-- Hidden Inputs -->
            <input type="hidden" name="jadwal_id" value="<?= isset($jadwal) ? esc($jadwal['id']) : '' ?>">
            <input type="hidden" name="total_amount" value="<?= $totalBayar ?>">

            
        </div>

        <div class="mb-3 mt-3">
            <label><strong>Pilih Metode Pembayaran</strong></label>
            <div>
                <label><input type="radio" name="payment_method" value="Transfer Bank" required> Transfer Bank (Mandiri)</label><br>
<<<<<<< HEAD
                <label><input type="radio" name="payment_method" value="OVO"> OVO</label><br>
                <label><input type="radio" name="payment_method" value="GoPay"> GoPay</label><br>
                <label><input type="radio" name="payment_method" value="Dana"> Dana</label><br>
                <label><input type="radio" name="payment_method" value="Bayar di Tempat"> Bayar di Tempat (Tunai)</label>
            </div>
        </div>

=======
                <label><input type="radio" name="payment_method" value="E-Wallet"> OVO</label><br>
                <label><input type="radio" name="payment_method" value="E-Wallet"> GoPay</label><br>
                <label><input type="radio" name="payment_method" value="E-Wallet"> Dana</label><br>
                <label><input type="radio" name="payment_method" value="Bayar di Tempat"> Bayar di Tempat (Tunai)</label>
            </div>
        </div>
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
        <button type="submit" class="btn btn-success">Bayar</button>
    </form>
</div>




</body>
</html>

<?= $this->endSection(); ?>
