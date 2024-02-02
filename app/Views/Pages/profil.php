<?= $this->extend('Templates/template'); ?>

<?= $this->section('content'); ?>

<div class="row mt-4">
    <h1>PROFIL</h1>
    <?php foreach ($data_profil as $profils) : ?>
        <div class="col-4">
            <div class="p-3">
                <img src="/Assets/<?= $profils['foto'] ?>" alt="..." style="width: 100%;">
            </div>
        </div>
        <div class="col-6">
            <div class="p-3">
                <b><?= $profils['text'] ?></b>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection(); ?>