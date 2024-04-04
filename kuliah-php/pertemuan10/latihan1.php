<?php

// Koneksi ke DB & Pilih Database ('localhost', 'user_db', 'pass_db','nama_db')
$conn = mysqli_connect('localhost', 'root', '', 'pw_c2c022511');

// Query isi table mahasiswa ('koneksi_db', 'query')
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");

// Cek data yang ter-query
// var_dump($result);

// ubah data ke dalam array
// $row = mysqli_fetch_row($result); // array numeric
// $row = mysqli_fetch_assoc($result); // array associative
// $row = mysqli_fetch_array($result); // both numeric & assoc

$rows = [];

while ($row = mysqli_fetch_assoc($result)) {
  $rows[] = $row;
}

// var_dump($rows);

// tampung ke variabel mahasiswa
$mahasiswa = $rows;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mahasiswa</title>
</head>

<body>
  <h3>Daftar Mahasiswa</h3>

  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>#</th>
      <th>Gambar</th>
      <th>NIM</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Jurusan</th>
      <th>Aksi</th>
    </tr>
    <?php $i = 1;
    foreach ($mahasiswa as $mhs) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><img src="img/<?= $mhs['gambar'] ?>" width="60px" alt=""></td>
        <td><?= $mhs['nim'] ?></td>
        <td><?= $mhs['nama'] ?></td>
        <td><?= $mhs['email'] ?></td>
        <td><?= $mhs['jurusan'] ?></td>
        <td><a href="">ubah</a> <a href="">hapus</a></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>