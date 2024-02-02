<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Rental Mobil</title>

</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        background-color: #F70;
        min-height: 100vh;
    }

    .nav-item:hover {
        background-color: #FFBA0A;
        border-radius: 10px;
    }

    .dropdown {
        border-radius: 10px;
        width: 100%;
        height: 100%;
    }

    .nav-link {
        font-weight: bold;
    }

    @media screen and (max-width: 768px) {
        body {
            max-width: 100%;
        }

        .container {
            max-width: 100%;
        }

    }
</style>

<body>
    <?php
    $id_user = session('id_user');
    $username = session('username');
    $role = session('role');
    $isUserLoggedIn = $id_user !== null;

    // Tambahkan pemeriksaan role pengguna yang diizinkan untuk login di halaman home
    $allowedRoles = ['pengguna'];  // Ganti dengan role yang diizinkan
    $isAllowedRole = in_array($role, $allowedRoles); ?>

    <header class="header fixed-top" style="background-color: #E04D01">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">EasyRent</a>
                <!--<img src="/Assets/jappa.jpg" alt="Logo" width="45" height="45" class="d-inline-block align-text-top rounded-circle">-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                    <ul class="navbar-nav w-50">
                        <li class="nav-item w-25">
                            <a class="nav-link text-center" aria-current="page" href="home">Home</a>
                        </li>
                        <li class="nav-item w-25">
                            <a class="nav-link text-center" href="profil">Profil</a>
                        </li>
                        <li class="nav-item w-25">
                            <a class="nav-link text-center" href="galeri">Galery</a>
                        </li>
                        <li class="nav-item w-25">
                            <a class="nav-link text-center" href="kontak">Kontak</a>
                        </li>
                        <!-- <li class="nav-item w-25">
                            <a class="nav-link text-center" href="<?= base_url('/login') ?>">Login</a>
                        </li> -->
                        <?php if ($isUserLoggedIn && $isAllowedRole) : ?>
                            <li class="dropdown nav-item w-25">
                                <a class="btn w-100" type="button" data-bs-toggle="dropdown"><?php echo "<i><b>$username</b></i>" ?></a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item text-center" type="button" href="<?= base_url('akun') ?>">Akun</a></li>
                                    <li><a class="dropdown-item text-center" type="button" href="<?= base_url('pesanan') ?>">Pesanan</a></li>
                                    <li><a class="dropdown-item text-center" type="button" href="<?= base_url('logout') ?>">Logout</a></li>
                                </ul>
                            </li>
                        <?php else : ?>
                            <li class="nav-item w-25">
                                <a class="nav-link text-center" href="<?= base_url('login') ?>">Login</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container p-5">
        <?= $this->renderSection('content'); ?>
    </div>

    <footer class="footer fixed-bottom end-0 w-100">
        <img src="/Assets/Footer-fix.png" class="img-fluid w-100" alt="footer" style="height: 125px">
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script>
        // JavaScript untuk menangani visibilitas dropdown
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownButton = document.querySelector('.dropdown');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            dropdownButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('show');
            });

            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>

</body>

</html>