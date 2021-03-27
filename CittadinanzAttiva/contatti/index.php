<?php 
    session_start();
?>
<!--CONTATTI-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
	<head>
		<title>Contatti</title>
		<meta charset="UTF-8" />
		<meta name="description" content="In questa pagina viene spiegato come contattare gli amministratori
		del sito, per risolvere eventuali problemi o richiedere informazioni aggiuntive" />
		<meta name="keywords" content="provincie, comuni, cittadini, attiva, cittadinanzattiva, segnalazioni,
		contatti, contattaci, richieste, domande, informazioni" />
		<meta name="author" content="Elia Vettoretto, Abdelwahad Kandoul, , Luigi Perin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="../resources/stylesheet/core.css" rel="stylesheet" type="text/css"  media="screen" />
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
					    <h1 id="logo" tabindex="1">CittadinanzAttiva.city</h1>
					</a>
				</div>  
				<span class="burger-menu" id="burger-menu" onclick="showMenu()"></span>
				<ul>
					<li>
			    	    <a href="../service/" title="Vai alla pagina dei serivizi" tabindex="2">SERVIZI</a>
			    	</li>
			    	<li>
			    		<a href="../news/" title="Vai alla pagina delle news" tabindex="3">NEWS</a>
			    	</li>
<?php
  if(isset($_SESSION["userId"])) {
?>
				    <li>
				        <a href="../resources/php/form/Logout.php">LOGOUT</a>
				    </li>
<?php
  }
?>
                </ul>
				<div id="nav_cover" class="nav_cover"></div>
				<p id="breadcrumb" class="breadcrumb">Home &rsaquo; <strong>Contattaci</strong></p>
				<div id="userNav" class="userNav">
<?php 
  //SE ESISTE UNA SESSIONE MOSTRA LE OPZIONI UTENTE
  if (isset($_SESSION["userId"])) {
?>
                    <a href="/user/" title="Visualizza le impostazioni e i tuoi dati"><?php echo $_SESSION["userName"]; ?></a>
<?php
  }
?>
                </div>
            </div>
	        <div class="wrapper">
                <div class="general">
					<h2>Contattaci</h2>
					<div id="alert" class="alert hidden">
	                    <span id="closeAlert" class="closeAlert hidden">&times;</span>
	                    <p id="alertMessage"></p>
	                </div>
					<div class="contact_info">
						<p>
						Si prega di utilizzare il modulo di contatto sottostante se avete domande o
						richieste riguardanti i servizi offerti dal sito.
						<br />
						Cercheremo di rispondere ai vostri messaggi entro 24 ore.
						</p>
						<div class="contact_button">
							<a href="contactRequest/" id="contact_button">Scrivici</a>
						</div>
						<p>Altrimenti potete contattarci tramite i seguenti canali:</p>
						<div class="contact_icon">
							<a href="tel:3484051236" id="phone_link" title="Numero di telefono: 3484051236">
								<img src="../resources/img/social/whatsapp.png" id="phone_icon" alt="Contatto WhatsApp" />
							</a>
							<a href="mailto:support@cittadinanzattiva.city" id="mail_link" title="E-mail: support@cittadinanzattiva.city">
								<img src="../resources/img/social/email.png" id="email_icon" alt="E-mail: support@cittadinanzattiva.city" />
							</a>
							<a href="https://web.telegram.org/#/login" id="telegram_link" title="Contatto Telegram">
								<img src="../resources/img/social/telegram.png" id="telegram_icon" alt="Contatto Telegram" />
							</a>
						</div>
					</div>
				</div>
			</div>
			<div id="tweak-footer" class="footer">
				<div class="utility">
					<a href="../sitemap/" title="Vai alla mappa del sito">Mappa del sito</a>
					<a href="../privacy/Termini-e-Condizioni.pdf" title="Visualizza i termini e le condizioni">Termini di Servizio</a>
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