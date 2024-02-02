<?= $this->extend('Templates/template'); ?>

<?= $this->section('content'); ?>
<style>
    .card {
        background-color: #ff4c00;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Informasi Akun</h2>
                </div>
                <?php foreach ($data_klien as $pengguna) : ?>
                    <div class="card-body">
                        <img src="/Assets/1704805752_c164459b72286db14ef8.jpeg" alt="Profile Picture" class="img-fluid mb-3">
                        <p><strong>Nama:</strong> <?= $pengguna['nama'] ?></p>
                        <p><strong>Email:</strong> <?= $pengguna['email'] ?></p>
                        <p><strong>No.Telepon:</strong> <?= $pengguna['tlp'] ?></p>
                        <p><strong>No.KTP:</strong> <?= $pengguna['noktp'] ?></p>
                        <p><strong>Jenis Kelamin:</strong> <?= $pengguna['gender'] ?></p>
                        <p><strong>Alamat:</strong> <?= $pengguna['alamat'] ?></p>
                        <a href="#editProfileModal-<?= $pengguna['id_pengguna'] ?>" data-bs-toggle="modal" class="btn btn-primary">Edit Profil</a>
                    </div>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="editProfileModal-<?= $pengguna['id_pengguna'] ?>" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profil <?= $pengguna['id_pengguna'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('/akun/ubah/' . $pengguna['id_pengguna']) ?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Pengguna</label>
                                            <input type="text" name="nama" class="form-control" id="nama" value="<?= $pengguna['nama'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" value="<?= $pengguna['email'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tlp" class="form-label">No.Telepon</label>
                                            <input type="text" name="tlp" class="form-control" id="tlp" value="<?= $pengguna['tlp'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="noktp" class="form-label">No.KTP</label>
                                            <input type="text" name="noktp" class="form-control" id="noktp" value="<?= $pengguna['noktp'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Jenis Kelamin</label>
                                            <input type="text" name="gender" class="form-control" id="gender" value="<?= $pengguna['gender'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea name="alamat" class="form-control" id="alamat" rows="4"><?= $pengguna['alamat'] ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="fotoktp" class="form-label">Foto Profil</label>
                                            <input type="file" name="fotoktp" class="form-control" id="fotoktp">
                                        </div>
                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Pengaturan Akun</h2>
                </div>
                <div class="card-body">
                    <?php foreach ($user as $users) : ?>
                        <form action="<?= base_url('/akun/pengaturan/ubah/' . $users['id_user']) ?>" method="post">
                            <div class=" mb-3">
                                <label for="username" class="form-label">Ubah Username</label>
                                <input type="username" name="username" class="form-control" id="username" placeholder="Masukkan username baru" value="<?= $users['username'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Ubah Password</label>
                                <input type="text" name="password" class="form-control" id="password" placeholder="Masukkan password baru" value="<?= $users['password'] ?>">
                            </div>
                            <button type="submit" class="btn btn-success">Simpan Pengaturan</button>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->endSection(); ?>