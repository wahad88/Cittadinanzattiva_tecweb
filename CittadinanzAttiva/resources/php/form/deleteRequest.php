<?php
  //RIMUOVI RICHIESTA
  if (isset($_GET["feedback"])) {
    $feedback = $_GET["feedback"];
    //RICHIEDO IL FILE PER LA CONFIGURAZIONE DI ACCESSO AL DATABASE
    include('../database/config.php');
    //CONNETTITI AL DATABASE
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $sql = "DELETE FROM richieste WHERE IDRichiesta = $feedback";
    if(mysqli_query($mysqli, $sql)) {
      header("Location: ../../../user/admin/?id=request&status=200");
      die();
    } else {
      header("Location: ../../../user/admin/?id=request&status=500");
      die();
    }
  }
?>