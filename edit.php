<?php
session_start();

include('db.php');

$username = $_SESSION['username'];

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("location: login.php");
    exit;
}

if (isset($_GET['id_pemesanan'])) {
    $id = $_GET['id_pemesanan'];

    $query = "SELECT * FROM pemesanan WHERE id_pemesanan = '$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
    }

    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan pada database');window.location='pesanan.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Masukkan data id.');window.location='pesanan.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Desa Citalutug</title>
        <script>
        function updatePrices() {
            var wisataElement = document.getElementById('wisata');
            var hargaElement = document.getElementById('harga');
            var tagihanElement = document.getElementById('tagihan');
            var layananElements = document.querySelectorAll('input[name="layanan[]"]:checked');
            var wisataHarga = parseInt(wisataElement.options[wisataElement.selectedIndex].dataset.harga) || 0;
            var layananHarga = Array.from(layananElements).reduce((sum, el) => sum + parseInt(el.value), 0);
            var harga = wisataHarga + layananHarga;
            var tagihan = harga * parseInt(document.getElementById('jumlah').value) || 0;

            hargaElement.value = harga;
            tagihanElement.value = tagihan;
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('wisata').addEventListener('change', updatePrices);
            document.querySelectorAll('input[name="layanan[]"]').forEach(function(el) {
                el.addEventListener('change', updatePrices);
            });
            document.getElementById('jumlah').addEventListener('input', updatePrices);
        });
        </script>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <!-- <link href="css/styles.css" rel="stylesheet" /> -->
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="assets/img/logo-putih.png" alt="logo" style="height: 4rem;"/></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href='user.php'>Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin.php#daftarpemesanan">Data Pemesanan</a></li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $username; ?>
                                </button>
                                <ul class="dropdown-menu">                                    
                                    <li><button class="dropdown-item" type="button"><a href='logout.php' class="text-decoration-none text-dark" onclick="return confirm('Anda yakin akan logout?')">Logout</a></button></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-heading text-uppercase">Desa Wisata Citalutug</div>
            </div>
        </header>

        <!-- edit pemesanan -->
        <section class="page-section" id="pemesanan">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4"> Edit Pemesanan</h2>
                <form method="POST" action="do_edit_pesanan.php">
                    <input type="hidden" name="id_pemesanan" value="<?php echo htmlspecialchars($id); ?>">
                    <div class="form-group mb-3">
                        <label>Nama</label>
                        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label>No. Telepon</label>
                        <input type="number" class="form-control" id="telepon" placeholder="Masukkan No. Telepon" name="no_hp" value="<?php echo htmlspecialchars($data['no_hp']); ?>" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label for="tgl_mulai">Tanggal Mulai Wisata</label>
                            <input type="date" class="form-control" name="tgl_mulai" value="<?php echo htmlspecialchars($data['tgl_mulai']); ?>" required>
                        </div>
                        <div class="col">
                            <label for="durasi">Durasi (Hari)</label>
                            <input type="number" class="form-control" id="durasi" name="durasi" value="<?php echo htmlspecialchars($data['durasi']); ?>">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="wisata">Wisata</label>
                        <select name="wisata" id="wisata" class="form-control" required>
                            <option data-harga="0">Pilih Wisata</option>
                            <option value="Pesona Sampalan Indah Citalutug" data-harga="10000" <?php if ($data['wisata'] == 'Pesona Sampalan Indah Citalutug') echo 'selected'; ?>>Pesona Sampalan Indah Citalutug</option>
                            <option value="Taman Kelinci Citalutug" data-harga="5000" <?php if ($data['wisata'] == 'Taman Kelinci Citalutug') echo 'selected'; ?>>Taman Kelinci Citalutug</option>
                            <option value="Wisata Alam Citalutug" data-harga="10000" <?php if ($data['wisata'] == 'Wisata Alam Citalutug') echo 'selected'; ?>>Wisata Alam Citalutug</option>
                            <option value="Homestay Citalutug" data-harga="250000" <?php if ($data['wisata'] == 'Homestay Citalutug') echo 'selected'; ?>>Homestay Citalutug</option>
                            <option value="Wisata Edukasi Citalutug" data-harga="225000" <?php if ($data['wisata'] == 'Wisata Edukasi Citalutug') echo 'selected'; ?>>Wisata Edukasi Citalutug</option>
                            <option value="Hutan Pinus Megatutupan" data-harga="5000" <?php if ($data['wisata'] == 'Hutan Pinus Megatutupan') echo 'selected'; ?>>Hutan Pinus Megatutupan</option>
                            <option value="Pamidagan Adu Domba Tangkas" data-harga="25000" <?php if ($data['wisata'] == 'Pamidagan Adu Domba Tangkas') echo 'selected'; ?>>Pamidagan Adu Domba Tangkas</option>
                            <option value="Glamping Mini Citalutug" data-harga="125000" <?php if ($data['wisata'] == 'Glamping Mini Citalutug') echo 'selected'; ?>>Glamping Mini Citalutug</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="Layanan">Layanan</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1000000" id="penginapan" name="layanan[]" 
                                <?php if (isset($data['layanan']) && strpos($data['layanan'], '1000000') !== false) echo 'checked'; ?>>
                            <label class="form-check-label" for="penginapan">Penginapan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1200000" id="transportasi" name="layanan[]" 
                                <?php if (isset($data['layanan']) && strpos($data['layanan'], '1200000') !== false) echo 'checked'; ?>>
                            <label class="form-check-label" for="transportasi">Transportasi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="500000" id="makanan" name="layanan[]" 
                                <?php if (isset($data['layanan']) && strpos($data['layanan'], '500000') !== false) echo 'checked'; ?>>
                            <label class="form-check-label" for="makanan">Makanan</label>
                        </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Jumlah Peserta</label>
                            <input type="number" class="form-control" id="jumlah" placeholder="Jumlah Peserta" name="jumlah" value="<?php echo htmlspecialchars($data['jumlah']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                        <label>Harga Paket</label>
                        <input type="number" class="form-control" id="harga" name="harga" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label>Jumlah Tagihan</label>
                        <input type="number" class="form-control" id="tagihan" name="tagihan" readonly>
                    </div>
                        <button type="button" class="btn btn-secondary btn-block" id="hitungBtn">Hitung</button>
                        <button type="submit" class="btn btn-primary btn-block">Pesan</button>
                </form>
            </div>
        </div>  
        </div>
        </section>
                
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2023</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>