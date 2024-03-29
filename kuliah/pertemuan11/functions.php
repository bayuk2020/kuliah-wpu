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

  mysqli_query($conn, $query) or die(mysqli_error($conn));

  //kalau gagal tampil erornya
  // or die echo mysqli_error($conn);

  // Memberitahu mysql ada baris yang berubah di db
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  $conn = koneksi();

  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id") or die(mysqli_error($conn));
  // tips : jika terjadi error, bisa langsung terminate program
  // or die mysqli_error($conn) supaya tahu eror nya dimana

  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  // var_dump($data);
  $conn = koneksi();


  // htmlspecialchars mengubah inputan agar tidak mengeksekusi html
  // untuk keamanan
  $id = htmlspecialchars($data['id']);
  $nama = htmlspecialchars($data['nama']);
  $nim = htmlspecialchars($data['nim']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);


  // meskipun hanya 1 field yang diubah, akan ditimpa semuanya dengan yang baru
  $query = "UPDATE mahasiswa SET
              nama = '$nama',
              nim = '$nim',
              email = '$email',
              jurusan = '$jurusan',
              gambar = '$gambar'
            WHERE id = $id";

  mysqli_query($conn, $query) or die(mysqli_error($conn));

  //kalau gagal tampil erornya
  // or die echo mysqli_error($conn);

  // Memberitahu mysql ada baris yang berubah di db
  return mysqli_affected_rows($conn);
}


function cari($keyword)
{

  $conn = koneksi();

  $query = "SELECT * FROM mahasiswa
            WHERE nama LIKE '%$keyword%'
            OR nim LIKE '%$keyword%'
            OR jurusan LIKE '%$keyword%'";

  $result = mysqli_query($conn, $query);

  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}
