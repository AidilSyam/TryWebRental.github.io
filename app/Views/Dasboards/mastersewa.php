<?= $this->extend('Template_dasboards/TDasboard2'); ?>

<?= $this->section('content'); ?>

<ul class="list-unstyled mt-3 ms-3">
    <li>
        <h4>Master Sewa</h4>
    </li>
    <li class="ms-2">
        <p>Data Sewa</p>
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
                    <h6>Daftar Sewa</h6>
                </thead>
                <tbody class=" table-group-divider" style="background-color: transparent">
                    <tr style="text-align: center;">
                        <th scope="col">No.</th>
                        <th scope="col">Kode Sewa</th>
                        <th scope="col">ID Pengguna/ Nama</th>
                        <th scope="col">ID Mobil (mobil)</th>
                        <th scope="col">ID Pemilik (nama)</th>
                        <th scope="col">Tanggal Sewa</th>
                        <th scope="col">Tanggal Kembali</th>
                        <th scope="col">
                            <center>Aksi</center>
                        </th>
                    </tr>
                    <?php $key = 1;
                    foreach ($data_sewa as $sewa) : ?>
                        <tr style="text-align: center;">
                            <th scope="row"><?= $key++ ?></th>
                            <td><?= $sewa['kode_sewa'] ?></td>
                            <td><?= $sewa['id_pengguna'] ?></td>
                            <td><?= $sewa['id_mobil'] ?> </td>
                            <td><?= $sewa['id_pemilik'] ?></td>
                            <td><?= $sewa['tgl_sewa'] ?></td>
                            <td><?= $sewa['tgl_kbl'] ?></td>
                            <td>
                                <center>
                                    <a type="button" class="btn" data-target="form_detail_sewa-<?= $sewa['kode_sewa'] ?>" style="border-radius: 10px; background:#392BD8;">lihat</a>
                                    <button type="button" class="btn" data-target="form_ubah_data_sewa-<?= $sewa['kode_sewa'] ?>" style="border-radius: 10px; background:#2CEE28;">Ubah</button>
                                </center>
                            </td>
                        </tr>
                        <!-- Element untuk lihat detail sewa -->
                        <tr class="model" id="form_detail_sewa-<?= $sewa['kode_sewa'] ?>">
                            <td colspan="10">
                                <div class="Eform">
                                    <center>
                                        <p>Detail Sewa</p>
                                    </center>
                                    <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>
                                    <form style="margin: 2em;">
                                        <div class="mb-3 row">
                                            <label class="form-label col ">Kode Sewa</label>
                                            <label class="form-label col "><?= $sewa['kode_sewa'] ?></label>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="form-label col ">ID Pelanggan nama</label>
                                            <label class="form-label col "><?= $sewa['id_pengguna'] ?></label>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="form-label col ">Mobil</label>
                                            <label class="form-label col "><?= $sewa['id_mobil'] ?></label>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="form-label col ">No Polisi</label>
                                            <label class="form-label col ">....</label>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="form-label col ">Tanggal Sewa</label>
                                            <label class="form-label col "><?= $sewa['tgl_sewa'] ?></label>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="form-label col ">Tanggal Kembali</label>
                                            <label class="form-label col "><?= $sewa['tgl_kbl'] ?></label>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <center>
                                                    <button type="close" class="btn" style="border-radius: 10px; background:#F1222E;" id="tutupForm">Close</button>
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

<script>
    document.getElementById('tutupForm').addEventListener('click', function() {
        document.getElementById('.model').style.display = 'none';
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