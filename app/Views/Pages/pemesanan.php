<?= $this->extend('Templates/template'); ?>

<?= $this->section('content'); ?>

<div class="row mt-4">
    <center>
        <h1>FORM PEMESANAN</h1>
    </center>
    <div class="row">
        <form action="/pemesanan" method="post">
            <style>
                .mb-3 {
                    width: 55%;
                }
            </style>
            <div class="mb-3 row mt-3">
                <label for="tgl_sewa" class="form-label col">Tanggal Sewa</label>
                <input type="date" name="tgl_sewa" class="form-control col" id="tgl_sewa" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row mt-3">
                <label for="tgl_kbl" class="form-label col">Tanggal Kembali</label>
                <input type="date" name="tgl_kbl" class="form-control col" id="tgl_kbl" style="background: rgba(255, 251, 251, 0.59)">
            </div>
            <div class="mb-3 row mt-3">
                <label for="lamasewa" class="form-label col">Lama Sewa</label>
                <input type="text" class="form-control col" id="lamasewa" style="background: rgba(255, 251, 251, 0.59)" readonly>
            </div>

            <div class="mb-3 row mt-3">
                <label for="totaltarif" class="form-label col">Total Tarif</label>
                <input type="totaltarif" class="form-control col" id="totaltarif" style="background: rgba(255, 251, 251, 0.59)" readonly>
            </div>

            <div class="mb-3 row mt-3">
                <label for="nomor_pengantaran" class="form-label col">No.Tlp/Wa yang Dapat Dihubungi untuk Pengantaran Mobil</label>
                <input type="tel" name="nomor_pengantaran" class="form-control col" id="nomor_pengantaran" placeholder="Masukkan nomor telepon" required style="background: rgba(255, 251, 251, 0.59)">
            </div>
        </form>
        <center>
            <a href="#transaksi" type="button" data-bs-toggle="modal" class="btn mt-5" style="border-radius: 10px;background: #0E138E;color:aliceblue;">Bayar</a>
        </center>
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
                        <ul>
                            <li>Input Bukti Transfer</li>
                            <li><input type="file" name="bukti_transaksi" id="bukti_transaksi"></li>
                        </ul>
                    </table>
                    <center>
                        <button type="button" class="btn mt-5" style="border-radius: 10px;background: #0E138E;color:aliceblue;">Selesai</a>
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
        var lamaSewaInput = document.getElementById('lamasewa');
        var hargaSewaInput = document.getElementById('harga_sewa');
        var totalTarifInput = document.getElementById('totaltarif');

        // Tambahkan event listener untuk memperbarui Lama Sewa ketika Tanggal Sewa atau Tanggal Kembali berubah
        tglSewaInput.addEventListener('change', updateLamaSewa);
        tglKembaliInput.addEventListener('change', updateLamaSewa);

        function updateLamaSewa() {
            var tglSewa = new Date(tglSewaInput.value);
            var tglKembali = new Date(tglKembaliInput.value);

            // Periksa apakah kedua tanggal valid
            if (!isNaN(tglSewa) && !isNaN(tglKembali)) {
                // Hitung selisih dalam hari
                var timeDiff = tglKembali.getTime() - tglSewa.getTime();
                var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                // Perbarui nilai input Lama Sewa
                lamaSewaInput.value = daysDiff > 0 ? daysDiff + " hari" : "0 hari";

                // Hitung total tarif berdasarkan lama sewa dan harga sewa per hari
                var hargaSewa = parseFloat(hargaSewaInput.value);
                var totalTarif = daysDiff * hargaSewa;

                // Perbarui nilai input Total Tarif
                totalTarifInput.value = totalTarif.toFixed(2);
            }
        }
    });
</script>
<?= $this->endSection(); ?>