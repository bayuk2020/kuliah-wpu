<?php
require 'functions.php';
$mahasiswa = query('SELECT * FROM mahasiswa');

// ketika tombol cari diklik
if (isset($_POST['cari'])) {
  //apapun keyword akan di cari, dimasukkan ke var mahasiswa
  $mahasiswa = cari($_POST['keyword']);
}

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

  <a href="tambah.php">Tambah data mahasiswa</a>
  <br><br>

  <form action="" method="POST">
    <input autofocus type="text" name="keyword" id="" size="40px" placeholder="masukkan keyword pencarian.." autocomplete="off">
    <button type="submit" name="cari">Cari!</button>

  </form>
  <br>
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>#</th>
      <th>Gambar</th>
      <th>Nama</th>
      <th>Aksi</th>
    </tr>
    <?php if (empty($mahasiswa)) : ?>
      <tr>
        <td colspan="4">
          <p style="color: red; font-style: italic">Data mahasiswa tidak ditemukan</p>
        </td>
      </tr>
    <?php endif ?>
    <?php $i = 1;
    foreach ($mahasiswa as $mhs) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><img src="img/<?= $mhs['gambar'] ?>" width="60px" alt=""></td>
        <td><?= $mhs['nama'] ?></td>
        <td><a href="detail.php?id=<?= $mhs['id']; ?>">lihat detail</a></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>