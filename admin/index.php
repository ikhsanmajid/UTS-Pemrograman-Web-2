<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Berita</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/sweetalert.css">
</head>

<body class="bg-info bg-opacity-50">

    <?php include '../include_file/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-3">
                    <div class="card-header">
                        Tabel Berita
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group">
                                    <label class="input-group-text" for="searchBox">Cari Berita</label>
                                    <input type="text" class="form-control w-25" id="searchBox">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="input-group-text" for="categoryBox">Kategori</label>
                                    <select class="form-select" id="categoryBox">
                                        <option value="" selected>Pilih Kategori</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto ms-auto">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahBerita">
                                    + Tambah Berita
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-3 mx-1">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Preview Gambar</th>
                                            <th scope="col">Judul Berita</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Tanggal Penulisan</th>
                                            <th scope="col">Status Tayang</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="content">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Modal -->
    <!-- Modal Tambah Berita -->
    <div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-labelledby="tambahBeritaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahBeritaModalLabel">Tambah Berita</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addBeritaForm">
                        <div class="mb-3">
                            <label for="judulBeritaAdd" class="form-label">Judul Berita</label>
                            <input type="text" class="form-control" name="judulBerita" id="judulBeritaAdd">
                        </div>
                        <div class="mb-3">
                            <label for="isiBeritaAdd" class="form-label">Isi Berita</label>
                            <textarea class="form-control" name="isiBerita" id="isiBeritaAdd" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="gambarBeritaAdd" class="form-label">Upload Gambar Berita</label>
                            <input class="form-control" name="gambarBerita" type="file" id="gambarBeritaAdd">
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <label class="input-group-text" for="categoryBoxAdd">Kategori</label>
                                <select class="form-select" name="kategoriBerita" id="categoryBoxAdd">
                                    <option value="" selected>Pilih Kategori</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex mb-3 justify-content-end">
                            <button type="submit" class="btn btn-info text-end">Tambah Berita</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Berita -->
    <div class="modal fade" id="modalEditBerita" tabindex="-1" aria-labelledby="editBeritaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editBeritaModalLabel">Edit Berita</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBeritaForm">

                        <div class="mb-3">
                            <label for="editJudulBerita" class="form-label">Judul Berita</label>
                            <input type="hidden" class="form-control" name="idBeritaEdit" id="idBeritaEdit">
                            <input type="text" class="form-control" name="editJudulBerita" id="editJudulBerita">
                        </div>
                        <div class="mb-3">
                            <label for="editisiBerita" class="form-label">Isi Berita</label>
                            <textarea class="form-control" name="editisiBerita" id="editisiBerita" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editgambarBerita" class="form-label">Upload Gambar Berita</label>
                            <input class="form-control" name="editgambarBerita" type="file" id="editgambarBerita">
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <label class="input-group-text" for="editkategoriBerita">Kategori</label>
                                <select class="form-select" name="editkategoriBerita" id="editkategoriBerita">
                                    <option value="" selected>Pilih Kategori</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <label class="input-group-text" for="editStatusBerita">Status Tayang</label>
                                <select class="form-select" name="editStatusBerita" id="editStatusBerita">
                                    <option value="0">Tidak Tayang</option>
                                    <option value="1">Tayang</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex mb-3 justify-content-end">
                            <button type="submit" class="btn btn-info text-end">Edit Berita</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
</body>

<script src="../assets/js/bootstrap.js" defer></script>
<script src="../assets/js/sweetalert.js" defer></script>
<script src="../assets/js/adminPage.js"></script>

</html>