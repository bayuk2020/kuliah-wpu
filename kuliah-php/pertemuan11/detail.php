<?php

require('functions.php');

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

// ambil id dari URL
$id = $_GET['id'];

// query mahasiswa berdasarkan id
$mahasiswa = query("SELECT * FROM mahasiswa WHERE id = $id");

// Tidak bisa memanggil $mahasiswa['nama'] karena $mahasiswa berisi array di dalam array
// var_dump($mahasiswa);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
</head>

<body>
  <h3>Detail Mahasiswa</h3>
  <ul>
    <li><img src="img/<?= $mahasiswa['gambar'] ?>" width="200px"></li>
    <li>NIM : <?= $mahasiswa['nim'] ?></li>
    <li>Nama : <?= $mahasiswa['nama'] ?></li>
    <li>Email : <?= $mahasiswa['email'] ?></li>
    <li>Jurusan : <?= $mahasiswa['jurusan'] ?></li>

    <li>

      <a href="ubah.php?id=<?= $mahasiswa['id']; ?>">ubah</a> |

      <!-- kalau di klik tombol hapus, mengirimkan id supaya tahu siapa yang dihapus -->

      <a href="hapus.php?id=<?= $mahasiswa['id']; ?>" onclick="return confirm('apakah anda yakin?')">hapus</a>

    </li>
    <li><a href="index.php">Kembali ke daftar mahasiswa</a></li>
  </ul>
</body>

</html>