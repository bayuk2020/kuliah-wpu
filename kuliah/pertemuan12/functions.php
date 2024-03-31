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


function login($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  //cek dulu username
  if ($user = query("SELECT * FROM user WHERE username = '$username'")) {

    // cek password
    //password_verify kebalikan dari password_hash()
    //cara kerjanya adalah membandingkan dari string biasa dengan string yang sudah di acak/hash
    if (password_verify($password, $user['password'])) {

      // set session
      $_SESSION['login'] = true;

      header("Location: index.php");
      exit;
    }
  }
  return [
    'error' => true,
    'pesan' => 'Username / Password Salah!'
  ];
}


function registrasi($data)
{
  $conn = koneksi();
  // Jangan eksekusi html, paksa semua user jadi huruf kecil
  $username = htmlspecialchars(strtolower($data['username']));
  // Tidak pakai htmlspecialchars, untuk menghindari SQL INJECTION,
  // Yang akan digunakan untuk mengecek ada script jahat atau tidak adalah mysql nya. Bukan PHP
  // mysqli_real_escape_string(koneksi, string_input_password)
  $password1 = mysqli_real_escape_string($conn, $data['password']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);


  // jika username / password kosong
  if (empty($username) || empty($password1) || empty($password2)) {
    echo "<script>
      alert('username / password tidak boleh kosong!');
      document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  // jika username sudah ada
  if (query("SELECT * FROM user WHERE username = '$username'")) {
    echo "<script>
      alert('Username sudah terdaftar!');
      document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  // jika konfirmasi password tidak sesuai
  if ($password1 !== $password2) {
    echo "<script>
      alert('Konfirmasi Password Tidak Sesuai!');
      document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  // jika password < 5 digit
  if (strlen($password1) < 5) {
    echo "<script>
      alert('Minimal Password 8 karakter!');
      document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  // jika username & password sudah sesuai

  // enkripsi password
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);

  // insert ke tabel user
  $query = "INSERT INTO user
            VALUES
            (null, '$username', '$password_baru')
            ";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
