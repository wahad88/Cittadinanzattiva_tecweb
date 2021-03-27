<?php
  //SCRIPT DI LOGIN
  //INIZIO LA SESSIONE
  session_start();
  //CONTROLLA SE L'UTENTE HA GIA' EFFETTUATO L'ACCESSO
  if (isset($_SESSION["userId"])) {
    header("Location: ../../../");
    die("Ti stiamo reindirizzando alla pagina iniziale");
  } else {
    //RICHIEDO IL FILE PER LA CONFIGURAZIONE DI ACCESSO AL DATABASE
    include('../database/config.php');
    //CONNETTITI AL DATABASE
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    //CREA LA QUERY
    $sql = "SELECT * FROM utente WHERE User = ?";
    //SE E' STATA EFFETTUATA UNA RICHIESTA DI LOGIN
    if (!empty($_POST)) {
      //CONTROLLA CHE EFFETTIVAMENTE SIANO STATE INVIATE LE CREDENZIALI
      if (isset($_POST['username']) && isset($_POST['password'])) {
        //CONTROLLO PER CODICE NOCIVO
        $username = $mysqli->real_escape_string($_POST['username']);
        $password = $mysqli->real_escape_string($_POST['password']);
        //PREPARA LA QUERY PER RECUPERARELO USERNAME DAL DB
        if ($stmt = $mysqli->prepare($sql)) {
          //LEGA I PARAMETRI ALLA QUERY
          $stmt->bind_param('s', $username);
          //ESEGUI LA QUERY
          $stmt->execute();
          //PRELEVA I RISULTATI
          $result = $stmt->get_result();
          //PRELAVA L'OGGETTO (ARRAY)
          $user = $result->fetch_object();
          //CHIUDI STATEMENT
          $stmt->close();
          //CONTROLLA SE LO USERNAME INSERITO CORRISPONDE A QUELLO REGISTRATO
          if ($username === $user->User) {
            //SE LO USERNAME CORRISPONDE CONTROLLA LA PASSWORD
            if(password_verify($password, $user->Password)) {
              //CREA LE INFORMAZIONI DI SESSIONE
              date_default_timezone_set("Europe/Rome");
              $_SESSION["lastLogin"] = date("Y-m-d") . " " .date("H:i:s", time());
              $_SESSION["userId"] = $user->ID;
              $_SESSION["userName"] = $user->User;
              $_SESSION["userLevel"] = $user->Status;
              mysqli_close($mysqli);
              //REINDIRIZZA L'UTENTE ALLA PAGINA INIZIALE
              header("Location: ../../../");
            } else { 
              //ALTRIMENTI SE LA PASSWORD NON CORRISPONDE TORNA ALLA
              //PAGINA INIZIALE CON LOGINSTATUS = 404 (FALLIMENTO)
              header("Location: ../../../login/?status=404");
              die();
            }
            //SE LO USERNAME NON CORRISPONDE TORNA ALLA PAGINA INIZIALE
            //CON LOGINSTATUS = 404 (FALLIMENTO)
          } else {
            header("Location: ../../../login/?status=404");
            die();
	  	  }
	    }
      }
    }
  }
?>