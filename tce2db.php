<?php
    include("db_connect.php");
    $method = $_SERVER["REQUEST_METHOD"];

    function getData() {
        // Lecture des données enregistrées
        global $conn;
        $requete = "SELECT * FROM data";
        $result = mysqli_query($conn, $requete);
        $datas = array();
        if (mysqli_num_rows($result) >0) {
            while($row = mysqli_fetch_assoc($result)) {
                $data = array();
                $data['id'] = $row['id'];
                $data['hchc'] = $row['hchc'];
                $data['hchp'] = $row['hchp'];
                $data['datation'] = $row['datation'];
                array_push($datas, $data);
            }
            echo json_encode($datas);
        }
        else echo '{}';
    }

    function addData() {
        global $conn;
        // Récupération des données téléinfo
        $address = "10.10.13.191";
        $port = "2300";
        /* Cree une socket TCP/IP. */
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket == false) {
            echo "socket_create() a échoué : raison :  " . socket_strerror(socket_last_error()) . "<br />";
        } 
        else {
            //echo "Creation Socket OK.<br />";
        }

        $result = socket_connect($socket, $address, $port);
        if ($socket == false) {
            echo "socket_connect() a échoué : raison : ($result) " . socket_strerror(socket_last_error($socket)) . "<br />";
        } 
        else {
            //echo "Connection Socket OK.<br />";
        }

        //echo "Lecture de la trame : <br />";
        sleep(2);
        $trame = socket_read($socket, 180);	
        $lgTrame = strlen($trame);

        if ($lgTrame >= 170) {
            $etiquette = "ADCO";
            $pos = strpos($trame,$etiquette);
            if ($pos !== false) {
                $ADCO = substr($trame,$pos+5,12);
            }
            else {
                $ADCO = "XXX";
            }

            $etiquette = "HCHC";
            $pos = strpos($trame,$etiquette);
            if ($pos !== false) {
                $HCHC = substr($trame,$pos+5,9);
            }
            else {
                $HCHC = "XXX";
            }

            $etiquette = "HCHP";
            $pos = strpos($trame,$etiquette); 
            if ($pos !== false) {
                $HCHP = substr($trame,$pos+5,9);
            }
            else {
                $HCHP = "XXX";
            }

            $etiquette = "PAPP";
            $pos = strpos($trame,$etiquette);
            if ($pos !== false) {
                $PAPP = substr($trame,$pos+5,5);
            }
            else {
                $PAPP = "XXX";
            }

            $etiquette = "IMAX";
            $pos = strpos($trame,$etiquette);
            if ($pos !== false) {
                $IMAX = substr($trame,$pos+5,3);
            }
            else {
                $IMAX = "XXX";
            }

            $etiquette = "PTEC";
            $pos = strpos($trame,$etiquette);
            if ($pos !== false) {
                $PTEC = substr($trame,$pos+5,2);
            }
            else {
                $PTEC = "XXX";
            }

            socket_close($socket);
        }

        // Enregistrement de la nouvelle donnée en base
        $requete = "INSERT INTO `data` (`hchc`, `hchp`) 
            VALUES ('".$HCHC."', '".$HCHP."');";
        // echo $requete;
        $result = mysqli_query($conn, $requete);
    }

    function deleteData() {
        global $conn;
        // Suppression des données en base
        $requete = "TRUNCATE `tce`.`data`;";
        $result = mysqli_query($conn, $requete);
    }

    switch($method) {
        case 'GET' :
            getData();
            break;
        case 'POST' :
            addData();
            break;
        case 'DELETE' :
            deleteData();
            break;
        }
?>
