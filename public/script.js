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
