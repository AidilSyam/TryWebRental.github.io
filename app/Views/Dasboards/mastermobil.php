<?= $this->extend('Template_dasboards/TDasboard2'); ?>

<?= $this->section('content'); ?>

<ul class="list-unstyled mt-3 ms-3">
    <li>
        <h4>Master Mobil</h4>
    </li>
    <li class="ms-2">
        <p>Data Mobil</p>
    </li>
    <li class="ms-2">
        <button class="btn" id="tambahmobil" style="background: #D9D9D9;color:black;"><i class="bi bi-plus-square-fill"></i> Tambah Mobil</button>
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
            <table class="table">
                <thead>
                    <h6>Daftar Mobil</h6>
                </thead>
                <tbody class=" table-group-divider" style="background-color: transparent">
                    <?php if (!empty($data_mobil)) : ?>
                        <tr style="text-align: center;">
                            <th scope="col">No.</th>
                            <th scope="col">ID</th>
                            <th scope="col">No.Polisi</th>
                            <th scope="col">Mobil</th>
                            <th scope="col">Type Mobil</th>
                            <th scope="col">Transmisi</th>
                            <th scope="col">Kapasitas Penumpang</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tarif Harga</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Id Pemilik</th>
                            <th scope="col">
                                <center>Aksi</center>
                            </th>
                        </tr>

                        <?php $key = 1;
                        foreach ($data_mobil as $mobils) : ?>
                            <tr style="text-align: center;">
                                <th scope="row"><?= $key++ ?></th>
                                <td><?= $mobils['id_mobil'] ?></td>
                                <td><?= $mobils['no_polisi'] ?></td>
                                <td><?= $mobils['mobil'] ?></td>
                                <td><?= $mobils['type_mobil'] ?></td>
                                <td><?= $mobils['transmisi'] ?></td>
                                <td><?= $mobils['kapasitas_penumpang'] ?></td>
                                <td>tersedia/kosong</td>
                                <td><?= $mobils['harga_sewa'] ?></td>
                                <td>
                                    <?php if ($mobils['foto_mbl']) : ?>
                                        <img src="<?= base_url('Assets/' . $mobils['foto_mbl']) ?>" alt="Foto Mobil" style="max-width: 100px; max-height: 100px;">
                                    <?php else : ?>
                                        Tidak Ada Gambar
                                    <?php endif; ?>
                                </td>

                                <td><?= $mobils['id_pemilik'] ?></td>
                                <td>
                                    <center>
                                        <button type=" button" class="btn" data-target="form_ubah_data_mobil-<?= $mobils['id_mobil'] ?>" style="border-radius: 10px; background:#2CEE28;">Ubah</button>
                                        <a type="button" class="btn" href="<?= base_url('admin/Dasboards/mastermobil/hapus/' . $mobils['id_mobil']) ?>" style="border-radius: 10px; background:#F1222E;">Hapus</a>
                                    </center>
                                </td>
                            </tr>
                            <!-- Element untuk ubah mobile -->

                            <tr class="model" id="form_ubah_data_mobil-<?= $mobils['id_mobil'] ?>">
                                <td colspan="10">
                                    <div class="Eform">
                                        <p>Ubah Mobil</p>

                                        <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

                                        <form action="<?= base_url('admin/Dasboards/mastermobil/ubah/' . $mobils['id_mobil']) ?>" method="post" style="margin: 2em;" enctype="multipart/form-data">
                                            <div class="mb-3 row">
                                                <label for="no_polisi" class="form-label col">No.Polisi</label>
                                                <input type="text" class="form-control col" id="no_polisi" name="no_polisi" value="<?= $mobils['no_polisi'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="mobil" class="form-label col">Mobil</label>
                                                <input type="text" class="form-control col" id="mobil" name="mobil" value="<?= $mobils['mobil'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                            </div>
                                            <!-- Tambahkan input untuk field lainnya sesuai kebutuhan -->
                                            <div class="mb-3 row">
                                                <label for="type_mobil" class="form-label col">Type Mobil</label>
                                                <input type="text" class="form-control col" id="type_mobil" name="type_mobil" value="<?= $mobils['type_mobil'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="transmisi" class="form-label col">Transmisi</label>
                                                <input type="text" class="form-control col" id="transmisi" name="transmisi" value="<?= $mobils['transmisi'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="kapasitas_penumpang" class="form-label col">Kapasitas Penumpang</label>
                                                <input type="text" class="form-control col" id="kapasitas_penumpang" name="kapasitas_penumpang" value="<?= $mobils['kapasitas_penumpang'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="harga_sewa" class="form-label col">Tarif Harga</label>
                                                <input type="text" class="form-control col" id="harga_sewa" name="harga_sewa" value="<?= $mobils['harga_sewa'] ?>" style="background: rgba(255, 251, 251, 0.59)">
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="foto_mbl" class="form-label col">Upload Foto Mobil</label>
                                                <div class="form-control col">
                                                    <div class="row">
                                                        <?php if ($mobils['foto_mbl']) : ?>
                                                            <img src="<?= base_url('Assets/' . $mobils['foto_mbl']) ?>" alt="Foto Mobil" style="max-width: 100px; max-height: 100px;">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="row">
                                                        <input type="file" class="form-control" id="foto_mbl" name="foto_mbl" style="background: rgba(255, 251, 251, 0.59)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="id_pemilik" class="form-label col">Id Pemilik</label>
                                                <select name="id_pemilik" class="form-control col" id="id_pemilik" style="background: rgba(255, 251, 251, 0.59)">
                                                    <?php foreach ($data_pemilik_kendaraan as $pemilik) : ?>
                                                        <option value=" <?= $pemilik['id_pemilik'] ?>"><?= $pemilik['id_pemilik'] ?> (<?= $pemilik['nama'] ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
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
                    <?php else : ?>
                        <center>
                            <p>Tidak ada data mobil.</p>
                        </center>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
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
        top: 7.5%;
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
        <p>Tambah Mobil</p>
        <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

        <form style="margin: 2em;" action="mastermobil" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="mb-3 row">
                <label for="no_polisi" class="form-label col ">No.Polisi</label>
                <input type="text" name="no_polisi" class="form-control col" id="no_polisi" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="mobil" class="form-label col">Mobil</label>
                <input type="text" name="mobil" class="form-control col" id="mobil" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="type_mobil" class="form-label col">Type Mobil</label>
                <input type="text" name="type_mobil" class="form-control col" id="type_mobil" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="transmisi" class="form-label col">Transmisi</label>
                <input type="text" name="transmisi" class="form-control col" id="transmisi" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="kapasitas_penumpang" class="form-label col">Kapasitas Penumpang</label>
                <input type="text" name="kapasitas_penumpang" class="form-control col" id="kapasitas_penumpang" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <!--<div class="mb-3 row">
                <label for="status" class="form-label col">Status</label>
                <input type="text" name="status" class="form-control col" id="status" style="background: rgba(255, 251, 251, 0.59)">
            </div>-->
            <div class="mb-3 row">
                <label for="harga_sewa" class="form-label col">Tarif Harga</label>
                <input type="text" name="harga_sewa" class="form-control col" id="harga_sewa" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="foto_mbl" class="form-label col">Upload Foto Mobil</label>
                <input type="file" name="foto_mbl" class="form-control col" id="foto_mbl" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="id_pemilik" class="form-label col">ID Pemilik</label>

                <select name="id_pemilik" class="form-control col" id="id_pemilik" style="background: rgba(255, 251, 251, 0.59)">
                    <?php foreach ($data_pemilik_kendaraan as $pemilik) : ?>
                        <option value="<?= $pemilik['id_pemilik'] ?>"><?= $pemilik['id_pemilik'] ?>(<?= $pemilik['nama'] ?>)</option>
                    <?php endforeach; ?>
                </select>
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
    document.getElementById('tambahmobil').addEventListener('click', () => {
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