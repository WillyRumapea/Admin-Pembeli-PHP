<?php
    require "koneksi.php";

    function postData($data){
        global $conn;

        $gambar = uploadImg();
        if(!$gambar){
            return false;
        }

        $nama = htmlspecialchars($data["nama"]);
        $gender =htmlspecialchars($data["gender"]);
        $member = htmlspecialchars($data["member"]);
        $kunjungan = htmlspecialchars($data["kunjungan"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $maksimal_pembelian = htmlspecialchars($data["maksimal_pembelian"]);
        $kupon = htmlspecialchars($data["kupon"]);
        $poin = htmlspecialchars($data["poin"]);
        $status_aktif = htmlspecialchars($data["status_aktif"]);

        $qPost = "INSERT INTO table_pembeli
                VALUES
                ('','$gambar','$nama','$gender','$member','$kunjungan','$alamat','$maksimal_pembelian','$kupon','$poin','$status_aktif')"; 
        
        mysqli_query($conn,$qPost);

        return mysqli_affected_rows($conn);
    }

    function uploadImg(){
        $inputedFileName = $_FILES["gambar"]["name"];   
        $inputedFileSize = $_FILES["gambar"]["size"];   
        $inputedFilesStats = $_FILES["gambar"]["error"];   
        $inputedFilesLoct = $_FILES["gambar"]["tmp_name"];  
        
        if($inputedFilesStats === 4){
            echo "<script>
                alert('tidak ada gambar dimasukkan!!');
            </script>";
            return false;
        }

        $eksConfirm = ["jpg","jpeg","png"];
        $concatFileName = explode(".",$inputedFileName);
        $concatFileName = strtolower(end($concatFileName));

        if(!in_array($concatFileName,$eksConfirm)){
            echo "<script>
                alert('file yang di upload bukan gambar!!');
            </script>";
            return false;
        }

        if($inputedFileSize > 1000000){
            echo "<script>
                alert('ukuran melebihi maks ukuran!!');
            </script>";
            return false;
        }

        $newFileName = uniqid();
        $newFileName .= ".";
        $newFileName .= $concatFileName;
        

        move_uploaded_file($inputedFilesLoct, "../img/" . $newFileName);

        return $newFileName;
    }
?>