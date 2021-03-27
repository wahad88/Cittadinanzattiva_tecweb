<?php
  if (!empty($_POST)) {
    //CONNETTITI AL DATABASE
    include("../database/config.php");
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $id = $_POST["formType"];
    $report = $_POST["report"];
    if ($id == "delete") {
      $sql = "DELETE FROM segnalazione WHERE IDSegnalazione = '$report'";
      if (mysqli_query($mysqli, $sql)) {
        header ("Location: ../../../user/admin/?id=deleteReport&status=200");
        die();
      } else {
        header ("Location: ../../../user/admin/?id=deleteReport&status=500");
        die();
      }
    } else {
      $sql = "UPDATE segnalazione SET Risolta = 1 WHERE IDSegnalazione = '$report'";
      if (mysqli_query($mysqli, $sql)) {
        header ("Location: ../../../user/admin/?id=editReport&status=200");
        die();
      } else {
        header ("Location: ../../../user/admin/?id=editReport&status=500");
        die();
      }
    }
  } else {
    header ("Location: ../../../");
    die();
  }
?>