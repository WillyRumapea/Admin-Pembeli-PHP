<?php
    session_start();

    if(isset($_SESSION["login"])){
        header("Location: ../index.php");
        exit;
    }

    require "../controller/koneksi.php";

    if(isset($_POST["login"])){
        
        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
           if (password_verify($password,$row["password"])){
            $_SESSION["login"] = true; 
            header("Location: ../index.php");
            exit;
           }
        }
        $error = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if(isset($error)) :?>
        <?= "<script>
            alert('username/password salah!!'); 
        </script>" ?>
    <?php endif ;?>   
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
            <button type="submit" name="login">login!</button>
        </ul>
    </form>
    <p>belum punya akun ? Buat <a href="registrasi.php">disini!!</a></p>
</body>
</html>