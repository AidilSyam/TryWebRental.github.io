<?= $this->extend('Template_dasboards/TDasboard2'); ?>

<?= $this->section('content'); ?>

<ul class="list-unstyled mt-3 ms-3">
    <li>
        <h4>Master Lacak</h4>
    </li>
    <li class="ms-2">
        <p>Data Monitoring</p>
    </li>
    <li class="ms-2">
        <button class="btn" id="tambah" style="background: #D9D9D9;color:black;"><i class="bi bi-plus-square-fill"></i> Tambah</button>
    </li>
</ul>
<div class="card mt-5" style="background: #D9D9D9;">
    <div class="card-body">
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
        <div class="table-responsive">
            <table class="table" style="background-color: transparent">
                <thead>
                    <h6>Daftar Perangkat</h6>
                </thead>
                <tbody class="table-group-divider" style="background-color: transparent">
                    <?php $key = 1;
                    foreach ($data_lacak as $lacak) : ?>
                        <tr style="text-align: center;">
                            <th scope="col">No.</th>
                            <th scope="col">ID Perangkat</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">No Polisi</th>
                            <th scope="col">
                                <center>Aksi</center>
                            </th>
                        </tr>

                        <tr style="text-align: center;">
                            <th scope="row"><?= $key++ ?></th>
                            <td><?= $lacak['id_lacak'] ?></td>
                            <td><?= $lacak['waktu'] ?></td>
                            <td><?= $lacak['latitude'] ?></td>
                            <td><?= $lacak['longitude'] ?></td>
                            <td><?= $lacak['id_mobil'] ?></td>
                            <td>
                                <center>
                                    <button type="ubah" class="btn" style="border-radius: 10px; background:#2CEE28;" id="ubahdataperangkat">Ubah</button>
                                    <button type="hapus" class="btn" style="border-radius: 10px; background:#F1222E;">Hapus</button>
                                    <a href="/Dasboards/posisikendaraan" class="btn" style="border-radius: 10px; background:#392BD8;">Lihat</a>
                                </center>
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

    #form_ubah_data_perangkat {
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
        left: 40%;
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
        <p>Tambah Perangkat</p>
        <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

        <form style="margin: 2em;">
            <div class="mb-3 row">
                <label for="InputIdPerangkat" class="form-label col ">ID Perangkat</label>
                <input type="idperangkat" class="form-control col" id="InputIdPerangkat" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="InputWaktu" class="form-label col">Waktu</label>
                <input type="waktu" class="form-control col" id="InputWaktu" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="InputLatitude" class="form-label col">Latitude</label>
                <input type="latitude" class="form-control col" id="InputLatitude" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="InputLongitude" class="form-label col">Longitude</label>
                <input type="longitude" class="form-control col" id="InputLongitude" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="InputKapasitasPenumpang" class="form-label col">Kapasitas Penumpang</label>
                <input type="kapasitaspenumpang" class="form-control col" id="InputKapasitasPenumpang" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="InputNoPolisi" class="form-label col">No Polisi</label>
                <input type="nopolisi" class="form-control col" id="InputNoPolisi" style="background: rgba(255, 251, 251, 0.59)">
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

<!-- Element untuk ubah data Perangkat -->
<div id="form_ubah_data_perangkat">
    <div class="Eform">
        <p>Ubah Perangkat</p>
        <div style="border:none;height: 1px;margin: 20px 0; background-color:black;"></div>

        <form style="margin: 2em;">
            <div class="mb-3 row">
                <label for="InputIdPerangkat" class="form-label col ">ID Perangkat</label>
                <input type="idperangkat" class="form-control col" id="InputIdPerangkat" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="InputWaktu" class="form-label col">Waktu</label>
                <input type="waktu" class="form-control col" id="InputWaktu" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="InputLatitude" class="form-label col">Latitude</label>
                <input type="latitude" class="form-control col" id="InputLatitude" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="InputLongitude" class="form-label col">Longitude</label>
                <input type="longitude" class="form-control col" id="InputLongitude" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="InputKapasitasPenumpang" class="form-label col">Kapasitas Penumpang</label>
                <input type="kapasitaspenumpang" class="form-control col" id="InputKapasitasPenumpang" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row">
                <label for="InputNoPolisi" class="form-label col">No Polisi</label>
                <input type="nopolisi" class="form-control col" id="InputNoPolisi" style="background: rgba(255, 251, 251, 0.59)">
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

<!--Element Melihat Posisi Kendaraan -->
<style>
    .container {
        padding-bottom: 1em;
        padding-top: 1em;
        position: fixed;
        top: 10%;
        left: 2%;
        width: 100%;
        height: 80vh;
        flex-shrink: 0;
        background-color: white;
        display: none;
    }
</style>
<div class="container" id="posisikendaraan">
    <ul class="list-unstyled mt-3 ms-3">
        <li>
            <h4>Monitoring Posisi Kendaraan</h4>
        </li>
    </ul>

    <div class="card mt-5 w-70" style="background: #D9D9D9;">
        <div class="card-body">

            <p>maps</p>
        </div>
    </div>
</div>

<script>
    document.getElementById('tambah').addEventListener('click', () => {
        document.getElementById('formulir').style.display = 'block';
    });

    document.getElementById('tutupForm').addEventListener('click', function() {
        document.getElementById('formulir').style.display = 'none';
    });

    document.getElementById('ubahdataperangkat').addEventListener('click', () => {
        document.getElementById('form_ubah_data_perangkat').style.display = 'block';
    });
</script>

<?= $this->endSection(); ?>