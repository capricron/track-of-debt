function openNav() {
  document.getElementById("mySidenav").style.width = "50%";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

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
}, 1000);


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

    window.location.hash = `#status-${id}`;
    window.location.reload(true);
}

function modal(id){
    // axios.get(`/${id}`).then(function (response) {
    //     console.log(response);
    //     document.getElementById("modal-title").innerHTML = response.data.title;
    //     document.getElementById("modal-body").innerHTML = response.data.body;
    //     document.getElementById("modal-footer").innerHTML = response.data.footer;
    // })
    const title =  document.getElementById("modal-title")
    const desk = document.getElementById("modal-deskripsi").childNodes[1];
    const total = document.getElementById("modal-total").childNodes[1];
    const contact = document.getElementById("modal-contact").childNodes[1];
    const number = document.getElementById("modal-number").childNodes[1];
    const address = document.getElementById("modal-address").childNodes[1];
    axios.get(`/task/${id}`, id).then(function (response) {
        title.innerHTML = response.data.nama;
        desk.innerHTML = response.data.deskripsi;
        total.innerHTML = response.data.jumlah;
        contact.innerHTML = response.data.phone;
        number.innerHTML = response.data.noKtp;
        address.innerHTML = response.data.alamat
    })
}