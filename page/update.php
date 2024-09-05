<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
    }

    require "../controller/queryUpdate.php";
    require "../controller/query.php";

    $id = $_GET["id"];
    
    $pbeli = query("SELECT * FROM table_pembeli WHERE id = $id")[0];

    if(isset($_POST["submit"])){
        if(updData($_POST) > 0){
            echo "<script>
                alert('data berhasil di ubah!');
                document.location.href = '../index.php';
            </script>";
        }else{
            echo "<script>
                alert('data gagal di ubah!');
            </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembeli</title>
</head>
<body>
    <h1>Perbarui Pembeli</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <input type="hidden" name="id" value="<?= $pbeli["id"]?>">            
            <input type="hidden" name="gambarLama" value="<?= $pbeli["gambar"]?>">            
            <li>
                <label for="gambar">Gambar: </label><br>
                <img src="../img/<?= $pbeli["gambar"]?>" alt=""><br>
                <input type="file" name="gambar" id="gambar" >
            </li>
            <li>
                <label for="nama">Nama: </label>
                <input type="text" name="nama" id="nama" placeholder="masukkan nama" value="<?= $pbeli["nama"]?>" required>
            </li>
            <li>
                <label for="gender">Gender: </label>
                <input type="text" name="gender" id="gender" placeholder="masukkan gender" value="<?= $pbeli["gender"]?>" required>
            </li>
            <li>
                <label for="member">Member: </label>
                <input type="text" name="member" id="member" placeholder="pilih jenis member" value="<?= $pbeli["member"]?>" list="member-list" required>
                <datalist id="member-list">
                    <option value="Bronze"></option>
                    <option value="Silver"></option>
                    <option value="Gold"></option>
                </datalist>
            </li>
            <li>
                <label for="kunjungan">Kunjungan: </label>
                <input type="number" name="kunjungan" id="kunjungan" value="<?= $pbeli["kunjungan"]?>" required>
            </li>
            <li>
                <label for="alamat">Alamat: </label>
                <input type="text" name="alamat" id="alamat" value="<?= $pbeli["alamat"]?>" required>
            </li>
            <li>
                <label for="maksimal_pembelian">Maksimal pembelian: </label>
                <input type="number" name="maksimal_pembelian" id="maksimal_pembelian" value="<?= $pbeli["maksimal_pembelian"]?>" required>
            </li>
            <li>
                <label for="kupon">Kupon: </label>
                <input type="number" name="kupon" id="kupon" value="<?= $pbeli["kupon"]?>" required>
            </li>
            <li>
                <label for="poin">Poin: </label>
                <input type="number" name="poin" id="poin" value="<?= $pbeli["poin"]?>" required>
            </li>
            <li>
                <label for="status_aktif">Status aktif</label>
                <input type="text" name="status_aktif" id="status_aktif" list="status-list" value="<?= $pbeli["status_aktif"]?>" required>
                <datalist id="status-list">
                    <option value="aktif"></option>
                    <option value="tidak aktif"></option>
                </datalist>
            </li>
        </ul>
        <button type="submit" name="submit">perbarui</button>
    </form>
</body>
</html>