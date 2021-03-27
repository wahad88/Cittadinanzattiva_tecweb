<?php
  session_start();
?>
<!--FORM CONTATTI-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
	<head>
		<title>Richiesta di contatto</title>
		<meta charset="UTF-8" />
		<meta name="description" content="Form di richiesta di contatto" />
		<meta name="keywords" content="comuni, cittadini, attiva, contatti, contattaci" />
		<meta name="author" content="Elia Vettoretto, Abdelwahad Kandoul, Luigi Perin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="../../resources/stylesheet/core.css" rel="stylesheet" type="text/css"  media="screen" />
		<link href="../../resources/stylesheet/form.css" rel="stylesheet" type="text/css"  media="screen" />
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
					    <h1 id="logo" tabindex="1">CittadinanzAttiva.city</h1>
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
				<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Contattaci &rsaquo; <strong>Nuova Richiesta</strong></p>
				<div id="userNav" class="userNav">
<?php
  if (isset($_SESSION["userId"])) {
?>
				    <a href="../../user/" title="Visualizza le impostazioni e i tuoi dati"><?php echo $_SESSION["userName"]; ?></a>
<?php
  }
?>
				</div>
			</div>    
			<div class="wrapper">
				<div class="general">
				<h2>Scrivi la tua richiesta</h2>
					<form class="contenuto-modulo animato noscript" id="contact-form" action="../../resources/php/form/contactCheck.php" method="post">
						<div class="container">
							<fieldset>
								<legend>Richiesta</legend>
								<label for="name">Nome</label>
								<input type="text" id="name" name="nome" placeholder="Mario" required="required" />
								<p class="errorField" id="errorName"></p>
								<label for="surname">Cognome</label>
								<input type="text" id="surname" name="cognome" placeholder="Rossi" required="required" />
								<p class="errorField" id="errorSurname"></p>
								<label for="contact-email">Email</label>
								<input type="email" id="contact-email" name="email" placeholder="mario.rossi&#64;libero.it" required="required" />
								<p class="errorField" id="errorEmail"></p>
								<label for="request-textarea">Motivo per cui vuoi contattarci</label>
								<textarea id="request-textarea" name="textarea" placeholder="Questo sito &egrave; fantastico" required="required"
								rows="8" cols="31"></textarea>
								<p class="errorField" id="errorTextarea"></p>
								<button type="submit" class="disableButton" title="Invia il feedback">Invia</button>
							</fieldset>
						</div>
						<script src="../../resources/js/preventSpam.js" type="text/javascript"></script>
						<script src="../../resources/js/contactsCheck.js" type="text/javascript"></script>
					</form>
				</div>
			</div>
			<div class="footer">
				<div class="utility">
					<a href="../../sitemap/" title="Vai alla mappa del sito">Mappa del sito</a>
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