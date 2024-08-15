<?php
session_start();

include('db.php');

$username = $_SESSION['username'];

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("location: login.php");
    exit;
}

if (isset($_GET['export'])) {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=data_pemesanan.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $output = fopen("php://output", "w");
    fputcsv($output, array('ID', 'Nama', 'No HP', 'Tanggal Mulai', 'Durasi', 'Wisata', 'Layanan Penginapan', 'Layanan Transportasi', 'Layanan Makanan', 'Jumlah', 'Harga', 'Tagihan'));

    $query = "SELECT * FROM pemesanan";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

$query = "SELECT * FROM pemesanan";
$result = mysqli_query($conn, $query);

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
                        <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="#daftarpemesanan">Data Pemesanan</a></li>
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

        <!-- about-->
        <section class="page-section" id="daftarpemesanan">
        <div class="container mt-5">
            <h1 class="mb-4 text-center">Data Pemesanan</h1>
            <table class="table table-bordered" style="font-size: 11px; padding: 4px;">
                <thead>
                    <tr class="text-center">
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Tanggal Mulai</th>
                        <th>Durasi (Hari)</th>
                        <th>Wisata</th>
                        <th>Layanan Penginapan</th>
                        <th>Layanan Transportasi</th>
                        <th>Layanan Makanan</th>
                        <th>Jumlah Peserta</th>
                        <th>Harga</th>
                        <th>Tagihan</th>
                        <th style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['no_hp']; ?></td>
                        <td><?php echo $row['tgl_mulai']; ?></td>
                        <td class="text-center""><?php echo $row['durasi']; ?></td>
                        <td><?php echo $row['wisata']; ?></td>
                        <td class="text-center"><?php echo $row['layanan_penginapan'] ? 'Y' : 'N'; ?></td>
                        <td class="text-center"><?php echo $row['layanan_transportasi'] ? 'Y' : 'N'; ?></td>
                        <td class="text-center""><?php echo $row['layanan_makanan'] ? 'Y' : 'N'; ?></td>
                        <td class="text-center""><?php echo $row['jumlah']; ?></td>
                        <td style="width: 89px;"><?php echo 'Rp. ' . number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td style="width: 89px;"><?php echo 'Rp. ' . number_format($row['tagihan'], 0, ',', '.'); ?></td>
                        <td>
                            <a href="edit.php?id_pemesanan=<?php echo $row['id_pemesanan']; ?>" class="btn btn-primary btn-sm" style="width: 60px; padding: 4px;">Edit</a>
                            <a href="delete.php?id_pemesanan=<?php echo $row['id_pemesanan']; ?>" class="btn btn-danger btn-sm" style="width: 60px; padding: 4px;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <a href="admin.php?export=true" class="btn btn-success">Export ke Excel</a>
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