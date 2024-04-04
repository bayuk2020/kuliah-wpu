// Preview Image Untuk Tambah dan Ubah
function previewImage() {
  const gambar = document.querySelector('.gambar');
  const imgPreview = document.querySelector('.img-preview');

  // Memanggil class FileReader untuk membaca file yang kita upload
  const oFReader = new FileReader();
  oFReader.readAsDataURL(gambar.files[0]);

  oFReader.onload = function (oFREvent) {
    // file tsb disimpan untuk menggantikan src imgPreview
    imgPreview.src = oFREvent.target.result;
  };
}