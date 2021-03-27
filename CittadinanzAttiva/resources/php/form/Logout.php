<?php
  //SCRIPT DI LOGOUT
  //INIZIA LA SESSIONE
  session_start();
  //SE ESISTE EFFETIVAMENTE UNA SESSIONE ATTIVA PER L'UTENTE
  if (isset($_SESSION['userId'])) {
    //AGGIORNA CELLA LASTLOGIN
    include "../database/config.php";
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $sql = "UPDATE utente SET LastLogin = '" . $_SESSION["lastLogin"] . "' WHERE ID = " . $_SESSION["userId"];
    mysqli_query($mysqli, $sql);
    mysqli_close($mysqli);
    //DISTRUGGI LA SESSIONE
    session_destroy();
    //REINDIRIZZA L'UTENTE ALLA PAGINA INIZIALE
    header("Location: ../../../");
  }
?>