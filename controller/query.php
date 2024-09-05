<?php
    require "koneksi.php";

    function query($query){
        global $conn;
        $result = mysqli_query($conn,$query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[]=$row;
        }
        return $rows;
    }

    function delData($id){
        global $conn;
        mysqli_query($conn,"DELETE FROM table_pembeli WHERE id = $id;");

        return mysqli_affected_rows($conn);
    }

    function search($keyword){
        $query = "SELECT * FROM table_pembeli
                WHERE
                nama LIKE '%$keyword%' OR
                gender LIKE '%$keyword%' OR
                member LIKE '%$keyword%' OR
                kunjungan LIKE '%$keyword%' OR
                alamat LIKE '%$keyword%' OR
                maksimal_pembelian LIKE '%$keyword%' OR
                kupon LIKE '%$keyword%' OR
                poin LIKE '%$keyword%' OR
                status_aktif LIKE '%$keyword%' 
                ";

        return query($query);
    }

?>