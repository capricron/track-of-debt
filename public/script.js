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
}, 1000);


if(window.innerWidth > 1000){
    let kanan = document.getElementById('kanan');

    kanan.style.position = 'absolute';
    kanan.style.right = '0';
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