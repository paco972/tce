<?php
	$address = "10.10.13.191";
	$port = "2300";
	/* Cree une socket TCP/IP. */
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	if ($socket == false) {
	    echo "socket_create() a échoué : raison :  " . socket_strerror(socket_last_error()) . "<br />";
	} 
	else {
	    echo "Creation Socket OK.<br />";
	}

	$result = socket_connect($socket, $address, $port);
	if ($socket == false) {
	    echo "socket_connect() a échoué : raison : ($result) " . socket_strerror(socket_last_error($socket)) . "<br />";
	} 
	else {
	    echo "Connection Socket OK.<br />";
	}

	echo "Lecture de la trame : <br />";
	sleep(2);
    $trame = socket_read($socket, 180);
    echo $trame."<br />";
	
	$lgTrame = strlen($trame);
    echo "Longueur de la trame : ".$lgTrame."<br />";
    
    if ($lgTrame >= 170) {
		$pos = strpos($trame,"ADCO");
		if ($pos !== false) {
			$ADCO = substr($trame, $pos+5, 12);
		}
		else {
			$ADCO = "XXX";
		}
        echo "ADCO : ".$ADCO."<br />";
    }

	socket_close($socket);
?>