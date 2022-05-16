<?php
    session_start();

    require '../func/functions.php';

   $id = $_GET['id'];

   $username = $_SESSION['username'];

   $sql = "SELECT * FROM {$username} WHERE id = $id";
   
   $data = mysqli_fetch_assoc(mysqli_query($koneksi, $sql));

    if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
      header('Location: ../login');
    };

    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $tanggal = $_POST['tanggal'];
        $jam = $_POST['jam'];
        if(isset($_POST['check'])){
          $check = $_POST['check'];
        }else if(!isset($_POST['check'])){
          $check = 'off';
        };

        switch($check){
          case 'on': 
            $check = 1;
            break;
          case 'off' :
            $check = 0;
            break;
        };
        update($username,$id,$nama,$tanggal,$jam,$check);
        
    };

    if(isset($_POST['hapus'])){
      hapus($username,$id);  
    }


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

    <title>Detail Tugas</title>
  
  
   </head>

  <body>
    <div class="gambar container text-center">
    <img src="../pp.png" alt="" srcset="" class="text-center">
    </div>
    <div class="form">
        <h1 class="text-center">Detail Tugas</h1>
        <form class="text-center login" action="" method="post">
          <p>Nama Tugas</p>
          <input class="x no-outline" type="text" name="nama" value="<?= $data['nama'] ?>" required>
          <br>
          <br>
          <p>Deadline Tanggal</p>
          <input type="date" class="x no-outline" name="tanggal" placeholder="" value="<?= $data['tanggal'] ?>" required>
          <br>
          <br>
          <p>Deadline Jam</p>
          <input type="time" class="x no-outline" name="jam" value="<?= $data['jam'] ?>" required>
          <br>
          <br>
          <label class="check" for="check">Apakah Anda sudah mengerjakan?</label>
          <input type='checkbox' <?= ($data['checked'] >= 1  ? 'checked' : 'none')?> name="check" >
          <br>
          <br>
          <button class="submit" name="hapus" type="submit" >Hapus</button>
          <br>
          <br>
          <button class="submit" name="submit" type="submit" >Update</button>
          <br>
          <br>
        </form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>