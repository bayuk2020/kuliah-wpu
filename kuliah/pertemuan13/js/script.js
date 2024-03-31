
const tombolCari = document.querySelector('.tombol-cari');
const keyword = document.querySelector('.keyword');
const container = document.querySelector('.container');

// hilangkan tombol cari
// mengubah css dengan js
tombolCari.style.display = 'none';

// event ketika kita menuliskan keyword
keyword.addEventListener('keyup', function() {

  // ajax

  // xmlhttprequest

  // Secara singkat, Ajax adalah bagaimana cara kita untuk melakukan request terhadap sebuah sumber (sumber nya bisa halaman lain, bisa website lain) tanpa melakukan refresh pada halaman
  // Singkatnya, live search / pencarian singkat
  // Contoh : chat di FB, itu tidak ada refresh

            //   const xhr = new XMLHttpRequest();

            //   xhr.onreadystatechange = function() {
            //     // jika ajax nya memiliki sumber dari halaman sudah siap (4) dan halaman tujuannya oke (200)
            //     if(xhr.readyState == 4 && xhr.status == 200) {
            //       // Tampilkan apapun respon yang diberikan oleh hlm ajax_cari.php
            //       // console.log(xhr.responseText);

            //       // ganti div.container
            //       container.innerHTML = xhr.responseText;
            //     }
            //   };

            //   // Siapkan ajax nya - xhr.open('methodnya_apa', 'requestnya_kemana_ajaxnya')
            //           // ambil apapun yang diketikkan di kolom cari
            //           // kemudian kirimkan ke halaman ajax_cari

            // xhr.open('get','ajax/ajax_cari.php?keyword=' + keyword.value);
            // xhr.send();

  // Sayangnya kita tidak pakai cara diatas,
  // kita akan menggunakan fitur baru js yang sedang nge trend
  // fetch('dikirim_kemana_ajaxnya')

  // begini saja sudah melakukan request tapi data yang di kembalikan belum sesuai keinginan kita
  fetch('ajax/ajax_cari.php?keyword=' + keyword.value)

  // data yang di kembalikan, respon yang didapatkan itu dijalankan ke dalam sebuah function response.text()
  .then((response) => response.text())

  // kemudian response nya setelah dapat, innerHTML diisi dengan responnya
  .then((response) => (container.innerHTML = response));

});