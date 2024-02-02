<?= $this->extend('Template_dasboards/Template_Pemilik'); ?>

<?= $this->section('content'); ?>

<ul class="list-unstyled mt-3 ms-3">
    <li class="ms-2">
        <?php
        if (session()->getFlashData('success')) {
        ?>
            <?= session()->getFlashData('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <?php
        }
        ?>
    </li>
</ul>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card" style="background: #D9D9D9;">
                <style>
                    @media (max-width: 600px) {
                        .card-body {
                            overflow: scroll;
                        }
                    }
                </style>

                <div class="card-header">
                    <h2>Informasi Akun</h2>
                </div>
                <?php foreach ($data_pemilik_kendaraan as $pemilik) : ?>
                    <div class="card-body">
                        <img src="/Assets/1704805752_c164459b72286db14ef8.jpeg" alt="Profile Picture" class="img-fluid mb-3">
                        <p><strong>Nama:</strong> <?= $pemilik['nama'] ?></p>
                        <p><strong>Email:</strong> <?= $pemilik['email'] ?></p>
                        <p><strong>No.Telepon:</strong> <?= $pemilik['tlp'] ?></p>
                        <p><strong>No.KTP:</strong> <?= $pemilik['noktp'] ?></p>
                        <p><strong>Jenis Kelamin:</strong> <?= $pemilik['gender'] ?></p>
                        <p><strong>Alamat:</strong> <?= $pemilik['alamat'] ?></p>

                        <!-- <a type="button" data-bs-toggle="modal" class="btn btn-primary">Edit Profil</a> -->
                        <button type="button" data-bs-toggle="modal" data-bs-target="#editProfileModal-<?= $pemilik['id_pemilik'] ?>" class="btn btn-primary">Edit Profil</button>



                        <div class="modal fade" id="editProfileModal-<?= $pemilik['id_pemilik'] ?>" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profil <?= $pemilik['id_pemilik'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url('/pemilik/V_Pemilik/akun1/ubah/' . $pemilik['id_pemilik']) ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Pengguna</label>
                                                <input type="text" name="nama" class="form-control" id="nama" value="<?= $pemilik['nama'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" value="<?= $pemilik['email'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tlp" class="form-label">No.Telepon</label>
                                                <input type="text" name="tlp" class="form-control" id="tlp" value="<?= $pemilik['tlp'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="noktp" class="form-label">No.KTP</label>
                                                <input type="text" name="noktp" class="form-control" id="noktp" value="<?= $pemilik['noktp'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                                <input type="text" name="gender" class="form-control" id="gender" value="<?= $pemilik['gender'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <!-- <input type="textarea" name="alamat" class="form-control" name="alamat" id="alamat" value="<?= $pemilik['alamat'] ?>" rows="4"> -->
                                                <textarea name="alamat" class="form-control" id="alamat" rows="4"><?= $pemilik['alamat'] ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="foto_pemilik" class="form-label">Foto Profil</label>
                                                <input type="file" name="foto_pemilik" class="form-control" id="foto_pemilik">
                                            </div>
                                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                        </form>
                                    </div>
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
                    <form>
                        <div class="mb-3">
                            <label for="username" class="form-label">Ubah Username</label>
                            <input type="username" class="form-control" id="username" placeholder="Masukkan username baru">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Ubah Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Masukkan password baru">
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Pengaturan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->endSection(); ?>