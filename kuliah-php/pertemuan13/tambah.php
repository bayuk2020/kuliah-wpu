<?php
session_start();

//jika tidak mempunyai session, tendang paksa ke halaman login
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require "functions.php";

// cek apakah tombol tambah sudah ditekan

if (isset($_POST['tambah'])) {
  // var_dump($_POST);

  if (tambah($_POST) > 0) {
    echo "<script>
    alert('Data berhasil ditambah!');
    document.location.href = 'index.php';
    </script>";
  } else {
    echo "Data gagal ditambahkan!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Mahasiswa</title>
</head>

<body>
  <h3>Form Tambah Data Mahasiswa</h3>

  <!-- Sebelum bekerja dengan file, harus menambahkan atribut pada form enctype="multipart/form-data" -->
  <!-- Dengan menambahkan atribute tsb, kita dapat akses ke super global baru yang bernama $_FILES -->
  <form action="" method="POST" enctype="multipart/form-data">
    <ul>
      <li>
        <label>
          Nama :
          <input type=" text" name="nama" autofocus required>
        </label>
      </li>
      <li>
        <label>
          NIM :
          <input type="text" name="nim" required>
        </label>
      </li>
      <li>
        <label>
          Email :
          <input type="text" name="email" required>
        </label>
      </li>
      <li>
        <label>
          Jurusan :
          <input type="text" name="jurusan" required>
        </label>
      </li>
      <li>
        <label>
          Gambar :
          <input type="file" name="gambar" class="gambar" onchange="previewImage()">
        </label>

        <br><br>

        <img src="img/user-default.png" width="120" alt="" style="display: block;" class="img-preview">

        <br>
      </li>
      <li>
        <button type="submit" name="tambah">Tambah</button>
      </li>
    </ul>
  </form>
  <!-- Ntah kenapa kalau digabungin dengan script.js malah error gamau jalan, yaudah gw sendiriin aja ke previewImage.js -->
  <script src="js/previewImage.js"></script>


</body>

</html>