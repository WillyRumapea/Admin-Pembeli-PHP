<?php
    require "koneksi.php";

    function registration($data){
        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn,$data["password"]);
        $confirmPass = mysqli_real_escape_string($conn,$data["passwordConfirm"]);

        $checkUserName = mysqli_query($conn,"SELECT username FROM user WHERE username = '$username'");

        if(mysqli_fetch_assoc($checkUserName)){
            echo"<script>
                alert('username sudah digunakan');
            </script>";
            return false;
        }

        if( $password !== $confirmPass){
            echo"<script>
                alert('konfirmasi kembali password anda!');
            </>";
            return false;
        }

        $hashPassword = password_hash($password,PASSWORD_DEFAULT);

        mysqli_query($conn, "INSERT INTO user VALUES ('','$username','$hashPassword')");

        return mysqli_affected_rows($conn);
    }
?>