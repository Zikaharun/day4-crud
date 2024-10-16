<?php
// connect to dbms
require 'functions.php';

// get data in url

$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$result = query("SELECT * FROM mahasiswa_dk WHERE id_mhs = $id")[0];


// mengecek tombol submit whether have been clicked or not.

if (isset($_POST["submit"])) {

            // Jika valid, baru lanjutkan ke fungsi `add()`
            if ( update($_POST) > 0) {
                // Jika data berhasil ditambahkan
                echo "<script>
                        alert('Data changed!');
                        document.location.href = 'index.php';
                      </script>";
            } else {
                // Jika gagal menambahkan data
                echo "<script>
                        alert('fail to added!');
                      </script>";
            }
        

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit data siswa | PHP day4</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $result["id_mhs"]; ?>"/>
        <input type="hidden" name="oldImage" value="<?= $result['image'];?>"/>
        <ul>
            <li>
                <label for="name">nama: </label>
                <input type="text" name="name" required value="<?= $result["nama"];?>"/>
            </li>
            <li>
                <img src="<?= $result["image"] ?>" width="50"/><br>
                <input type="file" name="image" accept="image/*"/>
            </li>
            <li>
                <label for="telp">telp: </label>
                <input type="text" name="telp"  required value="<?=$result["telp"];?>"/>
            </li>
            
            <li>
                <label for="alamat">alamat: </label>
                <input type="alamat" name="alamat" required value="<?=$result["alamat"];?>"/>
            </li>
            <li>
                <button type="submit" name="submit">Edit</button>
            </li>
        </ul>
    </form>
    <br>
    <a href="/phpdasar/DAY4-CRUD/index.php">back</a>
</body>
</html>