<?= $this->extend('Templates/template'); ?>

<?= $this->section('content'); ?>
<style>
    .card {
        background-color: #ff4c00;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Informasi Pesanan</h2>
                </div>
                <?php foreach ($data_sewa as $sewa) : ?>
                    <div class="card-body">
                        <p><strong>tanggal sewa</strong> <?= $sewa['tgl_sewa'] ?></p>
                        <p><strong>tanggal kembali</strong> <?= $sewa['tgl_kbl'] ?></p>
                        <p><strong>lama sewa</strong> <?= $sewa['lama_sewa'] ?> Hari</p>
                        <p><strong>Harga Sewa</strong> Rp. <?= $sewa['total_harga_sewa'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->endSection(); ?>