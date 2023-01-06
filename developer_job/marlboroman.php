<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Bootstrap saya -->
  <link rel="stylesheet" href="/css/style_pesan.css">

  <title>Data Pesan</title>
</head>

<body>
  <div class="container">
      <div class="row justify-content-center">
      <div class="col-md-6 mb-3">
    <h2 class="text-center display-5 mb-2">History Pesan</h2>
    <h2 class="text-center display-5 mb-2">
      IP Address = 
        <?php 
          $host= gethostname();
          $ip = gethostbyname($host);
          echo $ip
        ?>
    </h2>
    </div>
    </div>
    
    <div class="row justify-content-center">
      <div class="col-md mb-3">

    <table class="table table-hover table-bordered text-center">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Email</th>
          <th scope="col">Pesan</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>

          <?php
          include 'koneksi.php';
          $no = 1;
          $select = mysqli_query($conn, "SELECT * FROM datapesan");
          if (mysqli_num_rows($select) > 0) {
            while ($hasil = mysqli_fetch_array($select)) {
          ?>
              <td><?php echo $no++ ?></td>
              <td><?php echo $hasil['nama'] ?></td>
              <td><?php echo $hasil['email'] ?></td>
              <td><?php echo $hasil['pesan'] ?></td>
              <td>

                <a href="delete.php?id=<?php echo $hasil['id'] ?>" class="btn btn-danger" role="button">Hapus</a>
              </td>
        </tr>
      </tbody>
    <?php }
          } else { ?>
    <tr>
      <td colspan="11" align="center">Data Kosong</td>
    </tr>
  <?php } ?>
    </table>
    </div>
    </div>


    <br>
    <br>
  </div>


  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>