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
    
    <title>Track of Debts</title>
  </head>
  <body>
    <nav class="navbar-parent">
        <div class="navbar-container">
            <div class="app-name">
                <a href="" class="navbar-image">
                    <img src="pp.png" alt="/" class="responsive">
                </a>
                <h2 style="color :white">Track of Debts</h2>

            </div>
            <div class="logout-container" id="mySidenav">
             <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <div class="logout">
                            <a href="/"><h7>Track of Debts</h7></a>
                            <h6>Username: <br>{{auth()->user()->username}}</h6>

                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Logout</button>
                            </form>
                </div>
            </div>
            <div class="logoutDesktop">
                            <h5>{{auth()->user()->username}}</h5>

                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Logout</button>
                            </form>
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
                <h1>Debt Info</h1>
                <div class="task-info-content">
                    
                    <div class="info">
                        <div class="merah"></div>
                        <p>Skipped Debt</p>
                    </div>
                    <div class="info">
                        <div class="kuning"></div>
                        <p>Today Debt</p>
                    </div>
                    <div class="info">
                        <div class="hijau"></div>
                        <p>Next Debt</p>
                    </div>
                    <div class="info">
                        <div class="lunas">
                            <i class="fa-solid fa-money-bill-1-wave"></i>
                        </div>
                        <p>Paid Off</p>
                    </div>
                </div>
            </div>
        <div class="active-task">
            <div class="header-active-task">
                <h1>Your Debt</h1>
                <a href="/create" class="add-task">
                    <p>+ Add Debt</p>
                </a>
            </div>

            {{-- Modal --}}

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modal-title" id="exampleModalLongTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="" id="modal-date">Date:<span></span></div>
                        <div class="" id="modal-deskripsi">Description:<span></span></div>
                        <div class="" id="modal-total">Total loan:<span></span></div>
                        <div class="" id="modal-contact">Phone number:<span></span></div>
                        <div class="" id="modal-number">ID number:<span></span></div>
                        <div class="" id="modal-address">Address:<span></span></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
            {{-- Modal --}}
            <div class="task-list">
            
            @forelse($debts as $utang)
            <div class="task">
                <div class="task-progress" >     
                    @if($utang->checked == 1)
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                    @else
                    <div id='status-{{$utang->id}}' class="status"
                        @if(($utang->tanggal > date('Y-m-d')) )
                             {{ " style = background-color:#59eb34; " }}
                        @elseif($utang->tanggal < date('Y-m-d'))
                             {{ " style = background-color:#eb5334; " }}
                        @elseif($utang->tanggal == date('Y-m-d'))
                             {{ " style = background-color:#ebeb34; " }}
                        @endif
                    ></div>
                    @endif
                    <br>
                    <h4>{{$utang->nama}}</h4>
                    <p>Date: {{date('d M Y', strtotime($utang->tanggal))}}</p>
                    <p>Total: Rp. {{$utang->jumlah}}</p>
                    <div class="verified">
                        <p>Apakah sudah lunas?
                        <label>
                        <input id="check {{$utang->id}}" type='checkbox' 
                                @if ($utang->checked >= 1)  
                                    {{'checked'}}
                                @endif 
                        onclick='cek({{$utang->id}})'>
                        <span class="checkbox">
                        </span>
                        <label>
                        </p>
                    </div>
                    <div class="button">
                        <form action="/modif" method="post">
                            @csrf
                            <input type="hidden" name="id" value={{$utang->id}}>
                            <button type="submit" class="button-edit">Edit</button>
                        </form>
                        <div class="button-right">
                            <button data-toggle="modal" data-target="#exampleModalCenter" onclick="modal({{$utang->id}})"  type="button" class="btn btn-success">Detail</button>
                            <form action="/delete/{{$utang->id}}" method="post">
                            <form action="/task/{{$utang->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$utang->id}}">
                                <button type="submit" class="button-delete">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <h3>You don't have any debt</h3>
            @endforelse
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="script.js"></script>

  </body>
</html>