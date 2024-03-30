<?php

session_start();

//jika tidak mempunyai session, tendang paksa ke halaman login
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

// hubungkan ke function, supaya halaman hapus bisa terhubung ke file
// function karena semua fungsi yang dibutuhkan ada di file tsb

require 'functions.php';

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

// ambil id yang dikirimkan melalui url

$id = $_GET['id'];

// kalau ada mhs yang dihapus, nilai 1, gagal = 0
if (hapus($id) > 0) {
  echo "<script>
  alert('Data berhasil dihapus!');
  document.location.href = 'index.php';
  </script>";
} else {
  echo "Data gagal dihapus!";
}
