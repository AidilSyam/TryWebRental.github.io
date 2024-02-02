<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Login</title>

</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .form-login {
        width: 40%;
        height: auto;
        flex-shrink: 0;
        border-radius: 15px;
        background: #E04D01;
        mix-blend-mode: darken;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        margin-left: 30%;
        padding-top: 2em;
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

        .form-login {
            width: 80%;
            height: auto;
            margin: 0;
        }
    }

    .floating-options {
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        background-color: #FFF;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .floating-options a {
        display: block;
        margin-bottom: 10px;
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        background-color: #FFBA0A;
        color: #fff;
        text-decoration: none;
    }

    .floating-options .close-btn {
        display: block;
        margin-top: 10px;
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        background-color: #FF3333;
        color: #fff;
        text-decoration: none;
    }
</style>

<body class="d-flex justify-content-center align-items-center">
    <div class="container w-100 justify-content-center" style="height:100%">
        <div class="form-login">
            <center>
                <h1>LOGIN</h1>
            </center>

            <form style="margin: 2em;" method="POST" action="<?= site_url('login/user') ?>">
                <?php if (!empty(session()->getFlashdata('error'))) { ?>
                    <?php echo session()->getFlashdata('error') ?>
                <?php } ?>

                <div class="mb-3">
                    <input type="text" class="form-control" name="username" id='username' placeholder="Username" style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <div class="row">
                    <div class="col">
                        <center>
                            <a type="close" class="btn" style="border-radius: 10px; background:#FFBA0A;" href="home">Close</a>
                        </center>
                    </div>
                    <div class="col justify-content-center">
                        <center>
                            <button type="submit" class="btn" name="login" style="border-radius: 10px; background:#FFBA0A;">Login</button>
                        </center>
                    </div>
                    <center>
                        <p style="color: aliceblue;">belum punya akun? <a type="button" id="showOptions" style="color: blue;">Daftar</a></p>
                    </center>
                </div>
            </form>
            <div class="floating-options" id="registrationOptions">
                <button type="button" class="btn-close" id="closeOptions" aria-label="Close"></button>
                <p style="text-align: center; font-weight: bold; color: #333;">Choose Option:</p>
                <a href="registrasi/pelanggan" class="btn">Register Sebagai Pelanggan</a>
                <a href="registrasi/pemilik" class="btn">Register Sebagai Pemilik Kendaraan</a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('showOptions').addEventListener('click', function() {
            document.getElementById('registrationOptions').style.display = 'block';
        });

        document.getElementById('closeOptions').addEventListener('click', function() {
            document.getElementById('registrationOptions').style.display = 'none';
        });
    </script>

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