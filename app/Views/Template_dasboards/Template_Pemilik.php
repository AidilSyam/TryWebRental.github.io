<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rental Mobil</title>
    <!-- bootstrap 5 css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- custom css -->
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        li {
            list-style: none;
            margin: 0 0 20px 0;
        }

        a {
            text-decoration: none;
            font-family: Roboto Slab;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            margin-left: -300px;
            transition: margin-left 0.8s;
            background-color: #E04D01;
        }

        .active-main-content {
            margin-left: 250px;
        }

        .active-sidebar {
            margin-left: 0;
        }

        #main-content {
            transition: 0.8s;
        }
    </style>
</head>

<body>
    <?php
    $id_user = session('id_user');
    $username = session('username');
    $role = session('role');
    $isUserLoggedIn = $id_user !== null;

    // Tambahkan pemeriksaan role pengguna yang diizinkan untuk login di halaman home
    $allowedRoles = ['pemilik_kendaraan']; // Ganti dengan role yang diizinkan
    $isAllowedRole = in_array($role, $allowedRoles); ?>
    <div>
        <div class="sidebar p-4" id="sidebar">
            <ul class="list-unstyled">
                <center>
                    <h6 class="text-white mb-4">RENTAL MOBIL</h6>
                </center>
                <li class="ms-3">
                    <a class="text-white" href="<?= base_url('pemilik/V_Pemilik') ?>">
                        <i class="bi bi-house mr-2"></i>
                        Dasboard
                    </a>
                </li>

                <li class="ms-3">
                    <a class="text-white" href="<?= base_url('pemilik/V_Pemilik/datamobil') ?>">
                        <i class="bi bi-car-front-fill mr-2"></i>
                        Data Mobil
                    </a>
                </li>

                <li class="ms-3">
                    <a class="text-white" href="<?= base_url('pemilik/V_Pemilik/datasewa') ?>">
                        <i class="bi bi-ev-front mr-2"></i>
                        Data Sewa
                    </a>
                </li>

                <li class="ms-3">
                    <a class="text-white" href="<?= base_url('pemilik/V_Pemilik/datamonitoring') ?>">
                        <i class="bi bi-geo-fill mr-2"></i>
                        Data Monitoring
                    </a>
                </li>

                <li class="ms-3">
                    <a class="text-white" href="<?= base_url('pemilik/V_Pemilik/akun') ?>">
                        <i class="bi bi-person mr-2"></i>
                        Akun
                    </a>
                </li>
            </ul>

            <li><?php if ($isUserLoggedIn && $isAllowedRole) : ?>
                    <a class="text-white" href="<?= base_url('logout') ?>">
                        <center>
                            <i class="bi mr-2"></i>
                            Logout
                        </center>
                    </a>
                <?php endif; ?>
            </li>
        </div>
    </div>
    <div class="p-4" id="main-content">
        <button class="btn border" id="button-toggle">
            <i class="bi bi-list"></i>
        </button>

        <?= $this->renderSection('content'); ?>

    </div>

    <script>
        // event will be executed when the toggle-button is clicked
        // document.getElementById("button-toggle").addEventListener("click", () => {

        // when the button-toggle is clicked, it will add/remove the active-sidebar class
        //   document.getElementById("sidebar").classList.toggle("active-sidebar");

        // when the button-toggle is clicked, it will add/remove the active-main-content class
        //  document.getElementById("main-content").classList.toggle("active-main-content");
        //});

        document.addEventListener("DOMContentLoaded", function() {
            // Periksa apakah sidebar seharusnya aktif pada awalnya berdasarkan local storage
            const isSidebarActive = localStorage.getItem("sidebarActive") === "true";

            // Tetapkan status awal berdasarkan local storage tanpa animasi
            document.getElementById("sidebar").classList.toggle("active-sidebar", isSidebarActive);
            document.getElementById("main-content").classList.toggle("active-main-content", isSidebarActive);

            // Event listener untuk tombol toggle
            document.getElementById("button-toggle").addEventListener("click", () => {
                // Toggle kelas aktif pada sidebar dan konten utama
                document.getElementById("sidebar").classList.toggle("active-sidebar");
                document.getElementById("main-content").classList.toggle("active-main-content");

                // Simpan status toggle di local storage
                const isSidebarActive = document.getElementById("sidebar").classList.contains("active-sidebar");
                localStorage.setItem("sidebarActive", isSidebarActive.toString());
            });
        });
    </script>
</body>

</html>