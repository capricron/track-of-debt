<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="register.css">

    <title>Daftar Akun</title>
  
  
   </head>

  <body>
  <div class="parent">
      <div class="container-card">
        <img src="../pp.png" alt="" class="responsive">
        <h2>Register</h2>
        @if ($errors->any())
          <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                {{ $error }}
              @endforeach
          </div>
        @endif

        <form class="text-center login" action="/register" method="post">
            @csrf
          <input class="no-outline" type="text" name="username" placeholder="username" required>
          <br>
          <br>
          <input type="password" class="no-outline" name="password" placeholder="password" required>
          <br>
          <br>
          <button class="submit" name="submit" type="submit" >Register</button>

        </form>
        <div class="line"></div>
        <a class="text-center" href="../login">
          <p>Sudah Punya Akun?</p>
        </a>
      </div>
    </div>
  
    <!-- <div class="form">
        <h1 class="text-center">Daftar Dulu Bos</h1>
        <a class="text-center" href="../login">
          <p>Sudah Punya Akun?</p>
        </a>
        <form class="text-center login" action="/register" method="post">
            @csrf
          <input class="no-outline" type="text" name="username" placeholder="username" required>
          <br>
          <br>
          <input type="password" class="no-outline" name="password" placeholder="password" required>
          <br>
          <br>
          <button class="submit" name="submit" type="submit" >Daftar</button>

        </form>
    </div> -->
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