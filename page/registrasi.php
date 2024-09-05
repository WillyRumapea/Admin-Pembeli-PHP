<?php
    require "../controller/koneksi.php";
    require "../controller/registration.php";

    if(isset($_POST["register"])){
        if(registration($_POST) > 0){
            echo"<script>
                alert('akun anda berhasil registrasi!!');
            </script>";
        }else{
            echo mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    <h1>Halaman Registrasi</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username"></label>
                <input type="text" name="username" id="username" placeholder="Username">
            </li>
            <li>
                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Password">
            </li>
            <li>
                <label for="passwordConfirm"></label>
                <input type="password" name="passwordConfirm" id="passwordconfirm" placeholder="Confirm password">
            </li>
            <button type="submit" name="register">Registrasi</button>
        </ul>
    </form>
    <p>sudah punya akun ? login <a href="login.php">disini!!</a></p>
</body>
</html>