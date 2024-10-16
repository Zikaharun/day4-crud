<?php
// Koneksi Database
require "functions.php";

$result = query("SELECT * FROM mahasiswa_dk");

if(isset($_POST["search"])) {
    $result = search($_POST["keyword"]);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar mahasiswa</title>
</head>
<br>
    <h1>Daftar mahasiswa</h1>
    <a href="add.php">tambah mahasiswa</a>
    <br></br>

    <form action="" method="post">
        <input type="text" name="keyword" placeholder="cari siswa..." />
        <button type="submit" name="search">search</button>
    </form>
    <br>
    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>nama</th>
            <th>image</th>
            <th>telp</th>
            <th>alamat</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach( $result  as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td>
                    <a href="update.php?id=<?= $row["id_mhs"]; ?>">ubah</a>
                    <a href="remove.php?id=<?= $row["id_mhs"]; ?>" onclick="return confirm('Are you sure?');">hapus</a>
                </td>
                <td><?= $row["nama"]?></td>
                <td><img src="<?= $row["image"] ?>" width="50"></td>
                <td><?= $row["telp"]?></td>
                <td><?= $row["alamat"]?></td>

            </tr>
            <?php $i++;?>
            <?php endforeach; ?>
    </table>
</body>
</html>