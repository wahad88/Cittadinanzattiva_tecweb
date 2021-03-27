<?php
  session_start();
  if (empty($_SESSION["userId"])) {
    header("Location: ../../");
    die("Ti stiamo reinderizzando verso la pagina iniziale");
  }
  $radio = $_GET["filter"];
  $query = $_GET["query"];
  include "../../resources/php/database/config.php";
  $query = $_GET["query"];
  $filter = $_GET["filter"];
  //CONNETTITI AL DATABASE
  $mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
  $sql = "SELECT IDSegnalazione, TipoSegnalazione, DataSegnalazione, Comune, Risolta
  FROM utente JOIN segnalazione ON ID = IDUtente WHERE $filter LIKE '$query%' ORDER BY DataSegnalazione DESC";
  //EFFETTUA LA QUERY
  $result = mysqli_query($mysqli, $sql);
  $rowCount = mysqli_num_rows($result);
  //TIENI CONTO DEL TABINDEX
  $tabCount = 10;
  //CHIUDI LA CONNESSIONE AL SERVER
  mysqli_close($mysqli);
?>
<!--ELENCO DELLE SEGNALAZIONI-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
    <head>
        <title>Risultato della ricerca</title>
		<meta charset="utf-8" />
		<meta name="description" content="Risultato della ricerca" />
		<meta name="keywords" content="comuni, cittadini, attiva, segnala, report, segnalazione, cittadinazattiva" />
		<meta name="author" content="Elia Vettoretto, Abdelwahad Kandoul, Luigi Perin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="../../resources/stylesheet/core.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../../resources/stylesheet/service.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../../resources/stylesheet/mobile.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../../resources/stylesheet/print.css" rel="stylesheet" type="text/css" media="print" />
		<link href="../../resources/stylesheet/fonts/Exo.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../../favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href="../../favicon.ico" rel="icon" type="image/x-icon" />
		<script src="../../resources/js/generalScript.js" type="text/javascript"></script>
		<script src="../../resources/js/alertFunction.js" type="text/javascript"></script>
		<script src="../../resources/js/handleOnLoad.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="core">
		    <div id="navbar" class="nav">
                <div id="logo_div" class="logo">
                    <a href="../../" title="Torna alla pagina principale">
					    <img src="../../resources/img/icon/logo_img.png" id="logo_img" alt="Logo di CittadinanzAttiva" />
					    <h1 tabindex="1">CittadinanzAttiva.city</h1>
					</a>
				</div>
				<span class="burger-menu" id="burger-menu" onclick="showMenu()"></span>
				<ul>
				    <li>
					    <a href="../../news/" title="Vai alla pagina delle news" tabindex="3">NEWS</a>
				    </li>
				    <li>
					    <a href="../../contatti/" title="Vai alla pagina dei contatti" tabindex="4">CONTATTACI</a>
				    </li>
<?php
  if(isset($_SESSION["userId"])) {
?>
				    <li>
				        <a href="../../resources/php/form/Logout.php">LOGOUT</a>
				    </li>
<?php
  }
?>
				</ul>
				<div id="nav_cover" class="nav_cover"></div>
                <p id="breadcrumb" class="breadcrumb">Home &rsaquo; Servizi &rsaquo; <strong>Elenco delle segnalazioni</strong></p>
	            <div id="userNav" class="userNav">
<?php
  if (isset($_SESSION["userId"])) {
?>
	                <a href="../../user/"><?php echo $_SESSION['userName']; ?></a>
<?php
  }
?>
                </div>
            </div>
            <div class="wrapper">
				<div class="general">
				    <div class="viewReport">
				        <h2>Risultati della ricerca</h2>
<?php
  //SE CI SONO RIGHE
  if ($rowCount > 0) {
?>
				        <table title="Tabella delle segnalazioni" id="searchTable">
						    <caption>Qui sono riportate tutte le segnalazioni attinenti alla tua ricerca</caption>
						    <thead>
							    <tr>
								    <th id="comune">Comune</th>
							    	<th id="idSegnalazione">Id Segnalazione</th>
							    	<th id="tipoSegnalazione">Tipo Segnalazione</th>
							    	<th id="reportDate">Data Segnalazione</th>
							    	<th id="risolta">Risolta</th>
							    </tr>
						    </thead>
						    <tbody>
<?php
    //PRELEVA IL RISULTATO E STAMPA LE RIGHE DELLA TABELLA
    while ($row = mysqli_fetch_array($result)) {
      if ($row["Risolta"] == 0) {
        $risolta = "No";
      } else {
        $risolta = "Si";
      }
?>
                                <tr onclick="openReport('<?php echo $row["IDSegnalazione"]; ?>')" 
                                    onkeypress="openReportPress('<?php echo $row["IDSegnalazione"]; ?>', event)" tabindex="<?php echo $tabCount; ?>">
							    	<td headers="comune"><?php echo $row["Comune"]; ?></td>
			    					<td headers="idSegnalazione"><?php echo $row["IDSegnalazione"]; ?></td>
			    					<td headers="tipoSegnalazione"><?php echo $row["TipoSegnalazione"]; ?></td>
			    					<td headers="reportDate" class="reportDate"><?php echo $row["DataSegnalazione"]; ?></td>
			    					<td headers="risolta" class="risolta"><?php echo $risolta; ?></td>
			    				</tr>
<?php
      $tabCount += 1;
    }
?>
	    			        </tbody>
				    	</table>
<?php
  } else {
?>
                        <h3>Nessun risultato pertinente alla tua ricerca</h3>
<?php 
  }
?>
                        <a href="../reportList/" id="backButton" title="Torna indietro">Indietro</a>
                    </div>
					<script src="../../resources/js/viewReport.js" type="text/javascript"></script>
				</div>
			</div>
            <div id="tweak-footer" class="footer">
				<div class="utility">
					<a href="../../sitemap" title="Vai alla mappa del sito">Mappa del sito</a>
					<a href="../../contatti/contactRequest/" title="Lascia un feedback">Lascia un feedback</a>
					<a href="../../privacy/Termini-e-Condizioni.pdf" id="privacy" title="Visualizza i termini e le condizioni">Termini di Servizio</a>
				</div>
				<div class="footerCover">
				    <div class="social">
				        <p>Puoi trovarci anche su</p>
					    <a href="https://www.facebook.com" title="Pagina Facebook di CittadinanzAttiva">
					        <img src="../../resources/img/social/fb.png" id="facebook" alt="Seguici su Facebook!" />
					    </a>
					    <a href="https://www.instagram.com" title="Pagina Instagram di CittadinanzAttiva">
					        <img src="../../resources/img/social/ins.png" id="instagram" alt="Seguici su Instagram!" />
					    </a>
					    <a href="https://www.twitter.com" title="Pagina Twitter di CittadinanzAttiva">
					        <img src="../../resources/img/social/twit.png" id="twitter" alt="Seguici su Twitter!" />
				        </a>
				    </div>
                    <div class="zerobyte">
				    	<p>CittadinanzAttiva<br />Via paolotti, 8 - 35121 Padova - Italia<br />&copy; 2019 - 
				    	<span lang="en" xml:lang="en">ZeroHex Web Solutions, All rights reserved.</span></p>
				    </div>
				</div>
            </div>
        </div>
    </body>
</html>