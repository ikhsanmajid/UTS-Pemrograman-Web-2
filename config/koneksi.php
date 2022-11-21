<?php

$username = 'root';
$password = 'ikhsan123';

try {
    $conn = new PDO("mysql:host=localhost;port=3306;dbname=berita", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi gagal ".$e->getMessage();
}