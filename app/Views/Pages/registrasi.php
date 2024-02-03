<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Registrasi</title>

</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .form {
        width: 40%;
        height: auto;
        flex-shrink: 0;
        border-radius: 15px;
        background: #E04D01;
        mix-blend-mode: darken;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        margin-left: 30%;
        padding-bottom: 1em;
        padding-top: 1em;
    }

    body {
        min-height: 100vh;
        margin: 0;
    }

    .container {
        padding: 20px;
    }

    @media screen and (max-width: 768px) {
        .container {
            padding: 10px;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-daftar {
            width: 80%;
            height: auto;
            margin: 0;
        }
    }

    .floating-message {
        display: none;
        position: fixed;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        padding: 1em;
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
        z-index: 1000;
        /* Menempatkan elemen di atas elemen-elemen lain */
    }
</style>

<body class="d-flex justify-content-center align-items-center">
    <div class="container w-100 justify-content-center" style="height:100%">
        <div class="form">
            <center>
                <h1>DAFTAR</h1>
            </center>
            <form style="margin: 2em;" action="<?= site_url('registrasi/pelanggan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="mb-3 row">
                    <label for="nama" class="form-label col">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control col" id="nama" style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <div class="mb-3 row">
                    <label for="gender" class="form-label col">Jenis Kelamin</label>
                    <input type="text" name="gender" class="form-control col" id="gender" style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <div class="mb-3 row">
                    <label for="alamat" class="form-label col">Alamat</label>
                    <input type="text" name="alamat" class="form-control col" id="alamat" style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <div class="mb-3 row">
                    <label for="tlp" class="form-label col">Nomor Telepon</label>
                    <input type="text" name="tlp" class="form-control col" id="tlp" style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <div class="mb-3 row">
                    <label for="email" class="form-label col">Email</label>
                    <input type="email" name="email" class="form-control col" id="email" style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <div class="mb-3 row">
                    <label for="noktp" class="form-label col">No KTP/NIK</label>
                    <input type="text" name="noktp" class="form-control col" id="noktp" style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <div class="mb-3 row">
                    <label for="fotoktp" class="form-label col">Upload Foto KTP</label>
                    <input type="file" name="fotoktp" class="form-control col" id="fotoktp" style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <div class="mb-3 row">
                    <label for="username" class="form-label col">Username</label>
                    <input type="username" name="username" class="form-control col" id="username" style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <div class="mb-3 row">
                    <label for="password" class="form-label col">Password</label>
                    <input type="password" name="password" class="form-control col" id="password" style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <div class="row">
                    <div class="col">
                        <center>
                            <a type="close" class="btn" style="border-radius: 10px; background:#FFBA0A;" href="/login">Close</a>
                        </center>
                    </div>
                    <div class="col justify-content-center">
                        <center>
                            <button type="submit" class="btn" style="border-radius: 10px; background:#FFBA0A;">Daftar</button>
                        </center>
                    </div>
                </div>
            </form>
            <div class="success-message" id="successMessage">
                <center>
                    <!-- <p>Akun Anda berhasil didaftarkan!</p> -->
                    <?php if (session()->getFlashData('success')) : ?>
                        <?= session()->getFlashData('success') ?>
                    <?php elseif (session()->getFlashData('errors')) : ?>
                        <?= session()->getFlashData('errors') ?>
                    <?php endif; ?>
                </center>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

</body>

</html>