<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        header("location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
                        <button type="submit" value="Register" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
    </header>
</body>
</html>
