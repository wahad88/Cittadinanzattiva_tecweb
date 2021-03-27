<?php   
    //FUNZIONE CHE CARICA IL REPORT SELEZIONATO
	function loadSelectedReport($id)
	{
		//RICHIEDI FILE DI CONFIGURAZIONE PER LA COMUNICAZIONE CON IL DATABASE
        include '../../resources/php/database/config.php';
        
        //CONNETTITI AL DATABASE
        $mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        
        //QUERY
        $sql = "SELECT User, IDSegnalazione, TipoSegnalazione, DataSegnalazione, Provincia, Comune, NomeStrada, Descrizione, Immagine, Risolta
                FROM utente JOIN segnalazione ON ID = IDUtente
				WHERE IDSegnalazione = ?";
		
		//PREPARA ED ESEGUI LA QUERY 
		if($stmt = $mysqli->prepare($sql)) {
		  //LEGA I PARAMETRI ALLA QUERY
	      $stmt->bind_param('s', $id);
		  //ESEGUI LA QUERY
		  $stmt->execute();
		  //PRELEVA I RISULTATI
		  $result = $stmt->get_result();
		  //PRELAVA L'OGGETTO (ARRAY)
		  $report = $result->fetch_object();
		  //CHIUDI STATEMENT
		  $stmt->close();
		}
		$desc = $report->Descrizione;
		$desc = htmlentities($desc);
		//STAMPA INFORMAZIONI SULLA SEGNALAZIONE
?>
		            <h2>Visualizza la segnalazione in dettaglio</h2>
			        <div class="displayReport">
			            <h3>Segnalazione Numero <?php echo $id; if ($report->Risolta == 1) { echo " (Risolta)"; } ?></h3>
                        <p>L&#39; identificativo della segnalazione &egrave;: <strong> <?php echo $report->IDSegnalazione ?></strong></p>
						<p>La tipologia di questa segnalazione &egrave;: <strong><?php echo $report->TipoSegnalazione ?></strong></p>
						<p>&Egrave; stata eseguita dall&#39;utente <strong><?php echo $report->User ?></strong> in data <strong>
						<?php echo $report->DataSegnalazione ?></strong></p>
						<p>Questa segnalazione &egrave; è stata effettuata per la strada <strong><? echo $report->NomeStrada; ?></strong>,
						nel comune di <strong><?php echo $report->Comune ?></strong>, situato nella provincia di <strong> 
						<?php echo $report->Provincia ?></strong></p>
						<p>La descrizione della segnalazione &egrave; la seguente: </p>
						<p id="reportDesc"><?php echo $desc ?></p>
<?php
		if($report->Immagine == "NULL") { ?>
			            <p>Per questa segnalazione non &egrave; disponibile nessuna immagine.</p>
<?php   } else { ?>
			            <p>Per questa segnalazione &egrave; stata resa disponibile la seguente foto:</p>
				        <img src="../../resources/img/uploads/<? echo $report->Immagine; ?>" id="uploadedFile" alt="Fotografia del problema" />
<?php	} ?>
				        <a href="../reportList/" id="backButton" title="Torna all&#39;elenco delle segnalazioni" tabindex="5">Indietro</a>
				        <button type="button" id="printButton" title="Stampa segnalazione" tabindex="6">Stampa</button>
				    </div>
<?php
    }
?>
<?php //STAMPA I LINK ALLE PAGINE DELLE RIGHE DELLA TABELLE DEI REPORT
function loadPageNumber($page) {
  //PREPARO LA CONNESSIONE AL DB
  include '../../resources/php/database/config.php';
  //CONNETTITI AL DATABASE
  $mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
  //TROVA IL NUMERO DI PAGINE DA CREARE
  $sql = "SELECT COUNT(IDSegnalazione) AS Tot FROM segnalazione;";
  $result = mysqli_query($mysqli, $sql);
  $row = $result->fetch_assoc();
  //NUMERO TOTALE DI PAGINE
  $totalPages = ceil($row["Tot"] / 8);
  //ULTIMA PAGINA
  $lastPages = $totalPages - 1;
  //CHIUDI LA CONNESSIONE
  mysqli_close($mysqli);
  //TABINDEX
  $count = 9;
  //SE CI SONO MENO DI 5 PAGINE RENDI IL TUTTO PIU' SEMPLICE
  if ($totalPages > 1 && $totalPages <= 4) {
    for ($i = 1; $i < $totalPages + 1; $i += 1) {
      if ($i == $page) {
        echo "<span class=\"activePage\" tabindex=\"8\">$i</span>";
      } else {
        $count += 1;
        echo "<a href=\"?page=$i\" title=\"Vai alla pagina $i\" tabindex=\"$count\">$i</a>";
      }
    }
  }
  //ALTRIMENTI CREA UNA SELEZIONE DI PAGINE PIU' DINAMICA
  if ($totalPages > 4) {
    //PAGINA 1
    if ($page == 1) {
      //PAGINA ATTUALE (1)
      echo "<span class=\"activePage\">$page</span>
                  ";
      for ($i = 2; $i <= 5; $i += 1) {
        //STAMPA LE PRIME 4 PAGINE SUCCESSIVE
        $count += 1;
        echo "          <a href=\"?page=$i\" title=\"Vai alla pagina $i\" tabindex=\"$count\">$i</a>
                  ";
      }
      //FRECCETTA DI NAVIGAZIONE PAGINA SUCCESSIVA
      echo "          <a href=\"?page=" . ($page + 1) . "\" title=\"Vai alla pagina successiva\" tabindex=\"14\">&rsaquo;</a>
";
    }
    //PAGINA 2
    if($page == 2) {
      $count = 11;
      //FRECCETTA PER TORNARE ALLA PAGINA PRECEDENTE
      echo "<a href=\"?page=" . ($page - 1) . "\" title=\"Torna alla pagina precedente\" tabindex=\"10\">&lsaquo;</a>
                  ";
      //PAGINA INIZIALE
      echo "          <a href=\"?page=1\" title=\"Vai alla pagina 1\" tabindex=\"11\">1</a>
                  ";
      //PAGINA ATTUALE (2)
      echo "          <span class=\"activePage\">$page</span>
                      ";
      //STAMPA LE 3 PAGINE SUCCESSIVE
      for ($i = 3; $i < 6; $i += 1) {
        $count += 1;
        echo "      <a href=\"?page=$i\" title=\"Vai alla pagina $i\" tabindex=\"$count\">$i</a>
                      ";
      }
      //FRECCETTA DI NAVIGAZIONE PAGINA SUCCESSIVA
      $count += 1;
      echo "      <a href=\"?page=" . ($page + 1) . "\" title=\"Vai alla pagina successiva\" tabindex=\"$count\">&rsaquo;</a>
";
    }
    //DA PAGINA 3 A PAGINA - 2
    if ($page >= 3 && $page < $lastPages) {
      $index = $page;
      $count = 10;
      //FRECCETTA PER TORNARE ALLA PAGINA PRECEDENTE
      echo "<a href=\"?page=" . ($page - 1) . "\" title=\"Torna alla pagina precedente\" tabindex=\"10\">&lsaquo;</a>
                    ";
      for ($i = -2; $i < 3; $i +=1) {
        //PAGINA ATTIVA
        if (($index + $i) == $page) {
          echo "        <span class=\"activePage\">$page</span>
                    ";
        } else {
          $count += 1;
          //STAMPA LE DUE PAGINE PRECEDENTI E LE DUE SUCCESSIVE
          echo "        <a href=\"?page=" . ($index + $i) . "\" title=\"Vai alla pagina " . ($index + $i) . "\" tabindex=\"$count\">" . ($index + $i) . "</a>
                    ";
        }
      }
      echo "        <a href=\"?page=" . ($page + 1) . "\" title=\"Vai alla pagina successiva\" tabindex=\"15\">&rsaquo;</a>
";
    }
    //PENULTIMA PAGINA
    if ($page == $lastPages) {
      $count = 10;
      $index = $page;
      //TORNA ALLA PAGINA PRECEDENTE
      echo "<a href=\"?page=" . ($page - 1) . "\" title=\"Torna alla pagina precedente\" tabindex=\"11\">&lsaquo;</a>
                    ";
      for ($i = -3; $i <= 0; $i +=1) {
        if (($index + $i) == $page) {
          //PAGINA ATTIVA
          echo "        <span class=\"activePage\">$page</span>
                            ";
        } else {
          $count += 1;
          //STAMPA LE TRE PAGINE PRECEDENTI
          echo "        <a href=\"?page=" . ($index + $i) . "\" title=\"Vai alla pagina " . ($index + $i) . "\" tabindex=\"$count\">" . ($index + $i) . "</a>
                    ";
        }
      }
      //STAMPA IL LINK ALL'ULTIMA PAGINA
      echo "<a href=\"?page=$totalPages\" title=\"Vai alla pagina $totalPages\" tabindex=\"14\">$totalPages</a>
                    ";
      //FRECCETTA DI NAVIGAZIONE
      echo "        <a href=\"?page=" . ($page + 1) . "\" title=\"Vai alla pagina successiva\" tabindex=\"15\">&rsaquo;</a>
";
    }
    //ULTIMA PAGINA
    if ($page == $totalPages) {
      $index = $page;
      $count = 10;
      //FRECCETTA DI NAVIGAZIONE
      echo "<a href=\"?page=" . ($page - 1) . "\" title=\"Torna alla pagina precedente\" tabindex=\"10\">&lsaquo;</a>
                        ";
      for ($i = -4; $i <= 0; $i +=1) {
        if (($index + $i) == $page) {
          //PAGINA ATTIVA
          echo "    <span class=\"activePage\">$page</span>
";
        } else {
          $count += 1;
          //STAMPA LE QUATTRO PAGINE PRECEDENTI
          echo "    <a href=\"?page=" . ($index + $i) . "\" title=\"Vai alla pagina " . ($index + $i) . "\" tabindex=\"$count\">" . ($index + $i) . "</a>
                        ";
        }
      }
    }
  }
}
?>