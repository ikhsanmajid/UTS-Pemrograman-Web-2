<?php
session_start();
include('../config/koneksi.php');
include('response.php');
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //NOTE add berita
    if (isset($_POST['addBerita'])) {
        if ($_SESSION['level_user'] == 1) {
            try {
                date_default_timezone_set('Asia/Jakarta');
                $dateNow = date('Ymd');
                $dateTimeNow = date('Y-m-d H:i:s');

                $file_uploaded = $_FILES['gambarBerita'];
                $file_name = strtolower($file_uploaded['name']);
                $file_name_tmp = $file_uploaded['tmp_name'];
                $file_size = $file_uploaded['size'];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $filesExtAllowed = ["png", "jpg", "jpeg"];
                $target = '../assets/images/' . $dateNow . '/' . $file_name;

                if (!in_array($file_ext, $filesExtAllowed)) {
                    header('Content-type: application/json');
                    echo json_encode([
                        'response' => '0',
                        'message' => 'Ekstensi file tidak diijinkan'
                    ]);
                } else if ($file_size > 5000000) {
                    header('Content-type: application/json');
                    echo json_encode([
                        'response' => '0',
                        'message' => 'Filesize terlalu besar'
                    ]);
                } else if (file_exists($target)) {
                    header('Content-type: application/json');
                    echo json_encode([
                        'response' => '0',
                        'message' => 'File sudah ada'
                    ]);
                } else {
                    if (!is_dir('../assets/images/' . $dateNow)) {
                        mkdir('../assets/images/' . $dateNow);
                    } else {
                        $query = "INSERT INTO berita (judul_berita, isi_berita, kategori_berita, gambar_berita, tanggalpenulisan_berita, status_berita) VALUES (:judul, :isi, :kategori, :gambar, :tanggal, 1)";
                        $statement = $conn->prepare($query);
                        $statement->bindValue(':judul', $_POST['judulBerita'], PDO::PARAM_STR);
                        $statement->bindValue(':isi', $_POST['isiBerita'], PDO::PARAM_STR);
                        $statement->bindValue(':kategori', $_POST['kategoriBerita'], PDO::PARAM_INT);
                        $statement->bindValue(':gambar', $target, PDO::PARAM_STR);
                        $statement->bindValue(':tanggal', $dateTimeNow, PDO::PARAM_STR);
                        $statement->execute();
                        move_uploaded_file($file_name_tmp, $target);
                        if ($statement->rowCount() > 0) {
                            header('Content-type: application/json');
                            echo json_encode([
                                'response' => '1',
                                'message' => 'Upload Sukses'
                            ]);
                        } else {
                            header('Content-type: application/json');
                            echo json_encode([
                                'response' => '0',
                                'message' => 'Upload Gagal SQL'
                            ]);
                        }
                    }
                }
            } catch (PDOException $e) {
                send500('Data ada yang kosong');
            }
        } else {
            send403();
        }

        // NOTE edit berita
    } else if (isset($_POST['editBerita'])) {
        if ($_SESSION['level_user'] == 1) {
            try {
                $file_uploaded = $_FILES['editgambarBerita'];
                if ($file_uploaded['error'] == 4) {
                    $query = "UPDATE berita SET judul_berita = :judul, isi_berita = :isi, kategori_berita = :kategori, status_berita = :status WHERE id_berita = :id";
                    $statement = $conn->prepare($query);
                    $statement->bindValue(':judul', $_POST['editJudulBerita'], PDO::PARAM_STR);
                    $statement->bindValue(':isi', $_POST['editisiBerita'], PDO::PARAM_STR);
                    $statement->bindValue(':kategori', $_POST['editkategoriBerita'], PDO::PARAM_INT);
                    $statement->bindValue(':status', $_POST['editStatusBerita'], PDO::PARAM_INT);
                    $statement->bindValue(':id', $_POST['idBeritaEdit'], PDO::PARAM_INT);
                    $statement->execute();
                    if ($statement->rowCount() > 0) {
                        header('Content-type: application/json');
                        echo json_encode([
                            'response' => '1',
                            'message' => 'Berita berhasil diedit'
                        ]);
                    } else {
                        header('Content-type: application/json');
                        echo json_encode([
                            'response' => '0',
                            'message' => 'Berita tidak berhasil diedit / tidak ada perubahan'
                        ]);
                    }
                } else {
                    date_default_timezone_set('Asia/Jakarta');
                    $dateNow = date('Ymd');
                    $dateTimeNow = date('Y-m-d H:i:s');
                    $file_name = strtolower($file_uploaded['name']);
                    $file_name_tmp = $file_uploaded['tmp_name'];
                    $file_size = $file_uploaded['size'];
                    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                    $filesExtAllowed = ["png", "jpg", "jpeg"];
                    $target = '../assets/images/' . $dateNow . '/' . $file_name;

                    if (!in_array($file_ext, $filesExtAllowed)) {
                        header('Content-type: application/json');
                        echo json_encode([
                            'response' => '0',
                            'message' => 'Ekstensi file tidak diijinkan'
                        ]);
                    } else if ($file_size > 5000000) {
                        header('Content-type: application/json');
                        echo json_encode([
                            'response' => '0',
                            'message' => 'Filesize terlalu besar'
                        ]);
                    } else if (file_exists($target)) {
                        header('Content-type: application/json');
                        echo json_encode([
                            'response' => '0',
                            'message' => 'File sudah ada'
                        ]);
                    } else {
                        if (!is_dir('../assets/images/' . $dateNow)) {
                            mkdir('../assets/images/' . $dateNow);
                        } else {

                            $query_gambar = "SELECT gambar_berita FROM berita WHERE id_berita = :id";
                            $statement_gambar = $conn->prepare($query_gambar);
                            $statement_gambar->bindValue(':id', $_POST['idBeritaEdit'], PDO::PARAM_INT);
                            $statement_gambar->execute();
                            $output_gambar = $statement_gambar->fetchAll(PDO::FETCH_ASSOC);
                            unlink($output_gambar[0]['gambar_berita']);

                            $query = "UPDATE berita SET judul_berita = :judul, isi_berita = :isi, kategori_berita = :kategori, gambar_berita = :gambar, status_berita = :status WHERE id_berita = :id";
                            $statement = $conn->prepare($query);
                            $statement->bindValue(':judul', $_POST['editJudulBerita'], PDO::PARAM_STR);
                            $statement->bindValue(':isi', $_POST['editisiBerita'], PDO::PARAM_STR);
                            $statement->bindValue(':gambar', $target, PDO::PARAM_STR);
                            $statement->bindValue(':kategori', $_POST['editkategoriBerita'], PDO::PARAM_INT);
                            $statement->bindValue(':status', $_POST['editStatusBerita'], PDO::PARAM_INT);
                            $statement->bindValue(':id', $_POST['idBeritaEdit'], PDO::PARAM_INT);
                            $statement->execute();

                            move_uploaded_file($file_name_tmp, $target);

                            if ($statement->rowCount() > 0) {
                                header('Content-type: application/json');
                                echo json_encode([
                                    'response' => '1',
                                    'message' => 'Berita berhasil diedit'
                                ]);
                            } else {
                                header('Content-type: application/json');
                                echo json_encode([
                                    'response' => '0',
                                    'message' => 'Berita tidak berhasil diedit / tidak ada perubahan'
                                ]);
                            }
                        }
                    }
                }
            } catch (PDOException $e) {
                send500($e);
            }
        } else {
            send403();
        }
    } else {
        send200();
    }
} else {
    send404();
}
