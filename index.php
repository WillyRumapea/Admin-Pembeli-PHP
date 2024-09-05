<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: page/login.php");
    }

    require "controller/koneksi.php";
    require "controller/query.php";

    $dataOnPage = 2;
    $totalData = count(query("SELECT * FROM table_pembeli"));
    $page = ceil($totalData/$dataOnPage);
    var_dump($page);
    $activePage = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
    $firstData = ($dataOnPage * $activePage) - $dataOnPage; 

    
    $pembeli = query("SELECT * FROM table_pembeli LIMIT $firstData, $dataOnPage");

    if(isset($_POST["cari"])){
        $pembeli = search($_POST["search"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Hello Admin!</h1>
    <a href="page/logout.php">logout</a>
    <a href="page/tambah.php">tambah pembeli</a>
    <br>
    <form action="" method="post">
        <input type="text" name="search" placeholder="masukkan nama pembeli..." size="40" autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>
    <br>
     <?php for($i = 1; $i <= $page ; $i++):?>
        <?php if($i == $activePage):?>
            <a href="?halaman=<?= $i; ?>" style="text-decoration:none; color:blue;"><?= $i; ?></a>
        <?php else:?>
            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif;?>    
     <?php endfor;?>
    <table border="1" cellpadding=10 cellspacing=0>
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Member</th>
            <th>Kunjungan</th>
            <th>Alamat</th>
            <th>Maksimal Pembelian</th>
            <th>Kupon</th>
            <th>Poin</th>
            <th>Status_aktif</th>
            <th>Aksi</th>
        </tr>
        <?php $i = 1;?>
        <?php foreach($pembeli as $row) :?>
        <tr>
            <td><?= $i;?></td>
            <td>
                <img src="img/<?= $row["gambar"] ?>" alt="Profil Pembeli">
            </td>
            <td><?= $row["nama"] ?></td>
            <td><?= $row["gender"] ?></td>
            <td><?= $row["member"] ?></td>
            <td><?= $row["kunjungan"] ?></td>
            <td><?= $row["alamat"] ?></td>
            <td><?= $row["maksimal_pembelian"] ?></td>
            <td><?= $row["kupon"] ?></td>
            <td><?= $row["poin"] ?></td>
            <td><?= $row["status_aktif"] ?></td>
            <td>
                <div class="button-container">
                    <a href="page/update.php?id=<?= $row["id"]; ?>">Edit</a>
                    <a href="controller/queryDelete.php?id=<?= $row["id"]; ?>" onclick="return confirm('apa anda yakin ingin menghapus ?')">Hapus</a>
                </div>
            </td>
        </tr>
        <?php $i++;?>
        <?php endforeach ;?>
    </table>
</body>
</html>