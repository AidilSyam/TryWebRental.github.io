<?= $this->extend('Template_dasboards/TDasboard2'); ?>

<?= $this->section('content'); ?>

<ul class="list-unstyled mt-3 ms-3">
    <li>
        <h4>Master View</h4>
    </li>
    <li class="ms-2">
        <p>Data Galery</p>
    </li>
</ul>

<div class="row">
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

        .row {
            width: 100%;
        }

        .col {
            width: 45%;
        }
    </style>

    <!-- Element testimoni foto-->
    <div class="col">
        <div class="card" style="background: #D9D9D9;">
            <div class="card-body">
                <table class="table" style="background-color: transparent">
                    <thead>
                        <div class="row justify-content-between">
                            <div class="col text-start">
                                <h6>Daftar Foto Testimoni</h6>
                            </div>
                            <div class="col text-end">
                                <button type="tambah" class="btn" style="border-radius: 10px; background:#392BD8;" id="tambahdatatestimoni">Tambah</button>
                            </div>
                        </div>
                    </thead>
                    <tbody class="table-group-divider" style="background-color: transparent">
                        <tr style="text-align: center;">
                            <th scope="col">No.</th>
                            <th scope="col">Foto Testimoni</th>
                            <th scope="col">
                                <center>Aksi</center>
                            </th>
                        </tr>

                        <?php $key = 1;
                        foreach ($data_galery as $galery) : ?>
                            <tr style="text-align: center;">
                                <th scope="row"><?= $key++ ?></th>
                                <td>
                                    <?php if ($galery['foto']) : ?>
                                        <img src="<?= base_url('Assets/' . $galery['foto']) ?>" alt="Foto" style="max-width: 50px; max-height: 500px;">
                                    <?php else : ?>
                                        Tidak Ada Gambar
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <center>
                                        <button type="ubah" class="btn" style="border-radius: 10px; background:#2CEE28;" id="ubahdatatestimoni">Ubah</button>
                                        <button type="hapus" class="btn" style="border-radius: 10px; background:#F1222E;">Hapus</button>
                                    </center>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Element Video -->
    <div class="col">
        <div class="card" style="background: #D9D9D9;">
            <div class="card-body">
                <table class="table" style="background-color: transparent">
                    <thead>
                        <div class="row justify-content-between">
                            <div class="col text-start">
                                <h6>Daftar Video</h6>
                            </div>
                            <div class="col text-end">
                                <button type="tambah" class="btn" style="border-radius: 10px; background:#392BD8;" id="tambahdatavideo">Tambah</button>
                            </div>
                        </div>
                    </thead>
                    <tbody class="table-group-divider" style="background-color: transparent">
                        <tr style="text-align: center;">
                            <th scope="col">No.</th>
                            <th scope="col">Video</th>
                            <th scope="col">
                                <center>Aksi</center>
                            </th>
                        </tr>
                        <?php $key = 1;
                        foreach ($data_galery as $galery) : ?>
                            <tr style="text-align: center;">
                                <th scope="row"><?= $key++ ?></th>
                                <td>
                                    <?php if ($galery['video']) : ?>
                                        <video src="<?= base_url('Assets/' . $galery['video']) ?>" alt="video" style="max-width: 100px; max-height: 100px;">
                                        <?php else : ?>
                                            Tidak Ada Video
                                        <?php endif; ?>
                                </td>
                                <td>
                                    <center>
                                        <button type="ubah" class="btn" style="border-radius: 10px; background:#2CEE28;" id="ubahdatavideo">Ubah</button>
                                        <button type="hapus" class="btn" style="border-radius: 10px; background:#F1222E;">Hapus</button>
                                    </center>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    #formulir,
    #formulir1 {
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

    #form_ubah_data_testimoni,
    #form_ubah_data_video {
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

    .Eform,
    .Eform1 {
        padding-bottom: 1em;
        padding-top: 1em;
        border-radius: 10px;
        position: absolute;
        top: 15%;
        left: 40%;
        width: 35%;
        height: auto !important;
        flex-shrink: 0;
        border-radius: 15px;
        background: #E7E2E2;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    }
</style>

<!-- Element untuk tambah testimoni Foto-->
<div id="formulir">
    <div class="Eform">
        <p>Tambah Data Foto Testimoni</p>
        <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

        <form style="margin: 2em;" action="masterview_galery" method="post" enctype="multipart/form-data">
            <div class="mb-3 row">
                <label for="foto" class="form-label col">Upload Foto</label>
                <input type="file" class="form-control col" name="foto" id="foto" style="background: rgba(255, 251, 251, 0.59)">
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

<!-- Element untuk ubah testimoni Foto -->
<div id="form_ubah_data_testimoni">
    <div class="Eform">
        <p>Ubah Data Foto Testimoni</p>
        <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

        <form style="margin: 2em;">
            <div class="mb-3 row">
                <label for="foto" class="form-label col">Upload Foto</label>
                <input type="file" class="form-control col" id="foto" style="background: rgba(255, 251, 251, 0.59)">
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

<!-- Element untuk tambah video -->
<div id="formulir1">
    <div class="Eform1">
        <p>Tambah Data Video</p>
        <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

        <form style="margin: 2em;">
            <div class="mb-3 row">
                <label for="video" class="form-label col">Upload Video</label>
                <input type="file" class="form-control col" id="video" style="background: rgba(255, 251, 251, 0.59)">
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

<!-- Element untuk ubah testimoni -->
<div id="form_ubah_data_video">
    <div class="Eform1">
        <p>Ubah Data Video</p>
        <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

        <form style="margin: 2em;">
            <div class="mb-3 row">
                <label for="video" class="form-label col">Upload Video</label>
                <input type="file" class="form-control col" id="video" style="background: rgba(255, 251, 251, 0.59)">
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
    document.getElementById('tambahdatatestimoni').addEventListener('click', () => {
        document.getElementById('formulir').style.display = 'block';
    });

    document.getElementById('tutupForm').addEventListener('click', function() {
        document.getElementById('formulir').style.display = 'none';
    });

    document.getElementById('ubahdatatestimoni').addEventListener('click', () => {
        document.getElementById('form_ubah_data_testimoni').style.display = 'block';
    });


    document.getElementById('tambahdatavideo').addEventListener('click', () => {
        document.getElementById('formulir1').style.display = 'block';
    });

    document.getElementById('tutupForm').addEventListener('click', function() {
        document.getElementById('formulir1').style.display = 'none';
    });

    document.getElementById('ubahdatavideo').addEventListener('click', () => {
        document.getElementById('form_ubah_data_video').style.display = 'block';
    });
</script>

<?= $this->endSection(); ?>