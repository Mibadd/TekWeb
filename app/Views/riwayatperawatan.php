<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>

<div class="content">
    <div class="content-header">
        <h2>Riwayat Service</h2>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Kendaraan</th>
                    <th>Tanggal Service</th>
                    <th>Jenis Service</th>
                    <th>Tindakan</th>
                    <th>Suku Cadang</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($riwayat) && is_array($riwayat)) : ?>
                    <?php foreach ($riwayat as $item): ?>
                        <?php if (is_array($item)) : ?>
                            <tr>
                                <td><?= esc($item['kendaraan']); ?></td>
                                <td><?= esc($item['tanggal_service']); ?></td>
                                <td><?= esc($item['jenis_service']); ?></td>
                                <td><?= esc($item['tindakan']); ?></td>
                                <td><?= esc($item['suku_cadang']); ?></td>
                            </tr>
                        <?php else: ?>
                            <tr><td colspan="5">Data item tidak valid.</td></tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">Data riwayat service tidak tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>
