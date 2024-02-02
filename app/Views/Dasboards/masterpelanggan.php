<?= $this->extend('Template_dasboards/TDasboard2'); ?>

<?= $this->section('content'); ?>

<ul class="list-unstyled mt-3 ms-3">
    <li>
        <h4>Master User</h4>
    </li>
    <li class="ms-2">
        <p>Data Pelanggan</p>
    </li>
    <li class="ms-2">
        <button class="btn" id="tambahpelanggan" style="background: #D9D9D9;color:black;"><i class="bi bi-plus-square-fill"></i> Tambah Pelanggan</button>
    </li>
    <li class="ms-2">
        <?php if (session()->getFlashData('success')) : ?>
            <?= session()->getFlashData('success') ?>
        <?php elseif (session()->getFlashData('errors')) : ?>
            <?= session()->getFlashData('errors') ?>
        <?php endif; ?>
    </li>
</ul>

<div class="card mt-5" style="background: #D9D9D9;">
    <style>
        @media (max-width: 600px) {
            .card-body {
                overflow: scroll;
            }
        }

        .table {
            background-color: transparent;
            /* Hapus warna latar belakang */
        }

        .table th,
        .table td {
            background-color: transparent;
            /* Hapus warna latar belakang pada sel */
        }
    </style>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" style="background-color: transparent">
                <thead>
                    <h6>Daftar Pelanggan</h6>
                </thead>
                <tbody class=" table-group-divider" style="background-color: transparent">
                    <tr style="text-align: center;">
                        <th scope="col">No.</th>
                        <th scope="col">ID</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">No.Telepon</th>
                        <th scope="col">Email</th>
                        <th scope="col">No.KTP</th>
                        <th scope="col">Foto KTP</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">
                            <center>Aksi</center>
                        </th>
                    </tr>

                    <?php foreach ($data_klien as $key => $clients) : ?>
                        <tr>
                            <th scope="row"><?= $key + 1 ?></th>
                            <td><?= $clients['id_pengguna'] ?></td>
                            <td><?= $clients['nama'] ?></td>
                            <td><?= $clients['gender'] ?></td>
                            <td><?= $clients['tlp'] ?></td>
                            <td><?= $clients['email'] ?></td>
                            <td><?= $clients['noktp'] ?></td>
                            <td>
                                <?php if ($clients['fotoktp']) : ?>
                                    <img src="<?= base_url('Assets/' . $clients['fotoktp']) ?>" alt="Foto Pengguna" style="max-width: 100px; max-height: 100px;">
                                <?php else : ?>
                                    Tidak Ada Gambar
                                <?php endif; ?>
                            </td>
                            <td><?= $clients['alamat'] ?></td>
                            <td><?= $clients['username'] ?></td>
                            <td><?= $clients['password'] ?></td>

                            <td>
                                <center>
                                    <button type="button" class="btn" data-target="form_ubah_data_pelanggan-<?= $clients['id_pengguna'] ?>" style="border-radius: 10px; background:#2CEE28;">Ubah</button>
                                    <a type="button" class="btn" href="<?= base_url('admin/Dasboards/masterpelanggan/hapus/' . $clients['id_pengguna']) ?>" style="border-radius: 10px; background:#F1222E; top:10px">Hapus</a>
                                </center>
                            </td>
                        </tr>

                        <!-- Element untuk ubah pelanggan -->
                        <tr class="model" id="form_ubah_data_pelanggan-<?= $clients['id_pengguna'] ?>">
                            <td colspan="10">
                                <div class="Eform">
                                    <p>Ubah Pelanggan</p>

                                    <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

                                    <form action="<?= base_url('admin/Dasboards/masterpelanggan/ubah/' . $clients['id_pengguna']) ?>" method="post" style="margin: 2em;" enctype="multipart/form-data">
                                        <div class="mb-3 row">
                                            <label for="nama" class="form-label col">Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control col" id="nama" value="<?= $clients['nama'] ?>" style=" background: rgba(255, 251, 251, 0.59)">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="gender" class="form-label col">Jenis Kelamin</label>
                                            <input type="text" name="gender" class="form-control col" id="gender" value="<?= $clients['gender'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="tlp" class="form-label col">No Telepon</label>
                                            <input type="text" name="tlp" class="form-control col" id="tlp" value="<?= $clients['tlp'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="email" class="form-label col">Email</label>
                                            <input type="email" name="email" class="form-control col" id="email" value="<?= $clients['email'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="noktp" class="form-label col">No KTP</label>
                                            <input type="text" name="noktp" class="form-control col" id="noktp" value="<?= $clients['noktp'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="fotoktp" class="form-label col">Upload Foto Ktp</label>
                                            <div class="form-control col">
                                                <div class="row">
                                                    <?php if ($clients['fotoktp']) : ?>
                                                        <img src="<?= base_url('Assets/' . $clients['fotoktp']) ?>" alt="Foto Ktp" style="max-width: 100px; max-height: 100px;">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="row">
                                                    <input type="file" class="form-control" id="fotoktp" name="fotoktp" style="background: rgba(255, 251, 251, 0.59)">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="alamat" class="form-label col">Alamat</label>
                                            <input type="text" name="alamat" class="form-control col" id="alamat" value="<?= $clients['alamat'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="username" class="form-label col">Username</label>
                                            <input type="text" name="username" class="form-control col" id="username" value="<?= $clients['username'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                            <input type="hidden" name="id_user" value="<?= $clients['id_user'] ?>">
                                            <input type="hidden" name="role" value="pengguna">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="password" class="form-label col">Password</label>
                                            <input type="text" name="password" class="form-control col" id="password" value="<?= $clients['password'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <center>
                                                    <button type="button" class="btn" style="border-radius: 10px; background:#F1222E;">Close</button>
                                                </center>
                                            </div>
                                            <div class="col justify-content-center">
                                                <center>
                                                    <button type="submit" class="btn" style="border-radius: 10px; background:#2CEE28;">Save</button>
                                                </center>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    #formulir {
        width: 100%;
        height: 100%;
        top: 0;
        right: 0;
        bottom: 0;
        position: fixed;
        background-color: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(5px);
        padding: 20px;
        justify-content: center;
        display: none;
    }

    .model {
        width: 100%;
        height: 100vh;
        top: 0;
        right: 0;
        bottom: 0;
        position: fixed;
        background-color: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(5px);
        padding: 20px;
        justify-content: center;
        display: none;
    }

    .Eform {
        padding-bottom: 1em;
        padding-top: 1em;
        border-radius: 10px;
        position: absolute;
        top: 2.5%;
        left: 32.5%;
        width: 35%;
        height: auto !important;
        flex-shrink: 0;
        border-radius: 15px;
        background: #E7E2E2;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    }

    @media (max-width: 600px) {
        .Eform {
            width: 80%;
            left: 10%;
        }
    }
</style>

<!-- Element untuk tambah mobile -->
<div id="formulir">
    <div class="Eform">
        <p>Tambah Pelanggan</p>
        <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

        <form style="margin: 2em;" action="masterpelanggan" method="post" enctype="multipart/form-data">
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
                <label for="tlp" class="form-label col">No Telepon</label>
                <input type="text" name="tlp" class="form-control col" id="tlp" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="email" class="form-label col">Email</label>
                <input type="email" name="email" class="form-control col" id="email" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="noktp" class="form-label col">No KTP</label>
                <input type="text" name="noktp" class="form-control col" id="noktp" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="fotoktp" class="form-label col">Upload Foto KTP</label>
                <input type="file" name="fotoktp" class="form-control col" id="fotoktp" style="background: rgba(255, 251, 251, 0.59)">
            </div>

            <div class="mb-3 row">
                <label for="alamat" class="form-label col">Alamat</label>
                <input type="text" name="alamat" class="form-control col" id="alamat" style="background: rgba(255, 251, 251, 0.59)">
            </div>

            <div class="mb-3 row">
                <label for="username" class="form-label col">Username</label>
                <input type="username" name="username" class="form-control col" id="username" style="background: rgba(255, 251, 251, 0.59)">
                <input type="hidden" name="role" value="pengguna">
            </div>
            <div class="mb-3 row">
                <label for="password" class="form-label col">Password</label>
                <input type="password" name="password" class="form-control col" id="password" style="background: rgba(255, 251, 251, 0.59)">
            </div>

            <div class="row">
                <div class="col">
                    <center>
                        <a type="close" class="btn" style="border-radius: 10px; background:#F1222E;" id="tutupForm">Close</a>
                    </center>
                </div>
                <div class="col justify-content-center">
                    <center>
                        <button type="submit" class="btn" style="border-radius: 10px; background:#2CEE28;">Save</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('tambahpelanggan').addEventListener('click', () => {
        document.getElementById('formulir').style.display = 'block';
    });

    document.getElementById('tutupForm').addEventListener('click', function() {
        document.getElementById('formulir').style.display = 'none';
    });

    /* document.getElementById('ubahdatapelanggan').addEventListener('click', () => {
         document.getElementById('form_ubah_data_pelanggan').style.display = 'block';
     });*/
    document.querySelectorAll('.btn[data-target]').forEach(function(button) {
        button.addEventListener('click', function() {
            var targetID = this.dataset.target;
            var targetElement = document.getElementById(targetID);

            if (targetElement) {
                targetElement.style.display = 'block';
            }
        });
    });

    document.querySelectorAll('.btn').forEach(function(closeBtn) {
        closeBtn.addEventListener('click', function() {
            var formToClose = this.closest('.model');

            if (formToClose) {
                formToClose.style.display = 'none';
            }
        });
    });
</script>

<?= $this->endSection(); ?>