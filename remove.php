<?php
require 'functions.php';
$id = $_GET["id"];

if(remove($id) > 0) {
    echo "<script>
        alert('data succes removed!')
        document.location.href = 'index.php';
        </script>";
} else {
    echo "<script>alert('failed!')</script>";
}