<?php 
// connect to mysql

$server = "localhost";
$user = "root";
$pass = "rooting";
$database = "mahasiswa_deklaratif";

$connect = mysqli_connect($server, $user, $pass, $database);

//  function to display the data
function query($query) {
    global $connect;
    $result = mysqli_query($connect, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// function to insert the data

function add($data) {
    global $connect;

    $nama = htmlspecialchars($data["name"]);
    $telp = htmlspecialchars($data["telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $image = upload();

    if ( !$image ) {
        return false;
    }

    $query = "INSERT INTO mahasiswa_dk (nama, image, telp, alamat)
              VALUES
              ('$nama', '$image','$telp','$alamat')";
    
    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

// function to upload image
function upload() {

    $fileName = $_FILES['image']['name'];
    $sizeFile = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $targetFile = "uploads/" . uniqid() . "_" . $fileName;
    $tmpName = $_FILES['image']['tmp_name'];

    // check whether nothing image upload

    if ($error === 4) {

        echo "<script>
                alert('choose file!')
            </script>";

        return false;

    }

    $allowedExtensions = ['jpg','jpeg','png','gif'];
    $maxFileSize = 2 * 1024 * 1024;
    $extensionImage = explode(".", $fileName);
    $extensionImage = strtolower(end($extensionImage));

    if(!in_array($extensionImage, $allowedExtensions)) {
        echo "<script>
        You have to upload image file!
        </script>";
        return false;
    }

    if($sizeFile > $maxFileSize) {
        echo "<script>
        echo('size file too big! image file must under 2mb.')
        </script>";
        return false;
    }

    if (move_uploaded_file($tmpName, $targetFile)) {
        return $targetFile;
    } else {
        echo "<script>
        failed!
        </script>";

        return false;
    }
}

function update($data) {
    global $connect;

    $id = $data["id"];
    $nama = htmlspecialchars($data["name"]);
    $telp = htmlspecialchars($data["telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $oldImage = htmlspecialchars($data["oldImage"]);

    if ($_FILES['image']['error'] === 4) {

        $image = $oldImage;

    } else {

        $image = upload();
        
    }

    $query = "UPDATE mahasiswa_dk SET 
                                nama = '$nama',
                                image = '$image',
                                telp = '$telp',
                                alamat = '$alamat'
                                WHERE id_mhs = $id ";
    
    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

function remove($id) {
    global $connect;
    mysqli_query($connect,"DELETE FROM mahasiswa_dk WHERE id_mhs = $id");

    return mysqli_affected_rows($connect);
}

function search($keyword) {
    
    $query = "SELECT * FROM mahasiswa_dk
                WHERE 
                nama like '%$keyword%'";
    
    return query($query);
}

?>