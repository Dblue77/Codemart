<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id']) || !isset($_GET['id_produk'])) {
    header("Location: keranjang.php");
    exit;
}

$id_user = $_SESSION['user_id'];
$id_produk = $_GET['id_produk'];

// Hapus produk dari keranjang user
mysqli_query($conn, "DELETE FROM keranjang WHERE id_user = $id_user AND id_produk = $id_produk");

header("Location: keranjang.php");
exit;
?>