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

// mengelola file yang di upload form
function upload()
{
  $nama_file = $_FILES['gambar']['name'];
  $tipe_file = $_FILES['gambar']['type'];
  $ukuran_file = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmp_file = $_FILES['gambar']['tmp_name'];

  // ketika tidak ada gambar yang dipilih
  // kalau tidak ada gambar, error = 4
  if ($error == 4) {
    echo "<script>
    alert('pilih gambar terlebih dahulu!');
    </script>";
    // supaya upload nya false, $gambar = false
    return false;
  }

  // ketika yang di upload bukan gamber
  // cek ekstensi file
  $daftar_gambar = ['jpg', 'jpeg', 'png'];
  // pecah nama file, menjadi array dipisahkan .
  $ekstensi_file =  explode('.', $nama_file);
  // ambil array yang terakhir, sebagai ekstensi (format file)
  // jadikan huruf kecil semua
  $ekstensi_file = strtolower(end($ekstensi_file));
  // bandingkan nilai tsb apakah ada di dalam array atau tidak, dalam hal ini, dibandingkan dengan $daftar_gambar yang memuat ekstensi yang boleh masuk
  // Jika nama file tidak ada di dalam array, dipastikan bukan gambar
  // in_array('file_yang_dipunya', 'daftar_yang_boleh_masuk') mencari jarum di tumpukan jerami
  if (!in_array($ekstensi_file, $daftar_gambar)) {
    echo "<script>
    alert('Yang Anda Pilih Bukan Gambar!');
    </script>";
    return false;
  }

  // ketika user upload script jahat tapi format file nya jpg
  // cara menangani, cek type file
  if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
    echo "<script>
    alert('Yang Anda Pilih Bukan Gambar!');
    </script>";
    return false;
  }

  // Cek ukuran file, tidak boleh terlalu besar
  // maksimal 1MB = 3.000.000 byte
  if ($ukuran_file > 3000000) {
    echo "<script>
    alert('Ukuran gambar terlalu besar \\n Tidak boleh lebih dari 3MB!');
    </script>";
    return false;
  }

  // LOLOS PENGECEKKAN
  // generate nama file baru (menghindari nama file sama)
  $nama_file_baru = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_file;

  // memindahkan dari tempat penyimpanan sementara (tmp)
  // ke tempat yang kita inginkan

  move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

  // return function dengan $nama_file_baru 
  // supaya begitu file berhasil masuk ke $gambar di function
  // berisi nama file, sehingga waktu di insert ke DB nama filenya masuk
  return $nama_file_baru;
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
  // $gambar = htmlspecialchars($data['gambar']);

  // upload gambar
  $gambar = upload();
  // jika gambar false, return false
  if (!$gambar) {
    return false;
    // ketika function tambah() = false, masuk ke tambah.php, dan data gagal ditambahkan
  }

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
