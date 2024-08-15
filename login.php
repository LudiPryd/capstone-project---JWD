<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            if ($row['role'] == 'admin') {
                header("location: admin.php");
                exit();
            } elseif ($row['role'] == 'user') {
                header("location: user.php");
                exit();
            }
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Username tidak ditemukan.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="masthead">
            <div class="container">
                <form method="post" action="">
                    <div class="card" style="width: 40rem; margin: 0 auto; padding: 20px;">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label" style="color: black;">Username</label>
                            <input type="text" name="username" required><br>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="color: black;">Password</label>
                            <input type="password" name="password" required><br>
                        </div>
                        <div>
                            <p style="color: black;">Belum punya akun? <a href="register.php" style="text-decoration: none; color:blue;">Register</a></p>
                        </div>
                        <button type="submit" value="Login" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
    </header>
</body>
</html>
