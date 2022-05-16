<?php
        $srv = "sql112.epizy.com";
        $usr = "epiz_29836050";
        $pass = "vLeDIWbJKY";
        $db = "epiz_29836050_pantauan";

        // $srv = "Localhost";
        // $usr = "root";
        // $pass = "";
        // $db = "test";

    $koneksi = mysqli_connect($srv,$usr,$pass,$db);

    function salam(){
        date_default_timezone_set('Asia/Jakarta');
        $jam = date('H');

        if( $jam > 5 && $jam < 12 ){
            echo 'pagi';
        }else if ($jam > 11 && $jam < 15){
            echo 'siang';
        }else if ($jam > 14 && $jam < 18){
            echo 'sore';
        }else if ( $jam > 17 && $jam > 6){
            echo 'malam';
        };

    };

    function addAcc($username,$password){
        global $koneksi;

        $sql = "INSERT INTO login VALUES ('$username','$password')";
        
        mysqli_query($koneksi, $sql);
    };

    function makeTable($username){
        global $koneksi;

        echo $username;

        $sql = "CREATE TABLE {$username} (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nama VARCHAR(255) NOT NULL,
            tanggal VARCHAR(255) NOT NULL,
            jam VARCHAR(255) NOT NULL,
            checked INT(1) NOT NULL
        )";

        echo $sql;
        $table = mysqli_query($koneksi,$sql);

        if($table){
            header('Location: ../login/');
        }
        else if(!$table){
            echo 'gagal';
        };
    };

    function login($username,$password){
        global $koneksi;

        $query = mysqli_query($koneksi,"SELECT * FROM login WHERE username='$username' and password='$password'");

        $cek = mysqli_num_rows($query) ;

        if($cek > 0){
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            header('Location: ../index.php');
        };
    };

    function tr($tanggal){
        if($tanggal == date('Y-m-d')){
            echo '<tr style="background-color: yellow;">';
        }else if($tanggal < date('Y-m-d')){
            echo '<tr style="background-color: red;">';
        }
        else if($tanggal > date('Y-m-d')){
            echo '<tr style="background-color: #12fc54;">';
        };
    };

    function td($isi){
        foreach ($isi as $value) {
            $tanggal = $value['tanggal'];
            $tanggal = str_replace('/', '-', $tanggal);
            $tanggal =  date('d M Y', strtotime($tanggal));
            $id = $value['id'];
            tr($value['tanggal'], $value['checked']);
            echo "<td>" .$value['nama']. "</td>";
            echo "<td class='text-center'>" .$tanggal. "</td>";
            echo "<td class='text-center'>" .$value['jam']. "</td>";
            echo "<td class='text-center'> <a href='detail/index.php?id=".$id ."'> ... </a> </td>";
            echo "<td> <input type='checkbox'".($value['checked'] >= 1  ? 'checked' : 'none'). " onclick='return false;' >";
            echo "<tr>";
        };
    };


    function query($username){
        global $koneksi;
        $query = "SELECT * FROM " .$username;
        $datas = mysqli_query($koneksi,$query);
        $dataRow = mysqli_num_rows($datas);

        if($dataRow > 0){
            $isi = [];
            while($dataAsoc = mysqli_fetch_assoc($datas)){
                $isi[] = $dataAsoc;
            };

            
            td($isi);
        }else {
            return '<td colspan="1000"> <h1 class="kosong text-center">Yatta! Kamu tidak punya tugas untuk di selesaikan</h1> </td>';
        };
    };

    function addTugas($username,$nama,$tanggal,$jam){
        global $koneksi;

        $sql = "INSERT INTO {$username} VALUES ('','$nama','$tanggal','$jam','0')";
        echo $sql;
        $masuk = mysqli_query($koneksi,$sql);
        echo $masuk;
        if ($masuk) {
            header("Location: ../index.php");
        };
    }

    function update($username,$id,$nama,$tanggal,$jam,$check){
        global $koneksi;
        $sql = "UPDATE {$username} SET nama='$nama', tanggal='$tanggal', jam='$jam', checked='$check' WHERE id='$id'";
        mysqli_query($koneksi, $sql);
        if(mysqli_query($koneksi, $sql)){
            header('Location: ../index.php');
        };

    };

    function  hapus($username,$id){
        global $koneksi;
        $sql = "DELETE FROM {$username} WHERE id='$id'";
        $cek = mysqli_query($koneksi, $sql);
        if(mysqli_query($koneksi, $sql)){
            header('Location: ../index.php');
        };
    }
    
?>

