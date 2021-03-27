<?php
  /*QUESTO SCRIPT ESEGUE DUE DIVERSE FUNZIONI: CONTROLLA SE NELLA FORM 
  DI REGISTRAZIONE IL NOME UTENTE INSERITO E' GIA' PRESENTE NEL DATABASE 
  E CONTROLLA SE LA PROVINCIA E IL COMUNE INSERITI NELLA FORM DI SEGNALAZIONE 
  SIANO CORRETTI*/
  //RICHIEDI IL FILE DI CONFIGURAZIONE PER LA CONNESSIONE AL DATABASE 
  include "../database/config.php"; 
  include "editDocument.php";
  //PRELEVA I PARAMETRI DI RICERCA  
  //QUERY = PARAMETRO EFFETTIVO DELLA RICERCA
  $query = $_GET["query"];
  //QUERID = PARAMETRO ACCESSORIO CHE SERVE PER DETERMINARE LA QUERY SQL DA EFFETTUARE
  $queryId = $_GET["queryId"];
  //CONNETTITIAL DATABASE
  $mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);  
  //CONTROLLA SE LA STRINGA "QUERY" SIA DEFINITA
  if (strlen($query) > 0) {
    //SELEZIONA IL CASO
    switch ($queryId) {
      //CASO USER, CONTROLLA IL NOME UTENTE
      case "user":
        //PREPARA LA QUERY
        $sql = "SELECT User FROM utente WHERE User = '$query'";
        break;
      case "email":
        $sql = "SELECT Email FROM contatti JOIN utente ON contatti.ID = utente.ID WHERE utente.User = '$query'";
        break;
      //CARICA DOCUMENTO XML
      case "prov":
        $xml = loadDocument("prov");
        break;
      case "paese":
        $provincia = $_GET["prov"];
		$xmlP = loadDocument("prov");
        $xmlC = loadDocument("paese");
        break;
    }
  }    
  //CONTROLLA I CASI
  switch ($queryId) {
    //CERCA SE IL NOME UTENTE E' DISPONIBILE
    case "user":
      //EFFETTUA LA QUERY
      $result = mysqli_query($mysqli, $sql);      
      //SE LA QUERY HA PRODOTTO UN RISULTATO
      if (mysqli_num_rows($result) > 0) {	
        //PRELEVA IL RISULTATO
        while ($row = mysqli_fetch_array($result)) {
          //CONTROLLA SE IL NOME UTENTE E' DISPONIBILE
          echo "false";
        }
      } else {
          echo "true";
      }
      break;
    //CONTROLLA SE LA MAIL INSERITA CORRISPONDE CON QUELLA DEL DATABASE
    case "email":
      //EFFETTUA LA QUERY
      $result = mysqli_query($mysqli, $sql);
      //SE LA QUERY HA PRODOTTO UN RISULTATO
      if (mysqli_num_rows($result) > 0) {
        //RITORNA LA MAIL
        $row = mysqli_fetch_array($result);
        echo $row["Email"];
      }
      break;
    //CASO PROVINCIA - CERCA LE PROVINCIE CORRISPONDENTI
    case "prov":
      //CERCA TRA TUTTE LE PROVINCIE QUELLE CHE CORRISPONDONO ALLA QUERY
      $root = $xml->documentElement;
	  $prov = $root->getElementsByTagName("prov");
	  $n_ele = $prov->length;
	  $i = 0;
      //STAMPA IN UNA LISTA LE PROVINCIE CHE HANNO UN MATCH CON LA QUERY
      for ($i; $i < $n_ele; $i += 1) {
        if (stristr($prov[$i]->nodeValue, $query)) {
          echo "<p onclick=\"setInput('". $prov[$i]->nodeValue . "', 'prov')\">" . $prov[$i]->nodeValue . "</p>
		       ";
        }
      }
      break;
   //CASO COMUNE - CERCA I COMUNI CORRISPONDENTI
   case "paese":
     //TROVA L'ID DELLA PROVINCIA NEL FILE provincie.xml
     $rootP = $xmlP->documentElement;
	 $prov = $rootP->getElementsByTagName("prov");
	 $n_ele = $prov->length;
	 $i = 0;
     for ($i; $i < $n_ele; $i += 1) {
       if ($prov[$i]->nodeValue == $provincia) {
         $provId = $prov[$i]->getAttribute("id");
		 break;
       }
     }
     //UNA VOLTA TROVATO L'ID DELLA PROVINCIA
     //CERCA L'ID CORRISPONDENTE NEL FILE comuni.xml
     $rootC = $xmlC->documentElement;
     $prov = $rootC->getElementsByTagName("prov");
     $n_ele = $prov->length;
     for ($i = 0; $i < $n_ele; $i += 1) {
      if ($prov[$i]->getAttribute("id") == $provId) {
         $paese = $prov[$i];
         break;
       }
     }
	 //UNA VOLTA TROVATA LA PROVINCIA CERCA TUTTI I COMUNI CHE CORRISPONDONO ALLA QUERY
	 $comune = $paese->childNodes;
	 $n_ele = $comune->length;
	 for ($i = 0; $i < $n_ele; $i += 1) {
     //STAMPA LA LISTA CON I COMUNI CHE MATCHANO CON LA QUERY
       if (stristr($comune[$i]->nodeValue, $query)) {
         echo "<p onclick=\"setInput('". $comune[$i]->nodeValue . "', 'paese')\">" . $comune[$i]->nodeValue . "</p>
		       ";
       }
     }
     break;
  }
  //CHIUDI LA CONNESSIONE
  $mysqli->close();
?>