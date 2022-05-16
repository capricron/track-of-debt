<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Pantau Tugas</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="pp.png" alt="">
                <span class="judul">Pantau Tugas</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div id="kanan">
                    <a href="">
                        <div class="wc add text-center">
                            <a href="/create">
                                <p>+ Add Tugas</p>
                            </a>
                        </div>
                    </a>
                    <div class="wc acc ">
                        <h2>{{auth()->user()->username}}</h2>

                        <a href="logout.php">
                            <p>Log Out</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="konten">
        <div class="salam container">
            <h1>Selamat {{$waktu}} {{auth()->user()->username}}</h1>
            <h3 id="jam"></h3>
        </div>
        <br>
        <div class="tabel container">
            <span><div class="merah"></div>: Tugas telah melewati tanggal deadline</p>
            <p><div class="kuning"></div>: Tugas hari ini</p>
            <p><div class="hijau"></div>: Tugas yang akan datang</p>
            <br>
            <div class="konten">
            <table border='1' style="width: 100%">
                <tr>
                    <th>Tugas</th>
                    <th class='text-center'>Deadline Tanggal</th>
                    <th class='text-center'>Deadline Jam</th>
                    <th class='text-center'>Checked</th>
                    <th></th>
                </tr>
                @empty($tasks){
                    <td colspan="1000"> <h1 class="kosong text-center">Yatta! Kamu tidak punya tugas untuk di selesaikan</h1> </td>
                }
                @endforelse
                @foreach($tasks as $tugas)
                <tr
                        @if($tugas->tanggal == date('Y-m-d'))
                             {{ " style = background-color:#ebeb34; " }}
                        @elseif($tugas->tanggal < date('Y-m-d'))
                             {{ " style = background-color:#eb5334; " }}
                        @elseif($tugas->tanggal > date('Y-m-d'))
                             {{ " style = background-color:#59eb34; " }}
                        @endif
                >
                    <td class='text-center'>{{$tugas->nama}}</td>
                    <td class='text-center'>{{date('d M Y', strtotime($tugas->tanggal))}}</td>
                    <td class='text-center'>{{$tugas->jam}}</td>
                    <td class='text-center'>
                        <input type='checkbox' 
                            @if ($tugas->checked >= 1)  
                                {{'checked'}}  
                            @else 
                                {{'none'}} 
                            @endif 
                        onclick='return false;' ></td>
                    <td class='text-center'>
                        <form style="display:inline" action="/modif" method="post">
                            @csrf
                            <input type="hidden" name="id" value={{$tugas->id}}>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                        <form style="display:inline" action="/task/{{$tugas->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </style=>
                @endforeach
            </table>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="script.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>