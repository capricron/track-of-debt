<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="create-task.css">

    <title>Tambah Tugas</title>
  
  
   </head>

  <body>
    <div class="parent">
      <div class="container-card">
        <a href="/"><i class="arrow left"></i></a>
        <h1>Update this debt</h1>
        <form class="text-center login" action="/update/{{$debt->id}}" method="post">
          @method('put')
          @csrf
          <input class="no-outline" type="text" name="nama" placeholder="Task name" required value={{$debt->nama}}>
          <br>
          <br>
          <input type="date" class="no-outline" name="tanggal" placeholder="dd-mm-yyyy" required value={{$debt->tanggal}}>
       
      </div>
    </div>
    <div class="content">
      <div class="content-create">
          <input style="color:black" class="no-outline" type="text" name="deskripsi" placeholder="Description" required value={{$debt->deskripsi}}>
          <br>
          <br>
          <input class="no-outline" type="number" name="jumlah" placeholder="Total loan" required  value={{$debt->jumlah}}>
          <input class="no-outline" type="number" name="phone" placeholder="Phone number" required value={{$debt->phone}}>
          <input class="no-outline" type="number" name="noKtp" placeholder="KTP number" required value={{$debt->noKtp}}>
          
          <input style="color:black" class="no-outline" type="text" name="alamat" placeholder="Address" required  value={{$debt->alamat}}>
          <br>
          <br>
          <button class="submit" name="submit" type="submit" >Update</button>
        </form>
      </div>
    </div>
  </body>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>