<?php 
  session_start();
  //SE E' ATTIVA UNA SESSIONE
  if(isset($_SESSION["userId"]) && isset($_GET["messageId"])) {
    $id = $_GET["messageId"];
  } else {
    header("Location: ../../");
    die("Ti stiamo reinderizzando alla pagina");
  }
?>
<!--VISUALIZZA MESSAGGIO-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
    <head>
        <title>Visualizza Messaggio</title>
		<meta charset="UTF-8" />
		<meta name="description" content="Visualliza il messaggio completo." />
		<meta name="keywords" content="comuni, cittadini, attiva, segnala, report, segnalazione, cittadinazattiva" />
		<meta name="author" content="Elia Vettoretto, Abdelwahad Kandoul, Luigi Perin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="../../resources/stylesheet/core.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../../resources/stylesheet/user.css" rel="stylesheet" type="text/css" media="screen" />
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
				        <a href="../../service/" title="Vai alla pagina dei servizi" tabindex="2">SERVIZI</a>
				    </li>
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
				<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Opzioni Utente &rsaquo; <strong>Visualizza messaggio</strong></p>
				<div id="userNav" class="userNav">
<?php
  if (isset($_SESSION["userId"])) {
?>
				   <span><?php echo $_SESSION["userName"]; ?></span>
<?php
  }
?>
	            </div>
            </div>
<?php
  include "../../resources/php/database/config.php";
  $mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
  $sql = "SELECT User, Testo FROM messaggi JOIN utente ON utente.ID = messaggi.Mittente WHERE IdMessaggio = ?";
  //ESEGUI LA QUERY 
  if($stmt = $mysqli->prepare($sql)) {
    //LEGA I PARAMETRI ALLA QUERY
    $stmt->bind_param('i', $id);
    //ESEGUI LA QUERY
    $stmt->execute();
    //PRELEVA I RISULTATI
    $result = $stmt->get_result();
    //PRELAVA L'OGGETTO (ARRAY)
    $msg = $result->fetch_object();
    //CHIUDI STATEMENT
    $stmt->close();
  }
  //MOSTRA IL MESSAGGIO
?>
          <div class="wrapper">
                 <div class="general">
                     <h2>Visualizza in dettaglio il messaggio </h2>
                     <div class="showRequest">
                         <h3 id="message-h3">Messaggio</h3>
                         <p>Questo messaggio &egrave; stato inviato da: <strong><?php echo $msg->User; ?></strong></p>
                         <p><?php echo $msg->Testo; ?></p>
                         <a href="../" id="msgBackButton" title="Torna all&#39;elenco dei messaggi" tabindex="5">Indietro</a>
                     </div>
                 </div>
            </div>
<?php
  //AGGIORNA LO STATUS DEL MESSAGGIO LETTO IN SI
  $sql = "UPDATE messaggi SET Letto = 'Si' WHERE IdMessaggio = $id";
  mysqli_query($mysqli, $sql);
  mysqli_close($mysqli);
?>
			<div id ="tweak-footer" class="footer">
				<div class="utility">
					<a href="../../sitemap/" title="Vai alla mappa del sito">Mappa del sito</a>
					<a href="../../contatti/contactRequest/" title="Lascia un feedback">Lascia un feedback</a>
					<a href="../../privacy/Termini-e-Condizioni.pdf" title="Visualizza i termini e le condizioni">Termini di Servizio</a>
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