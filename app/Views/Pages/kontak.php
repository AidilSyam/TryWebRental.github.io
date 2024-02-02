<?= $this->extend('Templates/template'); ?>

<?= $this->section('content'); ?>

<div class="row mt-4 ml-4">
    <h1>HUBUNGI KAMI...!!!</h1>
    <p class="fst-italic">TETAP TERHUBUNG DENGAN KAMI...</p>
    <?php foreach ($data_kontak as $kontaks) : ?>
        <div class="col mt-4">
            <table>
                <tr>
                    <th scope="col">ALAMAT : </th>
                </tr>
                <tr>
                    <th scope="row">
                        <p><?= $kontaks['alamat'] ?></p>
                    </th>
                </tr>
                <tr>
                    <th scope="col">TELEPON/WA :</th>
                </tr>
                <tr>
                    <th scope="row">
                        <p><?= $kontaks['tlp'] ?></p>
                    </th>
                </tr>
                <tr>
                    <th scope="col">EMAIL :</th>
                </tr>
                <tr>
                    <th scope="row">
                        <p><?= $kontaks['email'] ?></p>
                    </th>
                </tr>
                <tr>
                    <th scope="col">SOSIAL MEDIA :</th>
                </tr>
                <tr>
                    <th scope="row">
                        <div class="col w-100">
                            <img src="/Assets/fb.png" alt="facebook" style="width: 29px;height: 32px;flex-shrink: 0;">
                            <img src="/Assets/ig.png" alt="instagram" style="width: 29px;height: 32px;flex-shrink: 0;">
                            <img src="/Assets/yt.png" alt="youtube" style="width: 29px;height: 32px;flex-shrink: 0;">
                        </div>
                        <div class="col">
                        </div>
                        <div class="col">
                        </div>
                    </th>
                </tr>
            </table>
        </div>
    <?php endforeach; ?>
    <div class="col w-100 mt-4" style="background: rgba(0, 0, 0, 0.20);">
        <div class="maps">Maps</div>
    </div>
</div>

<?= $this->endSection(); ?>