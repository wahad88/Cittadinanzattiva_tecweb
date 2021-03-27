<?php
  session_start();
  if (empty($_SESSION["userId"])) {
    header("Location: ../../");
    die("Ti stiamo reindirizzano verso la pagina principale");
  }
?>
<!--GUIDA PER SEGNALARE-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
	<head>
		<meta charset="UTF-8" />
		<meta name="description" content="Guida sulla creazione di una segnalazione" />
		<title>Come creare una segnalazione</title>
		<meta name="keywords" content="comuni, cittadini, attiva, guida, how to, cittadinanzattiva, funzioni
		cittadinanzattiva.city, portale web, segnalazioni" />
		<meta name="author" content="Elia Vettoretto, Abdelwahad Kandoul, Luigi Perin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="../../resources/stylesheet/core.css" rel="stylesheet" type="text/css"  media="screen" />
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
				        <a href="../../resources/php/form/Logout.php">LOGOUT</a>
				    </li>
				    <?php
				      }
				    ?>
				</ul>
				<div id="nav_cover" class="nav_cover"></div>
	            <p id="breadcrumb" class="breadcrumb">Home &rsaquo; Servizi &rsaquo; <strong>Come creare una segnalazione</strong></p>
			    <div id="userNav" class="userNav">
<?
  if(isset($_SESSION["userId"])) {
?>
                    <a href="../../user/"><? echo $_SESSION["userName"]; ?></a>
<?php
  }
?>
                </div>
            </div>
            <div class="wrapper">
				<div class="general">
					<div class="howto">
						<h2>Guida alla creazione della prima segnalazione</h2>
						<h3>Se &egrave; la tua prima segnalazione ti consigliamo di seguire questa breve video guida. 
						<br />
						Altrimenti segui i passi riportati sottostante il video</h3>
						<video controls="controls" autoplay="autoplay" muted="muted">
							<source src="../../resources/img/video/how-to-start.mp4" type="video/mp4" />
							<source src="../../resources/img/video/how-to-start.webm" type="video/webm" />
							Il tuo browser non supporta il tag video
						</video>
						<ul>
							<li>
								<p>Per effettuare la tua prima segnalazione, clicca sul pulsante 
								&ldquo;Crea Segnalazione&rdquo;</p>
							</li>
							<li>
								<p>Dopo aver cliccato sul pulsante verrai reindirizzato in una nuova pagina.</p>
							</li>
							<li>
								<p>Nella pagina appena aperta ti verr&agrave; richiesto di scegliere 
								il tipo di segnalazione che vuoi effettuare.</p>
							</li>
							<li>
								<p>Clicca sul riquadro a tendina e apparir&agrave;
								un elenco tra cui scegliere la tipologia di segnalazione</p>
							</li>
							<li>
								<p>Per scegliere la tipologia pi&ugrave; adatta secondo te a 
								rappresentare il problema puoi usare il mouse e cliccare sulla scelta, 
								altrimenti puoi usare le frecce per navigare e usa il tasto 
								&ldquo;Invio&rdquo; per selezionare il campo.</p>
							</li>
							<li>
								<p>Se nessuna delle tipologie di scelta rientra nella categoria 
								che vuoi segnalare scegli il campo &ldquo;Altro&rdquo;</p>
							</li>
							<li>
								<p>Clicca sul tasto &ldquo;Avanti&rdquo; per procedere</p>
							</li>
							<li>
								<p>Cos&igrave; hai completato il primo passo</p>
							</li>
							<li>
								<p>Nel secondo passo ti sar&agrave; richiesto di 
								inserire la Provincia, il Comune e il Nome della strada da segnalare.</p>
							</li>
							<li>
								<p>Una volta compilati i campi clicca su &ldquo;Avanti&rdquo;</p>
							</li>
							<li>
								<p>Perfetto! Sei arrivato quasi alla fine!</p>
							</li>
							<li>
								<p>Ora basta che tu descriva il problema da segnalare, 
								basta anche una piccola descrizione, del tipo &ldquo;
								Ci sono dei graffiti che degradano l&#39;area circostante Piazza Marconi&rdquo;</p>
							</li>
							<li>
								<p>Clicca un&#39;ultima volta su avanti</p>
							</li>
							<li>
								<p>Ora verr&agrave; visualizzato un riepilogo dei dati che hai immesso; 
								se hai commesso qualche errore puoi tornare indietro e modificare i dati</p>
							</li>
							<li>
								<p>Se ti sembra tutto corretto clicca sul tasto &ldquo;Invia&rdquo;</p>
							</li>
							<li>
								<p>Complimenti! Hai appena inviato la tua prima segnalazione!</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer">
				<div class="utility">
					<a href="../../sitemap/" title="Vai alla mappa del sito">Mappa del sito</a>
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