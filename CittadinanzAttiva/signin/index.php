<?php
  if(isset($_SESSION["userId"])) {
    header("Location: ../");
    die("Ti stiamo reindirizzando verso la pagina principale");
  }
?>
<!--SIGNIN-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
	<head>
		<title>Registrati</title>
		<meta charset="UTF-8" />
		<meta name="description" content="Form di registrazione" />
		<meta name="keywords" content="comuni, cittadini, attiva, signup, registrati" />
		<meta name="author" content="Elia Vettoretto, Abdelwahad Kandoul, Luigi Perin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="../resources/stylesheet/core.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../resources/stylesheet/form.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../resources/stylesheet/mobile.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../resources/stylesheet/print.css" rel="stylesheet" type="text/css" media="print" />
		<link href="../resources/stylesheet/fonts/Exo.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href="../favicon.ico" rel="icon" type="image/x-icon" />
		<script src="../resources/js/generalScript.js" type="text/javascript"></script>
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
			    	    <a href="../service/" title="Vai alla pagina dei servizi" tabindex="2">SERVIZI</a>
				    </li>
				    <li>
					    <a href="../news/" title="Vai alla pagina delle news" tabindex="3">NEWS</a>
				    </li>
				    <li>
					    <a href="../contatti/" title="Vai alla pagina dei contatti" tabindex="4">CONTATTACI</a>
				    </li>
				</ul>
				<div id="nav_cover" class="nav_cover"></div>
				<p id="breadcrumb" class="breadcrumb">Home &rsaquo; <strong>Registrati</strong></p>
            </div>
            <div class="wrapper">
				<div class="general">
					<h2>Registrati</h2>
					<form autocomplete="on" id="regForm" class="contenuto-modulo animato" action="../resources/php/form/signUp.php" method="post">
						<div id="tab_0" class="container">
							<h3>Passaggio 1 di 4</h3>
							<fieldset>
								<legend>Dati Personali</legend>
								<label for="nome">Nome *</label>
								<input type="text" id="nome" name="nome" placeholder="Mario" maxlength="30" required="required" 
								autocomplete="given-name" />
								<p class="errorField" id="errorName"></p>
								<label for="cognome">Cognome *</label>
								<input type="text" id="cognome" name="cognome" placeholder="Rossi" maxlength="30" required="required" 
								autocomplete="family-name" />
								<p class="errorField" id="errorSurname"></p>
								<label for="date" id="data_nascita">Data di Nascita *</label>
								<input type="date" id="date" name="bdata" required="required" autocomplete="bday" />
								<p class="errorField" id="errorData"></p>
								<label for="cf">Codice Fiscale *</label>
								<input type="text" id="cf" name="codiceFiscale" placeholder="RSSMRA67L12A001K" maxlength="16" 
								required="required" autocomplete="on" />
								<p class="errorField" id="errorCf"></p>
								<button type="button" id="firstNextBtn" class="nextBtn disableButton">Avanti</button>
							</fieldset>
						</div>
						<div id="tab_1" class="container hidden">
							<h3>Passaggio 2 di 4</h3>
							<fieldset>
								<legend>Residenza</legend>
								<label for="indirizzo">Indirizzo *</label>
								<input type="text" id="indirizzo" name="indirizzo" placeholder="Via dei Carpani" maxlength="30" 
								required="required" autocomplete="street-address" />
								<p class="errorField" id="errorAddress"></p>
								<label for="civico">Civico *</label>
								<input type="text" id="civico" name="civico" placeholder="231/A" maxlength="8" 
								required="required" autocomplete="on" />
								<p class="errorField" id="errorCivico"></p>
								<label for="provincia">Provincia *</label>
								<input type="text" id="provincia" name="provincia" placeholder="Treviso" maxlength="45" 
								required="required" autocomplete="address-level2" />
								<p class="errorField" id="errorProv"></p>
								<label for="paese">Comune *</label>
								<input type="text" id="paese" name="comune" placeholder="Paese" maxlength="45" required="required" 
								autocomplete="address-level3" />
								<p class="errorField" id="errorPaese"></p> 
								<button type="button" id="prevButton_1" class="prevBtn">Indietro</button>
								<button type="button" id="nextButton_2" class="nextBtn disableButton">Avanti</button>
							</fieldset>
						</div>
						<div id="tab_2" class="container hidden">
							<h3>Passaggio 3 di 4</h3>
							<fieldset>
								<legend>Contatti</legend>
								<label for="telefono">Telefono</label>
								<input type="number" id="telefono" name="telefono" placeholder="0453487564" autocomplete="tel"/>
								<p class="errorField" id="errorTel"></p>
								<label for="cellulare">Cellulare *</label>
								<input type="number" id="cellulare" name="cellulare" placeholder="3467889886" 
								required="required" autocomplete="tel" />
								<p class="errorField" id="errorCell"></p>
								<label for="email">Email *</label>
								<input type="email" id="email" name="email" placeholder="mario.rossi&#64;gmail.com" 
								maxlength="30" required="required" autocomplete="email" />
								<p class="errorField" id="errorEmail"></p>
								<button type="button" id="prevButton_2" class="prevBtn">Indietro</button>
								<button type="button" id="nextButton_3"class="nextBtn disableButton">Avanti</button>
							</fieldset>
						</div>
						<div id="tab_3" class="container hidden">
							<h3>Passaggio 4 di 4</h3>
							<fieldset>
								<legend>Username</legend>
								<label for="regUsername" id="label-top">Username *</label>
								<input type="text" id="regUsername" name="username" placeholder="User" maxlength="16" 
								required="required" autocomplete="username" />
								<p class="errorField" id="errorUser"></p>
								<label for="regPassword">Password *</label>
								<input type="password" id="regPassword" name="password" placeholder="Password" 
								maxlength="16" required="required" autocomplete="new-password" />
								<p class="errorField" id="errorPwd"></p>
								<label for="cofPassword">Conferma Password *</label>
								<input type="password" id="cofPassword" name="conferma_password" placeholder="Conferma Password" 
								maxlength="16" required="required" autocomplete="new-password" />
								<p class="errorField" id="errorCofPwd"></p>
								<button type="button" id="prevButton_3" class="prevBtn">Indietro</button>
								<button type="submit" id="sendForm" class="nextBtn disableButton">Registrati</button>
							</fieldset>
						</div>
						<script src="../resources/js/signUpCheck.js" type="text/javascript"></script>
					</form>
				</div>
			</div>
		    <div class="footer">
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