<?php
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

        $teleinfo = array();
        $teleinfo['adco'] = $ADCO;
        $teleinfo['hchc'] = $HCHC;
        $teleinfo['hchp'] = $HCHP;
        $teleinfo['papp'] = $PAPP;
        $teleinfo['imax'] = $IMAX;
		$teleinfo['ptec'] = $PTEC;
		
		echo json_encode($teleinfo);

        // echo "Contenu du fichier : <br />".json_encode($teleinfo)."<br />";

		$dir = dirname(__FILE__);
		$json_file = $dir."/teleinfo.json";
		// echo "Nom du fichier : ".$json_file."<br />";
		$nbOctetsEcrits = file_put_contents($json_file, json_encode($teleinfo));
		if ($nbOctetsEcrits == false) {
			// echo "file_put_contents() a échoué : ". "<br />";
		} 
		else {
			// echo $nbOctetsEcrits." octets ecrits.<br />";
		}
	}
?>
