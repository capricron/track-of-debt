setInterval(() => {
    const time = async () => {
        await fetch('time.php')
        .then(waktu => 
            waktu.json()
        ).then(waktu =>
            document.getElementById('jam').innerHTML = `${waktu} WIB`
        )
    }

    time()
}, 0);


console.log(window.innerWidth);

if(window.innerWidth > 1000){
    let kanan = document.getElementById('kanan');

    kanan.style.position = 'absolute';
    kanan.style.right = '0';
}


function openNav() {
  document.getElementById("mySidenav").style.width = "50%";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

function cek(id){
    axios.put(`/modif/${id}`,{
        id,
        check: document.getElementById(`check ${id}`).checked
    }).then(function (response) {
        console.log(response);
    })
    .catch(function (error) {
        console.log(error);
    });
}

