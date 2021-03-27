<?php 
  //INCLUDI IL FILE CON I DATI PER LA CONNESSIONE AL DB
  include "../database/config.php";
  include "../script/editDocument.php";
  //SE LA RICHIESTA E' STATA INVIATA
  if (!empty($_POST)) {
    //CONNETTITI AL DB
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    //PRELEVA DALLA POST IL VALORE ED ESEGUI IL CONTROLLO DELL'INPUT
    $nome = test_input($_POST["nome"]);
    $cognome = test_input($_POST["cognome"]);
    $email = test_input($_POST["email"]);
    $textarea = test_input($_POST ["textarea"]);
    //ESEGUI L'ESCAPE PER IL DATABASE
    $nome = $mysqli->real_escape_string($nome);
    $cognome = $mysqli->real_escape_string($cognome);
    $email = $mysqli->real_escape_string($email);
    $textarea = $mysqli->real_escape_string($textarea);
    $letta = 'No';
    $sql = "INSERT INTO richieste(Nome, Cognome, Email, Richiesta, RichiestaLetta) VALUES ('$nome', '$cognome', '$email', '$textarea', '$letta')";
    //VERIFICA SE LA QUERY E' STATA ESEGUITA CORRETTAMENTE
    if (mysqli_query($mysqli, $sql)) {
      header("Location: ../../../contatti/?status=200");
      die();
    } else {
      header("Location: ../../../contatti/?status=500");
      die();
    }
    //CHIUDI CONNESSIONE
    mysqli_close($mysqli);
  } else {
    header("Location: ../../../contatti/?status=500");
    die();
  }
?>