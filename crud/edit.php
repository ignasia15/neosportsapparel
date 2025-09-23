<?php
include 'koneksi.php';

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $nama_barang = $_POST['nama'];
    $keterangan_barang = $_POST['keterangan'];
    $harga = $_POST['harga'];

    $foto = $_FILES['foto']['name'];
    if ($foto) {
        $target = "img/" . basename($foto);
        move_uploaded_file($_FILES['foto']['tmp_name'], $target);
        $sql = "UPDATE tb_barang SET nama='$nama_barang', keterangan='$keterangan_barang', foto='$foto', harga='$harga' WHERE id=$id";
    } else {
        $sql = "UPDATE tb_barang SET nama='$nama_barang', keterangan='$keterangan_barang', harga='$harga' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: adminpage.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$result = $conn->query("SELECT * FROM tb_barang WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Edit Barang</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama Barang:</label>
        <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required>
        <label>Keterangan Barang:</label>
        <input type="text" name="keterangan" value="<?php echo $row['keterangan']; ?>" required>
        <label>Foto:</label>
        <input type="file" name="foto">
        <label>Harga:</label>
        <input type="number" name="harga" value="<?php echo $row['harga']; ?>" required>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
