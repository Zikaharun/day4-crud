<?php
// connect to dbms
require 'functions.php';

// mengecek tombol submit whether have been clicked or not.

if (isset($_POST["submit"])) {
    
        // Periksa apakah nomor telepon melebihi 15 karakter
        if (strlen($_POST["telp"]) > 15) {
            // Jika melebihi, tampilkan pesan alert
            echo "<script>
                    alert('Nomor telepon melebihi batas maksimal 15 karakter.');
                    document.location.href = 'add.php'; // Redirect kembali ke form
                  </script>";
        } else {
            // Jika valid, baru lanjutkan ke fungsi `add()`
            if (add($_POST) > 0) {
                // Jika data berhasil ditambahkan
                echo "<script>
                        alert('Data berhasil ditambahkan!');
                        document.location.href = 'index.php';
                      </script>";
            } else {
                // Jika gagal menambahkan data
                echo "<script>
                        alert('Gagal menambahkan data.');
                      </script>";
            }
        }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menambahkan data siswa | PHP day4</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="name">nama: </label>
                <input type="text" name="name" required/>
            </li>
            <li>
                <input type="file" name="image" accept="image/*">
            </li>
            <li>
                <label for="telp">telp: </label>
                <input type="text" name="telp"  required/>
            </li>
            
            <li>
                <label for="alamat">alamat: </label>
                <input type="alamat" name="alamat" required/>
            </li>
            <li>
                <button type="submit" name="submit">add</button>
            </li>
        </ul>
    </form>
    <br>
    <a href="/phpdasar/DAY4-CRUD/index.php">back</a>
</body>
</html>