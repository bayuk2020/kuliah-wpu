<?php
session_start();

//jika tidak mempunyai session, tendang paksa ke halaman login
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require "functions.php";

// jika tidak ada id di URL dia tidak error, namun lari ke halaman index
if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

// ambil id dari URL lalu query data sesuai yang dipilih
$id = $_GET['id'];

// query mahasiswa berdasarkan id
$mahasiswa = query("SELECT * FROM mahasiswa WHERE id = $id");
// var_dump($mahasiswa);

// cek apakah tombol ubah sudah ditekan

if (isset($_POST['ubah'])) {
  // var_dump($_POST);

  if (ubah($_POST) > 0) {
    echo "<script>
    alert('Data berhasil diubah!');
    document.location.href = 'detail.php?id=$id';
    </script>";
  } else {
    echo "Data gagal diubah!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Mahasiswa</title>
</head>

<body>
  <h3>Form Ubah Data Mahasiswa</h3>
  <form action="" method="POST">
    <!-- Untuk mengetahui mahasiswa mana yang di edit -->
    <input type="hidden" name="id" value="<?= $mahasiswa['id']; ?>">
    <ul>
      <li>
        <label>
          Nama :
          <input type="text" name="nama" autofocus required value="<?= $mahasiswa['nama']; ?>">
        </label>
      </li>
      <li>
        <label>
          NIM :
          <input type="text" name="nim" required value="<?= $mahasiswa['nim']; ?>">
        </label>
      </li>
      <li>
        <label>
          Email :
          <input type="text" name="email" required value="<?= $mahasiswa['email']; ?>">
        </label>
      </li>
      <li>
        <label>
          Jurusan :
          <input type="text" name="jurusan" required value="<?= $mahasiswa['jurusan']; ?>">
        </label>
      </li>
      <li>
        <label>
          Gambar :
          <input type="text" name="gambar" required value="<?= $mahasiswa['gambar']; ?>">
        </label>
      </li>
      <li>
        <button type="submit" name="ubah">Ubah</button>
      </li>
    </ul>
  </form>
  <br>
  <a href="detail.php?id=<?= $mahasiswa['id']; ?>">Batal Ubah</a>
</body>

</html>