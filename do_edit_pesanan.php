<?php
include 'db.php';

$id_pemesanan = $_POST['id_pemesanan'];
$nama         = $_POST['nama'];
$no_hp        = $_POST['no_hp'];
$tgl_mulai    = $_POST['tgl_mulai'];
$tgl_pemesanan = $_POST['tgl_pemesanan'] ?? ''; 
$durasi       = $_POST['durasi'];
$wisata       = $_POST['wisata'];

// Handling checkbox values (boolean logic)
$layanan_penginapan = isset($_POST['layanan']) && in_array('1000000', $_POST['layanan']) ? 1 : 0;
$layanan_transportasi = isset($_POST['layanan']) && in_array('1200000', $_POST['layanan']) ? 1 : 0;
$layanan_makanan = isset($_POST['layanan']) && in_array('500000', $_POST['layanan']) ? 1 : 0;

$jumlah       = $_POST['jumlah'];
$harga        = $_POST['harga'];
$tagihan      = $_POST['tagihan'];

$query = "UPDATE pemesanan SET 
            nama = ?, 
            no_hp = ?, 
            tgl_mulai = ?, 
            tgl_pemesanan = ?, 
            durasi = ?, 
            wisata = ?, 
            layanan_penginapan = ?, 
            layanan_transportasi = ?, 
            layanan_makanan = ?, 
            jumlah = ?, 
            harga = ?, 
            tagihan = ? 
          WHERE id_pemesanan = ?";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Prepared statement gagal: " . $conn->error);
}

// Binding parameters: s = string, i = integer
$stmt->bind_param("ssssssiiiiiii", 
    $nama, 
    $no_hp, 
    $tgl_mulai, 
    $tgl_pemesanan, 
    $durasi, 
    $wisata, 
    $layanan_penginapan, 
    $layanan_transportasi, 
    $layanan_makanan, 
    $jumlah, 
    $harga, 
    $tagihan, 
    $id_pemesanan);

if ($stmt->execute()) {
    echo "<script>alert('Data berhasil diubah.');window.location='admin.php';</script>";
} else {
    die("Query gagal dijalankan: " . $stmt->error);
}
?>