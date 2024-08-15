<?php
session_start();


if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("location: login.php");
    exit;
}

$username = $_SESSION['username'];

include('db.php');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Desa Citalutug</title>
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
                        <li class="nav-item"><a class="nav-link" href='user.php#wisata'>Wisata</a></li>
                        <li class="nav-item"><a class="nav-link" href='pemesanan.php'>Pemesanan</a></li>
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

        <!-- pemesanan -->
        <section class="page-section" id="pemesanan">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">PEMESANAN</h2>
                <form method="POST" action="do_tambah_pesanan.php" enctype="multipart/form-data" >
                    <div class="form-group mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" required="">
                    </div>
                    <div class="form-group mb-3">
                        <label>No. Telepon</label>
                        <input type="number" class="form-control" id="telepon" placeholder="Masukkan No. Telepon" name="no_hp" required="">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label for="tgl_mulai">Tanggal Mulai Wisata</label>
                            <input type="date" class="form-control" name="tgl_mulai" required="">
                        </div>
                        <div class="col">
                            <label for="durasi">Durasi (Hari)</label>
                            <input type="number" class="form-control" id="durasi" name="durasi" required=""> 
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="wisata"> Wisata</label>
                        <select name="wisata" id="wisata" class="form-control" required>
                            <option data-harga="0">Pilih Wisata</option>
                            <option value="Pesona Sampalan Indah Citalutug" data-harga="10000">Pesona Sampalan Indah Citalutug</option>
                            <option value="Taman Kelinci Citalutug" data-harga="5000">Taman Kelinci Citalutug</option>
                            <option value="Wisata Alam Citalutug" data-harga="10000">Wisata Alam Citalutug</option>
                            <option value="Homestay Citalutug" data-harga="250000">Homestay Citalutug</option>
                            <option value="Wisata Edukasi Citalutug" data-harga="225000">Wisata Edukasi Citalutug</option>
                            <option value="Hutan Pinus Megatutupan" data-harga="5000">Hutan Pinus Megatutupan</option>
                            <option value="Pamidagan Adu Domba Tangkas" data-harga="25000">Pamidagan Adu Domba Tangkas</option>
                            <option value="Glamping Mini Citalutug" data-harga="125000">Glamping Mini Citalutug</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="Layanan">Layanan</label>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1000000" id="penginapan" name="layanan[]">
                            <label class="form-check-label" for="penginapan">
                                Penginapan
                            </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1200000" id="transportasi" name="layanan[]">
                            <label class="form-check-label" for="transportasi">
                                Transportasi
                            </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="500000" id="makanan" name="layanan[]">
                            <label class="form-check-label" for="makanan">
                                Makanan
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Jumlah Peserta</label>
                        <input type="number" class="form-control" id="peserta" placeholder="Jumlah Peserta" name="jumlah" required="">
                    </div>
                    <div class="form-group mb-3">
                        <label>Harga Paket</label>
                        <input type="number" class="form-control" id="harga" placeholder="Harga Paket" name="harga" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label>Jumlah Tagihan</label>
                        <input type="number" class="form-control" id="tagihan" placeholder="Jumlah Tagihan" name="tagihan" readonly>
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
        <script>
            document.getElementById('hitungBtn').addEventListener('click', function() {
            let wisataPrice = parseInt(document.getElementById('wisata').value) || 0;
            let layananPrice = Array.from(document.querySelectorAll('input[name="layanan[]"]:checked')).reduce((total, checkbox) => total + parseInt(checkbox.value), 0);
            let jumlahPeserta = parseInt(document.getElementById('peserta').value) || 0;

            // Hitung harga paket berdasarkan wisata dan layanan yang dipilih
            let hargaPaket = wisataPrice + layananPrice;
            document.getElementById('harga').value = hargaPaket;

            // Hitung jumlah tagihan
            let jumlahTagihan = hargaPaket * jumlahPeserta;
            document.getElementById('tagihan').value = jumlahTagihan;
        });
        </script>
    </body>
</html>