<!-- app/Views/permintaanservice.php -->
<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>
<h1>Permintaan Service</h1>

<!-- Tampilkan formulir permintaan service -->
<form>
    <div class="form-group">
        <label for="serviceType">Jenis Service</label>
        <select id="serviceType" name="serviceType" class="form-control">
            <option value="serviceBerkala">Service Berkala</option>
            <option value="serviceCVT">Service CVT</option>
        </select>
    </div>
    <div class="form-group">
        <label for="date">Tanggal Service</label>
        <input type="date" id="date" name="date" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
</form>

<?= $this->endSection(); ?>
