const time = () => {
    let time  = new Date();
    let hour = time.getHours();
    let minute = time.getMinutes();
    let second = time.getSeconds();

    if(second >= 0 && second < 10 ) {
        second = "0" + second;
    }
    if(minute >= 0 && minute < 10 ) {
        minute = "0" + minute;
    }
    if(hour >= 0 && hour < 10 ) {
        hour = "0" + hour;
    }

    document.getElementById("jam").innerHTML = `${hour}:${minute}:${second}`;


    // ucapan salam
    if (hour >= 0 && hour < 12) {
        document.getElementById("salam").innerHTML = "Morning";
    }else if (hour >= 12 && hour < 15) {
        document.getElementById("salam").innerHTML = "Evening";
    }
    else if (hour >= 15 && hour < 18) {
        document.getElementById("salam").innerHTML = "Afternoon";
    }
    else if (hour >= 18 && hour < 24) {
        document.getElementById("salam").innerHTML = "Night";
    }
}

setInterval(() => {
    time();
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

function ngetest(id){
    console.log(`test ${id}`);
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

// ucapan salam
