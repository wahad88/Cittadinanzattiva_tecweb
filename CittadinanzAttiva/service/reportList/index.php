<?php
    //INIZIA LA SESSIONE
    session_start();
    //SE NON C'E' NESSUNA SESSIONE ATTIVA REINDIRIZZA VERSO LA PAGINA DI LOGIN
    if (empty($_SESSION["userId"])) {
      header("Location: ../../");
      die("Ti stiamo reinderizzando verso la pagina di login");
    } else { 
      include "../../resources/php/script/viewReportScript.php";
      //PRELEVA IL NUMERO DI PAGINA
      if (isset($_GET["page"])) {
        $page  = $_GET["page"]; 
      } else { 
        $page = 1; 
      }
      //PREPARO LA CONNESSIONE AL DB
      include '../../resources/php/database/config.php';
      //CONNETTITI AL DATABASE
      $mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
      //INDICA ALLA QUERY DA QUALE RIGA PARTIRE
      $startRow = ($page - 1) * 8;
      //QUERY
      $sql = "SELECT IDSegnalazione, TipoSegnalazione, DataSegnalazione, Comune, Risolta
      FROM utente JOIN segnalazione ON ID = IDUtente ORDER BY DataSegnalazione DESC LIMIT $startRow, 8";
      //EFFETTUA LA QUERY
      $result = mysqli_query($mysqli, $sql);
      //STAMPA I RISULTATI (SE CE NE SONO
      $rowCount = mysqli_num_rows($result);
      //TIENI CONTO DEL TABINDEX
      $tabCount = 16;
      //CHIUDI LA CONNESSIONE AL SERVER
      mysqli_close($mysqli);
    }
?>
<!--ELENCO DELLE SEGNALAZIONI-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
    <head>
        <title>Elenco delle segnalazioni</title>
		<meta charset="utf-8" />
		<meta name="description" content="Visualizza tutte le segnalazioni presenti" />
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
				        <a href="../../resources/php/form/Logout.php" tabindex="5">LOGOUT</a>
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
	                <a href="../../user/" title="Vai alla tua pagina" tabindex="6"><?php echo $_SESSION['userName']; ?></a>
<?php
  }
?>
                </div>
            </div>
            <div class="wrapper">
				<div class="general">
					<div class="viewReport"> 
						<h2>Elenco delle segnalazioni</h2>
						<h3>Clicca su una riga della tabella per vedere la segnalazione in dettaglio</h3>
						<form id="searchForm" action="../search/" method="get">
						    <div class="searchDiv">
							    <label id="searchLable" for="searchTable">Cerca velocemente una segnalazione</label>
							    <input tabindex="7" name="query" id="searchTable" type="text" placeholder="Cerca..." />
							    <p id="errorSearch" class="errorField"></p>
							    <fieldset>
							        <legend>Seleziona il tipo di campo da ricercare</legend>
							        <input name="filter" id="paese" type="radio"  checked="checked" value="Comune" tabindex="8" />
							        <label for="paese">Comune</label>
							        <input name="filter" id="idReport" type="radio" value="IDSegnalazione" />
							        <label for="idReport">ID</label>
						    	    <input name="filter" id="reportType" type="radio" value="TipoSegnalazione"  />
							        <label for="reportType">Tipo Segnalazione</label>
							        <input name="filter" id="date" type="radio" value="DataSegnalazione" />
							        <label for="date">Data</label>
							    </fieldset>
							    <button type="submit" id="searchButton" tabindex="9">Cerca!</button>
						    </div>
						</form>
						<div id="pageNumber" class="pageNumber">
                            <?php loadPageNumber($page); ?>
                        </div>
						<table title="Tabella delle segnalazioni" id="reportTable">
							<caption>In questa tabella sono riportate tutte le segnalazioni effettuate</caption>
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
  //SE CI SONO RIGHE
  if ($rowCount > 0) {
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
    }
?>
                            </tbody>
                            <tfoot>
								<tr>
									<th>Comune</th>
									<th>Id Segnalazione</th>
									<th>Tipo Segnalazione</th>
									<th class="reportDate">Data Segnalazione</th>
									<th class="risolta">Risolta</th>
								</tr>
                            </tfoot>
						</table>
						<script src="../../resources/js/viewReport.js" type="text/javascript"></script>
					</div>
				</div>
			</div>
            <div class="footer">
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