<?php
include 'db.php';

// Mengambil ID dari URL dan membersihkan input
$id_pemesanan = isset($_GET["id_pemesanan"]) ? mysqli_real_escape_string($conn, $_GET["id_pemesanan"]) : '';

// Mengecek apakah ID tidak kosong
if ($id_pemesanan) {
    // Jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM pemesanan WHERE id_pemesanan = '$id_pemesanan'";
    $hasil_query = mysqli_query($conn, $query);

    // Periksa query, apakah ada kesalahan
    if (!$hasil_query) {
        die("Gagal menghapus data: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Data berhasil dihapus.');window.location='admin.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan.');window.location='admin.php';</script>";
}
?>
