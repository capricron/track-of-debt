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
    <nav class="navbar-parent">
        <div class="navbar-container">
            <a href="" class="navbar-image">
                <img src="pp.png" alt="/" class="responsive">
            </a>
            
            <div class="logout-container" id="mySidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <div class="logout">
                            <h2>{{auth()->user()->username}}</h2>

                            <a href="logout.php">
                                Log Out
                            </a>
                </div>

            </div>
            <div class="logoutDesktop">
                            <h5>{{auth()->user()->username}}</h5>

                            <a href="logout.php">
                                <p>Log Out</p>
                            </a>
                </div>
            <span class="hamburger" style="font-size:30px;cursor:pointer;color:#fff" onclick="openNav()">&#9776;</span>
        </div>
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn btn-primary">Logout</button>
        </form>
    </nav>
    <div class="content">
        <div class="greet">
            <h1>Good {{$waktu}} {{auth()->user()->username}}!</h1>
            <h3 id="jam"></h3>
        </div>
    </div>
    <div class="below">
        <div class="task-info">
            <h1>Task Info</h1>
            <div class="task-info-content">
                
                <div class="info">
                    <div class="merah"></div>
                    <p>Skipped task</p>
                </div>
                <div class="info">
                    <div class="kuning"></div>
                    <p>Today task</p>
                </div>
                <div class="info">
                    <div class="hijau"></div>
                    <p>Next task</p>
                </div>
            </div>
        </div>
        <div class="active-task">
            <div class="header-active-task">
                <h1>Active Task</h1>
                <a href="/create" class="add-task">
                    <p>+ Add Task</p>
                </a>
            </div>

            <div class="task-list"> 
            @empty($debts){
                <h3>You don't have any tasks</h3>
            }
            @endforelse

            @foreach($debts as $utang)
            <div class="task">
                <div id="mentu" class="task-progress">
                    <div class="status"
                        @if($utang->tanggal == date('Y-m-d'))
                             {{ " style = background-color:#ebeb34; " }}
                        @elseif($utang->tanggal < date('Y-m-d'))
                             {{ " style = background-color:#eb5334; " }}
                        @elseif($utang->tanggal > date('Y-m-d'))
                             {{ " style = background-color:#59eb34; " }}
                        @endif
                    ></div><br>
                    <h4>{{$utang->nama}}</h4>
                    <p>Date: {{date('d M Y', strtotime($utang->tanggal))}}</p>
                    <p>Time: {{$utang->jam}}</p>
                    <input id="check {{$utang->id}}" type='checkbox' 
                            @if ($utang->checked >= 1)  
                                {{'checked'}}
                            @endif 
                        onclick='cek({{$utang->id}})'>
                    <div class="button">
                        <form action="/modif" method="post">
                            @csrf
                            <input type="hidden" name="id" value={{$utang->id}}>
                            <button type="submit" class="button-edit">Edit</button>
                        </form>
                        <form action="/task/{{$utang->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button-delete">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
    </nav> -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="script.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>