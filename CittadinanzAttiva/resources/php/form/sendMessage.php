<?php 
	//RICHIEDI FILE DI CONFIGURAZIONE DELLA CONNESSIONE AL DATABASE
	include "../database/config.php";
	//CONNETTITI AL DATABASE
	$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
	//SE È STATO INVIATO UN MESSAGGIO
	if(!empty($_POST)) {
	    //PRELEVA L'INPUT ED ESEGUI L'ESCAPE PER IL DATABASE
	    $destinatario = $_POST["destinatario"];
		$messaggio = $mysqli->real_escape_string($_POST["bodyMsg"]);
		//PREPARA LA QUERY
		$sql = "INSERT INTO messaggi(Mittente, Destinatario, Testo, Letto) 
		VALUES (1, (SELECT ID FROM utente WHERE User = '$destinatario'), '$messaggio', 'No')";
		//EFFETTUA LA QUERY
		if(mysqli_query($mysqli, $sql)) {
			header("Location: ../../../user/admin/?id=msg&status=200");
			die();
		} else {
			header("Location: ../../../user/admin/?id=msg&status=500");
			die();
		}
	}
?>