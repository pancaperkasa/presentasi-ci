<?php
//bangun koneksi
include('koneksi.php');
//Kirimkan Variabel

$nama = $_POST['nama'];
$email = $_POST['email'];
$pesan = $_POST['pesan'];

//query

$query =  "INSERT INTO datapesan(nama, email , pesan)
   VALUES('$nama' , '$email' , '$pesan')";

if (mysqli_query($conn, $query)) {
?>
  <script language="JavaScript">
    alert('Pesan Anda Berhasil Dikirm');
    document.location = 'index.html';
  </script>
<?php
} else {
  echo "ERROR, tidak berhasil" . mysqli_error($conn);
}

mysqli_close($conn);
?>