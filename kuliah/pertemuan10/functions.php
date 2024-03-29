<?php

function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'pw_c2c022511');
}

function query($query)
{
  $conn = koneksi();

  $result = mysqli_query($conn, $query);

  // jika hasilnya hanya 1 data
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function tambah($data)
{
  // var_dump($data);
  $conn = koneksi();


  // htmlspecialchars mengubah inputan agar tidak mengeksekusi html
  // untuk keamanan
  $nama = htmlspecialchars($data['nama']);
  $nim = htmlspecialchars($data['nim']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);

  $query = "INSERT INTO
  mahasiswa
  VALUES(null, '$nama', '$nim' , '$email', '$jurusan', '$gambar');
  ";

  mysqli_query($conn, $query);

  //kalau gagal tampil eror
  echo mysqli_error($conn);

  // Memberitahu mysql ada baris yang berubah di db
  return mysqli_affected_rows($conn);
}
