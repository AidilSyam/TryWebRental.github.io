<?= $this->extend('Template_dasboards/TDasboard2'); ?>

<?= $this->section('content'); ?>

<ul class="list-unstyled mt-3 ms-3">
    <li>
        <h4>Master View</h4>
    </li>
    <li class="ms-2">
        <p>Data Profil</p>
    </li>
    <li class="ms-2">
        <button class="btn" id="tambahprofil" style="background: #D9D9D9;color:black;"><i class="bi bi-plus-square-fill"></i> Tambah</button>
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
        /* Aturan untuk perangkat desktop 
        @media (min-width: 601px) {
            .card {
                width: 50%;
            }
        }*/

        /* Aturan untuk perangkat mobile (Android, iOS, dll.) */
        @media (max-width: 600px) {
            .card {
                width: 100%;
            }
        }

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
        <table class="table" style="background-color: transparent">
            <thead>
                <h6>Profil</h6>
            </thead>
            <tbody class="table-group-divider" style="background-color: transparent">
                <tr style="text-align: center;">
                    <th scope="col">Teks</th>
                    <th scope="col">Foto</th>
                    <th scope="col">
                        <center>Aksi</center>
                    </th>
                </tr>
                <?php foreach ($data_profil as $profils) : ?>
                    <tr>
                        <td><?= $profils['text'] ?></td>
                        <td>
                            <?php if ($profils['foto']) : ?>
                                <img src="<?= base_url('Assets/' . $profils['foto']) ?>" alt="Foto" style="max-width: 100px; max-height: 100px;">
                            <?php else : ?>
                                Tidak Ada Gambar
                            <?php endif; ?>
                        </td>
                        <td>
                            <center>
                                <button type="button" class="btn" data-target="form_ubah_data_profil-<?= $profils['id_profil'] ?>" style="border-radius: 10px; background:#2CEE28;">Ubah</button>
                                <a type="button" class="btn" href="<?= base_url('admin/Dasboards/masterview/masterview_profil/hapus/' . $profils['id_profil']) ?>" style="border-radius: 10px; background:#F1222E;">Hapus</a>
                            </center>
                        </td>
                    </tr>
                    <!-- Element untuk ubah profil -->
                    <tr class="model" id="form_ubah_data_profil-<?= $profils['id_profil'] ?>">
                        <td colspan="10">
                            <div class="Eform">
                                <p>Ubah Profil</p>
                                <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

                                <form action="<?= base_url('admin/Dasboards/masterview/masterview_profil/ubah/' . $profils['id_profil']) ?>" method="post" style="margin: 2em;" enctype="multipart/form-data">
                                    <div class="mb-3 row">
                                        <label for="text" class="form-label col ">Teks</label>
                                        <textarea name="text" class="form-control col" id="text" style="background: rgba(255, 251, 251, 0.59); height:30vh;"><?= $profils['text'] ?></textarea>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="foto" class="form-label col">Upload Foto</label>
                                        <div class="form-control col">
                                            <div class="row">
                                                <?php if ($profils['foto']) : ?>
                                                    <img src="<?= base_url('Assets/' . $profils['foto']) ?>" alt="Foto" style="max-width: 100px; max-height: 100px;">
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <input type="file" class="form-control" id="foto" name="foto" style="background: rgba(255, 251, 251, 0.59)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <center>
                                                <button type="close" class="btn" style="border-radius: 10px; background:#F1222E;" id="tutupForm">Close</button>
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
</style>

<!-- Element untuk tambah mobile -->
<div id="formulir">
    <div class="Eform">
        <p>Tambah Profil</p>
        <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

        <form style="margin: 2em;" action="masterview_profil" method="post" enctype="multipart/form-data">
            <div class="mb-3 row">
                <label for="text" class="form-label col ">Teks</label>
                <textarea class="form-control col" name="text" id="text" style="background: rgba(255, 251, 251, 0.59); height:30vh;"></textarea>
            </div>
            <div class="mb-3 row">
                <label for="foto" class="form-label col">Upload Foto</label>
                <input type="file" name="foto" class="form-control col" id="foto" style="background: rgba(255, 251, 251, 0.59)">
            </div>

            <div class="row">
                <div class="col">
                    <center>
                        <button type="close" class="btn" style="border-radius: 10px; background:#F1222E;" id="tutupForm">Close</button>
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
    if (<?= empty($data_profil) ? 'true' : 'false' ?>) {
        document.getElementById('tambahprofil').style.display = 'block';
    } else {
        document.getElementById('tambahprofil').style.display = 'none';
    }

    document.getElementById('tambahprofil').addEventListener('click', () => {
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