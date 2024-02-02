<?php
$id_user = session('id_user');
$username = session('username');
$role = session('role');

$isUserLoggedIn = $id_user !== null;

// Tambahkan pemeriksaan role pengguna yang diizinkan untuk login di halaman home
$allowedRoles = ['pengguna'];  // Ganti dengan role yang diizinkan
$isAllowedRole = in_array($role, $allowedRoles);
?>

<?= $this->extend('Templates/template'); ?>

<?= $this->section('content'); ?>

<style>
    .container>.col>.row>.car>.car-body {
        background-color: transparent;
    }

    @media screen and (max-width: 768px) {
        .col {
            padding: 10px;
            width: 100%;
        }

        .card-body {
            width: 100%;
            justify-content: center;
        }

        input {
            max-width: 100%;
            width: 80%;
            height: auto;
            margin: 0;
        }
    }
</style>
<div class="col">
    <div class="row-md-4">
        <style></style>
        <div class="card bg-transparent border-0">
            <div class="card-body row justify-content-end">
                <input type="search" class="form-control rounded-pill border-black col-lg-4" placeholder="Pencarian Mobil..." style="margin-right: 10px; background: rgba(255, 255, 255, 0.12);width:20vw;height: 1.5em;max-width: 500px;">
            </div>
        </div>
    </div>
    <div class="row-md-4">
        <style>
            .cards {
                width: 100%;
                align-items: center;
                justify-content: center;
                background: transparent;
                border: 0;
                display: flex;
                flex-wrap: wrap;
            }

            .cards-body {
                width: 50%;
            }

            @media (max-width: 600px) {
                .cards-body {
                    flex: 0 0 calc(100% - 10px);
                }
            }
        </style>
        <div class="cards">
            <div class="cards-body">
                <video src="Assets/Project.mp4" class="object-fit-contain w-100 rounded" controls playsinline autoplay muted loop></video>
            </div>
        </div>
    </div>
    <div class="row-md-4">
        <div class="card bg-transparent border-0">
            <div class="card-body">
                <!-- Tampilkan informasi pengguna yang login -->
                <?php if ($isUserLoggedIn && $isAllowedRole) : ?>
                    <h2>Selamat Datang, <?= $username ?></h2>
                <?php endif; ?>

                <h4 class="fst-italic">SOLUSI TRANSPORTASI ANDA...</h4>
            </div>
        </div>
    </div>
    <div class="row-md-4">
        <div class="card bg-transparent border-0">
            <div class="card-body">
                <div class="grid justify-content-center" style="--bs-columns: 5;--bs-gap: 1.5rem;">
                    <style>
                        .row {
                            display: flex;
                            flex-wrap: wrap;
                        }

                        .item {
                            width: 71px;
                            height: auto;
                            flex: 0 0 calc(15%);
                            border-radius: 10px;
                            border: 1px solid #000;
                            background-color: #ff4c00;
                            margin: 15px;
                        }

                        @media (max-width: 600px) {
                            .item {
                                flex: 0 0 calc(100% - 10px);
                            }
                        }

                        .list_item {
                            font-size: 10px;
                        }
                    </style>
                    <div class="row">
                        <?php foreach ($data_mobil as $mobils) : ?>
                            <div class="item col shadow">
                                <div class="row justify-content-center mt-2 mb-2">
                                    <div class="col-sm-12 bg-white" style="height: 35%;width:90%;">
                                        <img src="Assets/<?= $mobils['foto_mbl'] ?>" alt="<?= $mobils['foto_mbl'] ?>" style="width: 100%;height:100%;">
                                    </div>
                                    <div class="col-sm-12" style="height: 55%;width:90%;">
                                        <div class="detail w-100 h-100 mt-2 mr-2">
                                            <ul class="list-unstyled text-white">
                                                <li class="list_item">Mobil : <?= $mobils['mobil'] ?></li>
                                                <li class="list_item">Type Mobil : <?= $mobils['type_mobil'] ?></li>
                                                <li class="list_item">Transmisi : <?= $mobils['transmisi'] ?></li>
                                                <li class="list_item">Kapasitas Penumpang : <?= $mobils['kapasitas_penumpang'] ?></li>
                                                <li class="list_item">Tarif Harga : <?= $mobils['harga_sewa'] ?></li>
                                                <li class="list_item">Status :<?php if ($mobils >= 0) {
                                                                                    # code...
                                                                                    echo " Ready";
                                                                                } ?></li>
                                            </ul>
                                            <center>
                                                <!-- <a type="button" id="pesanButton" class="btn btn-primary" href="<?= base_url('pemesanan') ?>">Pesan</a> -->
                                                <!-- Teruskan ID mobil ke fungsi JavaScript -->
                                                <a type="button" class="btn btn-primary pesanButton" data-car-id="<?= $mobils['id_mobil'] ?>">Pesan</a>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row-md-4">
        <div class="card bg-transparent border-0">
            <div class="card-body">
                <p>Melayani :</p>
                <ul>
                    <li>Rental Mobil Lepas Kunci</li>
                    <li>Rental Mobil Dengan Driver</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    // Gunakan event delegation untuk menangani klik pada semua tombol "Pesan"
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('pesanButton')) {
            event.preventDefault();

            // Ambil ID mobil dari atribut data
            const carId = event.target.getAttribute('data-car-id');

            <?php if ($isUserLoggedIn) : ?>
                // Jika pengguna sudah login, lanjutkan ke halaman pemesanan dengan ID mobil
                window.location.href = '<?= base_url('/pemesanan') ?>?' + carId;
            <?php else : ?>
                // Jika pengguna belum login, tampilkan pesan dan arahkan ke halaman login
                alert('Silakan login untuk dapat melakukan pemesanan.');
                window.location.href = '<?= base_url('login') ?>';
            <?php endif; ?>
        }
    });
</script>

<?= $this->endSection(); ?>