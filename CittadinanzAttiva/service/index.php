<?php
  session_start();
?>
<!--SERVIZI-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
    <head>
        <title>Servizi</title>
		<meta charset="UTF-8" />
		<meta name="description" content="In questa pagina, previa registrazione al sito, &egrave; possibile compilare una 
		nuova segnalazione, oppure visualizzare quelle attualmente attive." />
		<meta name="keywords" content="comuni, cittadini, attiva, segnala, report, segnalazione, cittadinazattiva" />
		<meta name="author" content="Elia Vettoretto, Abdelwahad Kandoul, Luigi Perin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="../resources/stylesheet/core.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../resources/stylesheet/service.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../resources/stylesheet/mobile.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../resources/stylesheet/print.css" rel="stylesheet" type="text/css" media="print" />
		<link href="../resources/stylesheet/fonts/Exo.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href="../favicon.ico" rel="icon" type="image/x-icon" />
		<script src="../resources/js/generalScript.js" type="text/javascript"></script>
		<script src="../resources/js/alertFunction.js" type="text/javascript"></script>
		<script src="../resources/js/handleOnLoad.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="core">
			<div id="navbar" class="nav">
                <div id="logo_div" class="logo">
                    <a href="../" title="Torna alla pagina principale">
					    <img src="../resources/img/icon/logo_img.png" id="logo_img" alt="Logo di CittadinanzAttiva" />
					    <h1 tabindex="1">CittadinanzAttiva.city</h1>
					</a>
				</div>
				<span class="burger-menu" id="burger-menu" onclick="showMenu()"></span>
				<ul>
					<li>
						<a href="../news/" title="Vai alla pagina delle news" tabindex="3">NEWS</a>
					</li>
					<li>
						<a href="../contatti/" title="Vai alla pagina dei contatti" tabindex="4">CONTATTACI</a>
					</li>
<?php
  if(isset($_SESSION["userId"])) {
?>
     			    <li>
				        <a href="../resources/php/form/Logout.php" tabindex="5">LOGOUT</a>
				    </li>
<?php
  }
?>
				</ul>
				<div id="nav_cover" class="nav_cover"></div>
				<p id="breadcrumb" class="breadcrumb">Home &rsaquo; <strong>Servizi</strong></p>
				<div id="userNav" class="userNav">
<?php
  if (isset($_SESSION["userName"])) {
?>
	                <a href="../user/" tabindex="6"><?php echo $_SESSION["userName"] ?></a>
<?php
  }
?>
	            </div>
			</div>
			<div class="wrapper">
			    <div class="general">
			        <div id="alert" class="alert hidden">
	                    <span id="closeAlert" class="closeAlert hidden">&times;</span>
	                    <p id="alertMessage"></p>
	                </div>
                    <h2>Servizi</h2>
<?php
  if (empty($_SESSION["userId"])) {
?>
                    <p>Benvenuto nella pagina dei servizi, da qui con pochi semplici passi potrai effettuare una segnalazione per informare il tuo comune (e non solo...) 
                    di eventuali problemi oppure potrai fornire qualche suggerimento per abbellire il tuo paese!</p>
                    <div class="login_required">
                        <a href="../login/" title="Effettua l&#39;accesso" tabindex="5">Accedi</a> o 
					    <a href="../signin/" title="Effettua la registrazione" tabindex="6">Registrati</a> per utilizzare questa funzione
                    </div>
<?php
  } else {
?>
                    <p>Benvenuto nella pagina dei servizi, da qui con pochi semplici passi potrai effettuare una segnalazione 
						per informare il tuo comune (e non solo...) di eventuali problemi oppure potrai fornire qualche suggerimento 
						per abbellire il tuo paese!</p>
					<p>Se &egrave; la tua prima segnalazione ti consigliamo di seguire 
						<a href="howToReport/" id="how_to_post" title="Vai alla video-guida" tabindex="7">questa guida</a>.
					</p>
				    <div class="reportsLink">
					    <div id="creaReport">
					    	<a href="createReport/" id="crea_report" title="Crea una nuova segnalazione" tabindex="8">Crea Segnalazione</a>
					    </div>
					    <div id="viewReport">
						    <a href="reportList/" title="Visualizza le segnalazioni effettuate" tabindex="9">Visualizza Segnalazioni</a>
					    </div>
					</div>
<?php
  }
?>
                </div>
		    </div>
			<div id="tweak-footer" class="footer">
				<div class="utility">
					<a href="../sitemap/" title="Vai alla mappa del sito">Mappa del sito</a>
					<a href="../contatti/contactRequest/" title="Lascia un feedback">Lascia un feedback</a>
					<a href="../privacy/Termini-e-Condizioni.pdf" id="privacy" title="Visualizza i termini e le condizioni">Termini di Servizio</a>
				</div>
				<div class="footerCover">
				    <div class="social">
				        <p>Puoi trovarci anche su</p>
					    <a href="https://www.facebook.com" title="Pagina Facebook di CittadinanzAttiva">
					        <img src="../resources/img/social/fb.png" id="facebook" alt="Seguici su Facebook!" />
					    </a>
					    <a href="https://www.instagram.com" title="Pagina Instagram di CittadinanzAttiva">
					        <img src="../resources/img/social/ins.png" id="instagram" alt="Seguici su Instagram!" />
					    </a>
					    <a href="https://www.twitter.com" title="Pagina Twitter di CittadinanzAttiva">
					        <img src="../resources/img/social/twit.png" id="twitter" alt="Seguici su Twitter!" />
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