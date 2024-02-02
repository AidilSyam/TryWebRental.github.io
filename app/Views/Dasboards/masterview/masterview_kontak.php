<?= $this->extend('Template_dasboards/TDasboard2'); ?>

<?= $this->section('content'); ?>

<ul class="list-unstyled mt-3 ms-3">
    <li>
        <h4>Master View</h4>
    </li>
    <li class="ms-2">
        <p>Data Kontak</p>
    </li>
    <li class="ms-2">
        <button class="btn" id="tambahkontak" style="background: #D9D9D9;color:black;"><i class="bi bi-plus-square-fill"></i> Tambah</button>
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
        <table class="table" style="background-color: transparent">
            <thead>
                <h6>Daftar Kontak</h6>
            </thead>
            <tbody class="table-group-divider" style="background-color: transparent">
                <?php if (!empty($data_kontak)) : ?>
                    <tr style="text-align: center;">
                        <th scope="col">Alamat</th>
                        <th scope="col">Telepon/Wa</th>
                        <th scope="col">Email</th>
                        <th scope="col">
                            <center>Aksi</center>
                        </th>
                    </tr>

                    <?php foreach ($data_kontak as $kontaks) : ?>
                        <tr style="text-align: center;">
                            <td><?= $kontaks['alamat'] ?></td>
                            <td><?= $kontaks['tlp'] ?></td>
                            <td><?= $kontaks['email'] ?></td>
                            <td>
                                <center>
                                    <button type="button" class="btn" style="border-radius: 10px; background:#2CEE28;" data-target="form_ubah_data_kontak-<?= $kontaks['id_kontak'] ?>">Ubah</button>
                                    <a type="button" class="btn" href="<?= base_url('admin/Dasboards/masterview/masterview_kontak/hapus/' . $kontaks['id_kontak']) ?>" style="border-radius: 10px; background:#F1222E;">Hapus</a>
                                </center>
                            </td>
                        </tr>


                        <!-- Element untuk ubah kontak -->
                        <tr class="model" id="form_ubah_data_kontak-<?= $kontaks['id_kontak'] ?>">
                            <td colspan="10">
                                <div class="Eform">
                                    <p>Ubah Kontak</p>
                                    <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

                                    <form action="<?= base_url('admin/Dasboards/masterview/masterview_kontak/ubah/' . $kontaks['id_kontak']) ?>" method="post" style="margin: 2em;">
                                        <div class="mb-3 row">
                                            <label for="alamat" class="form-label col ">Alamat</label>
                                            <input type="text" name="alamat" class="form-control col" id="alamat" value="<?= $kontaks['alamat'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="tlp" class="form-label col">Telepon/Wa</label>
                                            <input type="text" name="tlp" class="form-control col" id="tlp" value="<?= $kontaks['tlp'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="email" class="form-label col">Email</label>
                                            <input type="text" name="email" class="form-control col" id="email" value="<?= $kontaks['email'] ?>" style="background: rgba(255, 251, 251, 0.59)">
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
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <center>
                        <p>Tidak ada data kontak.</p>
                    </center>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<style>
    #formulir {
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
        top: 15%;
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
        <p>Tambah Kontak</p>
        <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

        <form style="margin: 2em;" action="masterview_kontak" method="post">
            <?= csrf_field(); ?>
            <div class="mb-3 row">
                <label for="alamat" class="form-label col ">Alamat</label>
                <input type="text" name="alamat" class="form-control col" id="alamat" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="tlp" class="form-label col">Telepon/Wa</label>
                <input type="text" name="tlp" class="form-control col" id="tlp" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="email" class="form-label col">Email</label>
                <input type="text" name="email" class="form-control col" id="email" style="background: rgba(255, 251, 251, 0.59)">
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
    if (<?= empty($data_kontak) ? 'true' : 'false' ?>) {
        document.getElementById('tambahkontak').style.display = 'block';
    } else {
        document.getElementById('tambahkontak').style.display = 'none';
    }

    document.getElementById('tambahkontak').addEventListener('click', () => {
        document.getElementById('formulir').style.display = 'block';
    });

    document.getElementById('tutupForm').addEventListener('click', function() {
        document.getElementById('formulir').style.display = 'none';
    });

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