<?php
$id_user = session('id_user');
$username = session('username');
$role = session('role');

$isUserLoggedIn = $id_user !== null;

// Tambahkan pemeriksaan role pengguna yang diizinkan untuk login di halaman home
$allowedRoles = ['pengguna'];  // Ganti dengan role yang diizinkan
$isAllowedRole = in_array($role, $allowedRoles);
?>

<?= $this->extend('Templates/template'); ?>

<?= $this->section('content'); ?>
<?php if ($isUserLoggedIn && $isAllowedRole) : ?>


    <div class="row mt-4">
        <center>
            <h1>FORM PEMESANAN</h1>
        </center>
        <div class="row">
            <form action=<?= site_url('/pemesanan/proses') ?> method="post">
                <style>
                    .mb-3 {
                        width: 55%;
                    }
                </style>
                <div class="mb-3 row mt-3">
                    <label class="form-label col">Mobil </label>
                    <label class="form-control col" style="background: rgba(255, 251, 251, 0.59)"><?= $data_mobil['mobil'] ?></label>
                </div>
                <div class="mb-3 row mt-3">
                    <label class="form-label col"> Tipe Mobil</label>
                    <label class="form-control col" style="background: rgba(255, 251, 251, 0.59)"><?= $data_mobil['type_mobil'] ?></label>
                </div>
                <div class="mb-3 row mt-3">
                    <label class="form-label col">Transmisi</label>
                    <label class="form-control col" style="background: rgba(255, 251, 251, 0.59)"><?= $data_mobil['transmisi'] ?></label>
                </div>
                <div class="mb-3 row mt-3">
                    <label class="form-label col">Kapasitas Penumpang</label>
                    <label class="form-control col" style="background: rgba(255, 251, 251, 0.59)"><?= $data_mobil['kapasitas_penumpang'] ?></label>
                </div>


                <!-- Input hidden untuk menyimpan id_pengguna -->
                <input type="hidden" name="id_pengguna" value="<?= isset($data_klien['id_pengguna']) ? $data_klien['id_pengguna'] : (isset($user['id_pengguna']) ? $user['id_pengguna'] : '') ?>">

                <!-- Input hidden untuk menyimpan id_mobil -->
                <input type="hidden" name="id_mobil" value="<?= $data_mobil['id_mobil'] ?>">

                <!-- Input hidden untuk menyimpan id_pemilik -->
                <input type="hidden" name="id_pemilik" value="<?= $id_pemilik ?>">

                <div class="mb-3 row mt-3">
                    <label for="harga_sewa" class="form-label col">Harga Sewa per Hari</label>
                    <label name="harga_sewa" class="form-control col" id="harga_sewa" style="background: rgba(255, 251, 251, 0.59)"><?= $data_mobil['harga_sewa'] ?></label>
                </div>
                <div class="mb-3 row mt-3">
                    <label for="tgl_sewa" class="form-label col">Tanggal Sewa</label>
                    <input type="date" name="tgl_sewa" class="form-control col" id="tgl_sewa" style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <div class="mb-3 row mt-3">
                    <label for="tgl_kbl" class="form-label col">Tanggal Kembali</label>
                    <input type="date" name="tgl_kbl" class="form-control col" id="tgl_kbl" style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <div class="mb-3 row mt-3">
                    <label for="lama_sewa" class="form-label col">Lama Sewa</label>
                    <input type="text" name="lama_sewa" class="form-control col" id="lama_sewa" style="background: rgba(255, 251, 251, 0.59)" readonly>
                </div>

                <div class="mb-3 row mt-3">
                    <label for="total_harga_sewa" class="form-label col">Total Tarif</label>
                    <input type="text" name="total_harga_sewa" class="form-control col" id="total_harga_sewa" style="background: rgba(255, 251, 251, 0.59)" readonly>
                </div>

                <div class="mb-3 row mt-3">
                    <label for="nomor_pengantaran" class="form-label col">No.Tlp/Wa yang Dapat Dihubungi untuk Pengantaran Mobil</label>
                    <input type="text" name="nomor_pengantaran" class="form-control col" id="nomor_pengantaran" placeholder="Masukkan nomor telepon" required style="background: rgba(255, 251, 251, 0.59)">
                </div>
                <center>
                    <!-- <a href="#transaksi" type="button" data-bs-toggle="modal" class="btn mt-5" style="border-radius: 10px;background: #0E138E;color:aliceblue;">Bayar</a> -->
                    <button type="submit" class="btn mt-5" style="border-radius: 10px;background: #0E138E;color:aliceblue;">Bayar</button>
                </center>
            </form>
        </div>
        <div class="modal fade" id="transaksi" aria-hidden="true" tabindex="-1" role="dialog" aria-labelledby="headerbayar">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="headerbayar">Pembayaran</h1>
                    </div>
                    <div class="modal-body">
                        <table>
                            <ul>
                                <li>Nama Bank: BCA</li>
                                <li>Norek : 095XXXX</li>
                                <li>Nama :EasyRent</li>
                            </ul>
                            <!-- <ul>
                                <li>Input Bukti Transfer</li>
                                <li><input type="file" name="bukti_transaksi" id="bukti_transaksi"></li>
                            </ul> -->
                        </table>
                        <center>
                            <button type="button" class="btn mt-5" id="tombol-selesai" style="border-radius: 10px;background: #0E138E;color:aliceblue;">Selesai</a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen input untuk Tanggal Sewa, Tanggal Kembali, dan Lama Sewa
            var tglSewaInput = document.getElementById('tgl_sewa');
            var tglKembaliInput = document.getElementById('tgl_kbl');
            var lamaSewaInput = document.getElementById('lama_sewa');
            var hargaSewaInput = document.getElementById('harga_sewa');
            var totalhargasewaInput = document.getElementById('total_harga_sewa');

            // Tambahkan event listener untuk memperbarui Lama Sewa dan Total Tarif ketika Tanggal Sewa atau Tanggal Kembali berubah
            tglSewaInput.addEventListener('change', updateLamaSewaAndTotalTarif);
            tglKembaliInput.addEventListener('change', updateLamaSewaAndTotalTarif);

            function updateLamaSewaAndTotalTarif() {
                var tglSewa = new Date(tglSewaInput.value);
                var tglKembali = new Date(tglKembaliInput.value);

                // Periksa apakah kedua tanggal valid
                if (!isNaN(tglSewa) && !isNaN(tglKembali)) {
                    // Hitung selisih dalam hari
                    var timeDiff = tglKembali.getTime() - tglSewa.getTime();
                    var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                    // Perbarui nilai input Lama Sewa
                    lamaSewaInput.value = daysDiff > 0 ? daysDiff + " hari" : "0 hari";

                    // Hitung total tarif berdasarkan lama sewa dan harga sewa per hari dari input
                    var hargaSewa = <?= $data_mobil['harga_sewa'] ?>;
                    var totalhargasewa = daysDiff * hargaSewa;

                    // Perbarui nilai input Total Tarif
                    totalhargasewaInput.value = totalhargasewa.toFixed(2);
                }
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan event listener untuk tombol "Selesai"
            const buttonSelesai = document.getElementById('tombol-selesai');
            buttonSelesai.addEventListener('click', function() {
                window.location.href = '<?= base_url('pemesanan/proses') ?>'; // Ganti URL dengan yang sesuai
            });
        });
    </script>
<?php endif; ?>
<?= $this->endSection(); ?>