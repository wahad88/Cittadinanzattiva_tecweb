<?php
  //STAMPA LA DATA E L'ORA DELL'ULTIMA VOLTA CHE L'UTENTE SI E' CONNESSO
  function lastLogin() {
    include "resources/php/database/config.php";
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $data = array(
      "lastData" => 0,
      "lastOra" => 0,
    );
    //PREPARA LA QUERY
    $sql = "SELECT LastLogin FROM utente WHERE ID = " . $_SESSION["userId"];
    //EFFETTUA LA QUERY
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_row($result);
    //CHIUDI LA CONNESSIONE
    //PRELEVA LA DATA E L'ORA
    $data["lastData"] = substr($row[0], 0, 10);
    $data["lastOra"] = substr($row[0], 11);
    //CHIUDI CONNESSIONE
    mysqli_close($mysqli);
    //RITORNA ARRAY
    return $data;
  }
  //CALCOLA QUANTO TEMPO E' PASSATO
  function interval($data, $ora) {
    //VECCHIA DATA
    $oldDate = $data . " " . $ora;
    //DATA CORRENTE
    date_default_timezone_set("Europe/Rome");
    $currentDate = date("Y-m-d") . " " .date("H:i:s", time());
    //CREA UN OGGETTO DI TIPO DATA
    $oldDate = new DateTime($oldDate);
    $currentDate = new DateTime($currentDate);
    //CALCOLA LA DIFFERENZA
    $interval = date_diff($oldDate, $currentDate);
    //CONTROLLA SE CI SONO ZERI, MOSTRA SOLO I DATI NON VUOTI
    if ($interval->y != 0) {
      echo $interval->y . " anni, ";
    }
    if ($interval->m != 0) {
      echo $interval->m . " mesi, ";
    }
    if ($interval->d != 0) {
      echo $interval->d . " giorni, ";
    }
    if ($interval->h != 0) {
      echo $interval->h . " ore, ";
    }
    if ($interval->i != 0) {
      echo $interval->i . " minuti ";
    }
    if ($interval-> s != 0) {
      echo " e " . $interval->s . " secondi!";
    }
  }
?>