<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

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

                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Logout</button>
                            </form>
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
        
    </nav>
    <div class="content">
        <div class="greet">
            <h1>Good <span id="salam"></span> {{auth()->user()->username}}!</h1>
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

            {{-- Modal --}}

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modal-title" id="exampleModalLongTitle">
                        
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="modal-body">
                        <h2 id="modal-deskripsi">Deskripsi <span></span> </h2>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>
            {{-- Modal --}}
            <div class="task-list"> 
            @empty($debts){
                <h3>You don't have any tasks</h3>
            }
            @endforelse
            
            @foreach($debts as $utang)
            <div class="task">
                <div data-toggle="modal" data-target="#exampleModalCenter" onclick="modal({{$utang->id}})" class="task-progress" >     
                    <div id='status-{{$utang->id}}' class="status"
                        @if(($utang->checked >= 1) || ($utang->tanggal > date('Y-m-d')) )
                             {{ " style = background-color:#59eb34; " }}
                        @elseif($utang->tanggal < date('Y-m-d'))
                             {{ " style = background-color:#eb5334; " }}
                        @elseif($utang->tanggal == date('Y-m-d'))
                             {{ " style = background-color:#ebeb34; " }}
                        @endif
                    ></div>
                    <i class="fa-solid fa-money-bill-1-wave"></i>
                    <br>
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
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="script.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>