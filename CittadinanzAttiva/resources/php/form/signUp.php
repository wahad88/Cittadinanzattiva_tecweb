<?php
    //SCRIPT DI REGISTRAZIONE
    //RICHIEDI IL FILE DI CONFIGURAZIONE PER LA CONNESSIONE AL DATABASE    
    include "../database/config.php";
    //RICHIEDI LO SCRIPT editDocument.php
    include "../script/editDocument.php";
    //SE LA RICHIESTA E' DI TIPO POST
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{	
	    //CONTROLLA USERNAME E PASSWORD
		$username = test_input($_POST["username"]);
		$get_password = test_input($_POST["password"]);
		
		//CONTROLLA LE INFORMAZIONI PERSONALI (NOME, COGNOME, DATA DI NASCITA E CF)
		$name = test_input($_POST["nome"]);
		$surname = test_input($_POST["cognome"]);
		$data = $_POST["bdata"];
		$cf = test_input($_POST['codiceFiscale']);
		
		//CONTROLLA LA RESIDENZA
		$indirizzo = test_input($_POST["indirizzo"]);
		$civico = $_POST["civico"];
		$paese = test_input($_POST["comune"]);
		$provincia = test_input($_POST["provincia"]);
		
		//CONTROLLA SE IL TELEFONO E' STATO IMMESSO, IN QUANTO CAMPO NON NECESSARIO
		if(isset($_POST["telefono"])) {
		    $num_tel = $_POST["telefono"]; 
		} else { //ALTRIMENTI IMPOSTA IL VALORE A NULL
		    $num_tel = NULL;
		}
		$num_cell = $_POST["cellulare"];
		$email = test_input($_POST["email"]);
	}
	
	//CONNETTITI AL DATABASE
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    //EFFETTUA L'HASH DELLA PASSWORD
	$password = password_hash($get_password, PASSWORD_DEFAULT);
	
	//PREPARA LE QUERY PER L'INSERIMENTO DEI DATI
	
	//QUERY PER IMMETTERE I DATI NELLA TABELLA UTENTE
	$tabellaUtente = "INSERT INTO utente(User, Password, Status) VALUES ('$username', '$password', 127)"; 
    
    //QUERY PER IMMETTERE I DATI NELLA TABELLA USERINFO
    $tabellaUserInfo = "INSERT INTO userinfo(ID, Nome, Cognome, DataNascita, CodiceFiscale) 
    VALUES ((SELECT ID FROM utente WHERE User = '$username'), '$name', '$surname', '$data', '$cf')";
    
    //QUERY PER IMMETTERE I DATI NELLA TABELLA RESIDENZA
    $tabellaResidenza = "INSERT INTO residenza(ID, Indirizzo, Civico, Paese, Provincia) 
    VALUES ((SELECT ID FROM utente WHERE User = '$username'), '$indirizzo', '$civico', '$paese', '$provincia')";
    
    //QUERY PER IMMETTERE I DATI NELLA TABELLA CONTATTI
    $tabellaContatti = "INSERT INTO contatti(ID, TelefonoCasa, Cellulare, Email)
    VALUES ((SELECT ID FROM utente WHERE User = '$username'), '$num_tel', '$num_cell', '$email')";
    
    //EFFETTUA LE QUERY
    //UTENTE
    mysqli_query($mysqli, $tabellaUtente);
    //USERINFO
    mysqli_query($mysqli, $tabellaUserInfo);
    //RESIDENZA
    mysqli_query($mysqli, $tabellaResidenza);
    //CONTATTI
    mysqli_query($mysqli, $tabellaContatti);
    
	//MESSAGGIO DI BENVENUTO
	$welcome = "Benvenuto nella comunità di CittadinanzAttiva! Se hai qualche domanda riguardo al sito non esitare a chiedere!";
	$sql = "INSERT INTO messaggi(Mittente, Destinatario, Testo, Letto) VALUES (1, (SELECT ID FROM utente WHERE User = '$username'), '$welcome', 'No')";
	mysqli_query($mysqli, $sql);
    
    //CHIUDI CONNESSIONE AL DATABASE
    mysqli_close($mysqli);
    
    //REINDIRIZZA L'UTENTE ALLA PAGINA DI BENVENUTO
    header("Location: ../../../signin/welcome/");
    die();
?>