<?php
    require "koneksi.php";
    require "queryPost.php";

    function updData($data){
        global $conn; 

        $id = $data["id"];

        $gambar_lama = htmlspecialchars($data["gambarLama"]);
        if($_FILES["gambar"]["error"] === 4){
            $gambar = $gambar_lama;
        }else{
            $gambar = uploadImg();
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

        $qPost = "UPDATE table_pembeli
                SET gambar = '$gambar', nama = '$nama', gender = '$gender', member = '$member', kunjungan = $kunjungan, alamat = '$alamat', maksimal_pembelian = $maksimal_pembelian, kupon = $kupon, poin = $poin, status_aktif = '$status_aktif' 
                WHERE id = $id"; 
        
        mysqli_query($conn,$qPost);

        return mysqli_affected_rows($conn);

    }
?>