<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "DELETE FROM tb_barang WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: adminpage.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
