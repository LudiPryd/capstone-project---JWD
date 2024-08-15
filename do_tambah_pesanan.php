<?php
include 'db.php';

$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$no_hp = isset($_POST['no_hp']) ? $_POST['no_hp'] : '';
$tgl_mulai = isset($_POST['tgl_mulai']) ? $_POST['tgl_mulai'] : '';
$tgl_pemesanan = date('Y-m-d H:i:s');
$durasi = isset($_POST['durasi']) ? $_POST['durasi'] : '';
$wisata = isset($_POST['wisata']) ? $_POST['wisata'] : '';
$layanan_penginapan = isset($_POST['layanan']) && is_array($_POST['layanan']) && in_array('1000000', $_POST['layanan']) ? 1 : 0;
$layanan_transportasi = isset($_POST['layanan']) && is_array($_POST['layanan']) && in_array('1200000', $_POST['layanan']) ? 1 : 0;
$layanan_makanan = isset($_POST['layanan']) && is_array($_POST['layanan']) && in_array('500000', $_POST['layanan']) ? 1 : 0;
$jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
$harga = isset($_POST['harga']) ? $_POST['harga'] : '';
$tagihan = isset($_POST['tagihan']) ? $_POST['tagihan'] : '';

$query = "INSERT INTO pemesanan (nama, no_hp, tgl_mulai, tgl_pemesanan, durasi, wisata, layanan_penginapan, layanan_transportasi, layanan_makanan, jumlah, harga, tagihan) 
VALUES ('$nama', '$no_hp', '$tgl_mulai', '$tgl_pemesanan', '$durasi', '$wisata', '$layanan_penginapan', '$layanan_transportasi', '$layanan_makanan', '$jumlah', '$harga', '$tagihan')";

$result = mysqli_query($conn, $query);

if (!$result) {
    die ("Query gagal dijalankan: ".mysqli_errno($conn).
    " - ".mysqli_error($conn));
} else {
    echo "<script>alert('Data berhasil ditambah.');window.location='user.php';</script>";
}
