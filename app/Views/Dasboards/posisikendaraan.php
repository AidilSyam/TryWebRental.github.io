<?= $this->extend('Template_dasboards/TDasboard2'); ?>

<?= $this->section('content'); ?>

<ul class="list-unstyled mt-3 ms-3">
    <li>
        <h4>Monitoring Posisi Kendaraan</h4>
    </li>
</ul>
<div class="card mt-5" style="background: #D9D9D9; width:60%; left:20%; height:70vh;">
    <div class="card-body w-100 h-100">
        <p>maps</p>
        <div class="mapouter">
            <div class="gmap_canvas">
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3952.808466995707!2d110.38418607742952!3d-7.810089972125286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwNDgnMzYuMyJTIDExMMKwMjMnMjAuNiJF!5e0!3m2!1sid!2sid!4v1706270385461!5m2!1sid!2sid" style="border:0; width: 100%; height: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <style>
                    .mapouter {
                        position: relative;
                        text-align: right;
                    }

                    .gmap_canvas {
                        overflow: hidden;
                        background: none !important;
                    }

                    .mapouter>.gmap_canvas {
                        width: 100%;
                        height: 60vh;
                    }
                </style>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>