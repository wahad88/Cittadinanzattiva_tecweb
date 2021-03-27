<?php
  //INIZIO LA SESSIONE
  session_start();
  $userId = $_SESSION["userId"];
  $userName = $_SESSION["userName"];
  //RICHIEDO IL FILE PER LA CONFIGURAZIONE DI ACCESSO AL DATABASE
  include('../database/config.php');
  //CONNETTITI AL DATABASE
  $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
  //CAMBIA USERNAME
  if (isset($_POST["oldUser"]) && isset($_POST["newUser"])) {
    //PRENDI IL NOME UTENTE
    $oldUser = $_POST["oldUser"];
    $newUser = $_POST["newUser"];
    //PREPARA LA QUERY
    $sql = "UPDATE utente SET User = '$newUser' WHERE ID = $userId AND User = '$oldUser'";
    if (mysqli_query($mysqli, $sql)) {
      //AGGIORNA LA SESSIONE
      $_SESSION["userName"] = $newUser;
      //REDIRECT
      header("Location: ../../../user/?id=user&status=200");
      die();
    } else {
      header("Location: ../../../user/?id=user&status=500");  
      die();
    }
  }
  //CAMBIA PWD
  if (isset($_POST["oldPassword"]) && isset($_POST["newPassword"])) {
    //PRENDI LE PASSWORD
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];
    //PRELEVA LA VECCHIA PASSWORD DAL DB
    $sql = "SELECT Password FROM utente WHERE ID = $userId";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($result);
    //CONTROLLA SE L'UTENTE HA IMMESSO VERAMENTE UNA NUOVA PASSWORD
    if ($oldPassword !== $newPassword) {
      //SE LA PWD IMMESSA CORRISPONDE CON QUELLA NEL DB
      if (password_verify($oldPassword, $row["Password"])) {
        //ALLORA ESEGUI LA MODIFICA
        $pwd = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE utente SET Password = '$pwd' WHERE ID = $userId";
        if(mysqli_query($mysqli, $sql)) {
          header("Location: ../../../user/?id=pwd&status=200");
          die();
        } else {
          header("Location: ../../../user/?id=pwd&status=500");
          die();
        }
      } else {
        //ALTRIMENTI RITORNA ERRORE
        header("Location: ../../../user/?id=pwd&status=404");
        die();
      }
    } else {
      header("Location: ../../../user/?id=pwd?status=403");
      die();
    }
  }
  //CAMBIA MAIL
  if (isset($_POST["oldEmail"]) && isset($_POST["newEmail"])) {
    $email = $_POST["newEmail"];
    $sql = "UPDATE contatti SET Email = '$email' WHERE ID = $userId;";
    if(mysqli_query($mysqli, $sql)) {
      header("Location: ../../../user/?id=email&status=200");
      die();
    } else {
      header("Location: ../../../user/?id=email&status=500");
      die();
    }
  }
?>