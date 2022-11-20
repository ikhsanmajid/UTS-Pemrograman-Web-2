<?php
session_start();
include('../config/koneksi.php');
include('response.php');
error_reporting(0);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!empty($data)) {

        // SECTION POST
        // NOTE Fungsi Login

        if ($data['method'] == 'login') {
            $username = $data['username'];
            $password = $data['password'];
            try {
                $query = "SELECT id_user, username, level_user FROM user WHERE username = :username";
                $statement = $conn->prepare($query);
                $statement->execute(['username' => $username]);
                $getPassword = $conn->prepare("SELECT password FROM user WHERE username = :username");
                $getPassword->execute([':username' => $username]);
                $passwordHash = $getPassword->fetch();

                if ($statement->rowCount() == 1) {
                    $output = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if ($output[0]['username'] && password_verify($password, $passwordHash['password'])) {
                        date_default_timezone_set('Asia/Jakarta');
                        $datetime = date('Y-m-d H:i:s');
                        $updateDate = $conn->prepare("UPDATE user SET last_login = :last_login WHERE id_user = :id");
                        $updateDate->execute([':last_login' => $datetime, ':id' => $output[0]['id_user']]);
                        $_SESSION['id'] = $output[0]['id_user'];
                        $_SESSION['username'] = $output[0]['username'];
                        $_SESSION['level_user'] = $output[0]['level_user'];
                        header('Content-type: application/json');
                        echo json_encode([
                            'response' => '1',
                            'data' => $output
                        ]);
                    } else {
                        header('Content-type: application/json');
                        echo json_encode([
                            'response' => '0',
                            'data' => 'Username atau Password Salah'
                        ]);
                    }
                } else {
                    header('Content-type: application/json');
                    echo json_encode([
                        'response' => '0',
                        'data' => 'Username atau Password Salah'
                    ]);
                }
            } catch (PDOException $e) {
                send500();
            }
        }

        // NOTE Fungsi Register
        else if ($data['method'] == 'register') {
            $username = $data['username'];
            $password = $data['password'];
            $password2 = $data['password2'];
            if ($password != $password2) {
                header('Content-type: application/json');
                echo json_encode([
                    'response' => '0',
                    'data' => 'Password tidak sama'
                ]);
                return 0;
            }
            try {
                $check = $conn->prepare("SELECT username FROM user WHERE username = :username");
                $check->execute([':username' => $username]);
                if ($check->rowCount() > 0) {
                    header('Content-type: application/json');
                    echo json_encode([
                        'response' => '0',
                        'data' => 'Akun sudah terdaftar'
                    ]);
                } else {
                    $query = "INSERT INTO user (username, password, last_login, level_user) VALUES (:username, :password, NULL, '1')";
                    $insert = $conn->prepare($query);
                    $insert->execute([':username' => $username, ':password' => password_hash($password, PASSWORD_DEFAULT)]);
                    if ($insert->rowCount() > 0) {
                        header('Content-type: application/json');
                        echo json_encode([
                            'response' => '1',
                            'data' => 'User berhasil didaftarkan'
                        ]);
                    } else {
                        header('Content-type: application/json');
                        echo json_encode([
                            'response' => '0',
                            'data' => 'User gagal didaftarkan'
                        ]);
                    }
                }
            } catch (PDOException $e) {
                send500();
            }
        }

        // SECTION Not Admin

        // NOTE Fungsi get news
        else if ($data['method'] == 'getNews') {
            if (array_key_exists('title', $data) && !array_key_exists('category', $data)) {
                $query = "SELECT * FROM berita WHERE judul_berita LIKE :title AND status_berita = 1";
                $statement = $conn->prepare($query);
                $statement->execute([':title' => '%' . $data['title'] . '%']);
            } else if (!array_key_exists('title', $data) && array_key_exists('category', $data)) {
                $query = "SELECT * FROM berita WHERE kategori_berita = :category AND status_berita = 1";
                $statement = $conn->prepare($query);
                $statement->execute([':category' => $data['category']]);
            } else if (array_key_exists('title', $data) && array_key_exists('category', $data)) {
                $query = "SELECT * FROM berita WHERE judul_berita LIKE :title AND kategori_berita = :category AND status_berita = 1";
                $statement = $conn->prepare($query);
                $statement->execute([':title' => '%' . $data['title'] . '%', ':category' => $data['category']]);
            } else {
                $query = "SELECT * FROM berita WHERE status_berita = 1";
                $statement = $conn->prepare($query);
                $statement->execute();
            }

            try {
                if ($statement->rowCount() > 0) {
                    $output = $statement->fetchAll(PDO::FETCH_ASSOC);
                    header('Content-type: application/json');
                    echo json_encode([
                        'response' => '1',
                        'data' => $output
                    ]);
                } else {
                    send404('Berita tidak ada');
                }
            } catch (PDOException $e) {
                send500();
            }
        }

        // NOTE get News by Id
        else if ($data['method'] == 'getNewsById') {
            $query = "SELECT * FROM berita WHERE id_berita = :id";
            $statement = $conn->prepare($query);
            $statement->bindValue(':id', $data['id'], PDO::PARAM_INT);
            $statement->execute();
            try {
                if ($statement->rowCount() > 0) {
                    $output = $statement->fetchAll(PDO::FETCH_ASSOC);
                    header('Content-type: application/json');
                    echo json_encode([
                        'response' => '1',
                        'data' => $output
                    ]);
                } else {
                    send404('Berita tidak ada');
                }
            } catch (PDOException $e) {
                send500();
            }
        }


        // // NOTE get jumlah item
        // else if ($data['method'] == 'getItemsCount') {
        //     $query = "SELECT id_berita FROM berita";
        //     $statement = $conn->prepare($query);
        //     $statement->execute();
        //     $items = $statement->rowCount();
        //     header('Content-type: application/json');
        //     echo json_encode([
        //         'response' => '1',
        //         'data' => $items
        //     ]);
        // }

        // NOTE get Category List
        else if ($data['method'] == 'getCategoryList') {
            $query = "SELECT * FROM kategori ORDER BY nama_kategori ASC";
            $statement = $conn->prepare($query);
            $statement->execute();
            $output = $statement->fetchAll(PDO::FETCH_ASSOC);
            header('Content-type: application/json');
            echo json_encode([
                'response' => '1',
                'data' => $output
            ]);
        }

        // !SECTION
        // SECTION Admin

        // NOTE Fungsi get semua berita Admin
        else if ($data['method'] == 'getNewsAdm') {
            if ($_SESSION['level_user'] == 1) {
                if (array_key_exists('title', $data) && !array_key_exists('category', $data)) {
                    $query = "SELECT * FROM berita INNER JOIN kategori ON berita.kategori_berita=kategori.id_kategori WHERE judul_berita LIKE :title LIMIT :page, 10";
                    $statement = $conn->prepare($query);
                    $statement->bindValue(':page', ($data['page'] * 10), PDO::PARAM_INT);
                    $statement->bindValue(':title', '%' . $data['title'] . '%', PDO::PARAM_STR);
                    $statement->execute();
                } else if (!array_key_exists('title', $data) && array_key_exists('category', $data)) {
                    $query = "SELECT * FROM berita INNER JOIN kategori ON berita.kategori_berita=kategori.id_kategori WHERE kategori_berita = :category LIMIT :page, 10";
                    $statement = $conn->prepare($query);
                    $statement->bindValue(':page', ($data['page'] * 10), PDO::PARAM_INT);
                    $statement->bindValue(':category', $data['category'], PDO::PARAM_STR);
                    $statement->execute();
                } else if (array_key_exists('title', $data) && array_key_exists('category', $data)) {
                    $query = "SELECT * FROM berita INNER JOIN kategori ON berita.kategori_berita=kategori.id_kategori WHERE judul_berita LIKE :title AND kategori_berita = :category LIMIT :page, 10";
                    $statement = $conn->prepare($query);
                    $statement->bindValue(':page', ($data['page'] * 10), PDO::PARAM_INT);
                    $statement->bindValue(':title', '%' . $data['title'] . '%', PDO::PARAM_STR);
                    $statement->bindValue(':category', $data['category'], PDO::PARAM_STR);
                    $statement->execute();
                } else {
                    $query = "SELECT * FROM berita INNER JOIN kategori ON berita.kategori_berita=kategori.id_kategori LIMIT :page, 10";
                    $statement = $conn->prepare($query);
                    $statement->bindValue(':page', ($data['page'] * 10), PDO::PARAM_INT);
                    $statement->execute();
                }

                try {
                    if ($statement->rowCount() > 0) {
                        $output = $statement->fetchAll(PDO::FETCH_ASSOC);
                        header('Content-type: application/json');
                        echo json_encode([
                            'response' => '1',
                            'data' => $output,
                        ]);
                    } else {
                        send404('Berita tidak ada');
                    }
                } catch (PDOException $e) {
                    send500();
                }
            } else {
                send403();
            }
        }

        // NOTE Fungsi delete berita
        else if ($data['method'] == 'deleteNews') {
            if ($_SESSION['level_user'] == 1) {
                try {
                    $query_gambar = "SELECT gambar_berita FROM berita WHERE id_berita=:id";
                    $statement_gambar = $conn->prepare($query_gambar);
                    $statement_gambar->bindValue(':id', $data['id'], PDO::PARAM_INT);
                    $statement_gambar->execute();
                    $output = $statement_gambar->fetchAll(PDO::FETCH_ASSOC);

                    $query = "DELETE FROM berita WHERE id_berita = :id";
                    $statement = $conn->prepare($query);
                    $statement->bindValue(':id', $data['id'], PDO::PARAM_INT);
                    $statement->execute();

                    if ($statement->rowCount() > 0) {
                        unlink($output[0]['gambar_berita']);
                        header('Content-type: application/json');
                        echo json_encode([
                            'response' => '1'
                        ]);
                    } else {
                        header('Content-type: application/json');
                        echo json_encode([
                            'response' => '0'
                        ]);
                    }
                } catch (PDOException $e) {
                    send500();
                }
            } else {
                send403();
            }
        }

        // NOTE Empty method
        else {
            send200();
        }
    } else {
        send200();
    }

    // !SECTION
} else {
    send404();
}
