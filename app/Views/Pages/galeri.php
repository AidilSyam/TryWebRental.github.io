<?= $this->extend('Templates/template'); ?>

<?= $this->section('content'); ?>

<div class="row mt-4">
    <h1>GALERI KAMI...!!!</h1>
    <p class="fst-italic">TESTIMONI PEMAKAIAN JASA RENTAL KAMI...</p>
    <div class="row">
        <div class="card align-items-center justify-content-center bg-transparent border-0">
            <div class="card-body w-100">
                <video src="/Assets/Project.mp4" class="object-fit-contain w-100 rounded" controls playsinline autoplay muted loop></video>
            </div>
        </div>
        <div class="col-6">
            <div class="p-3">
                <img src="/Assets/jappa.jpg" alt="..." style="width: 100%;">
            </div>
        </div>
        <div class="col-6">
            <div class="p-3">
                <img src="/Assets/jappa.jpg" alt="..." style="width: 100%;">
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>