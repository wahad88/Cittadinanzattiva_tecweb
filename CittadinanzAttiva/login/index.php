<?php
  session_start();
  if (isset($_SESSION["userId"])) {
    header("Location: ../");
    die("Ti stiamo reinderizzando verso la pagina pricipale");
  }
?>
<!--LOGIN-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
	<head>
		<meta charset="UTF-8" />
		<meta name="description" content="Effettua l&#39;accesso al sito e accedi a tutte le sue funzioni" />
		<title>Login</title>
		<meta name="keywords" content="comuni, cittadini, attiva, login, accedi, cittadinanzattiva, funzioni
		cittadinanzattiva.city, portale web, segnalazioni" />
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
				<p id="breadcrumb" class="breadcrumb">Home &rsaquo; <strong>Accedi</strong></p>
            </div>
            <div class="wrapper">
				<div class="general">
				    <h2>Effettua l&#39;accesso</h2>
				    <div id="alert" class="alert alertLogin hidden">
	                    <span id="closeAlert" class="closeAlert hidden">&times;</span>
	                    <p id="alertMessage"></p>
	                </div>
				    <div>
					    <form id="loginForm" class="contenuto-modulo animato" action="../resources/php/form/logIn.php" method="post">
						    <div class="container">
							    <fieldset>
								    <legend>Login</legend>
								    <label for="username">Username</label>
								    <input type="text" id="username" name="username" placeholder="Username" required="required" autocomplete="username" />
								    <p class="errorField" id="wrongUser"></p>
								    <label for="password">Password</label>
								    <input type="password" id="password" name="password" maxlength="32" placeholder="Password" required="required" autocomplete="current-password" />
								    <p class="errorField" id="wrongPwd"></p>
								    <button type="button" class="cancelbtn" onclick="clearInput()">Cancella</button>
								    <button type="submit" id="submitButton" class="disableButton">Accedi</button>
								</fieldset>
								<a href="../signin/" title="Crea un nuovo account">Non hai un account? Registrati!</a>
							</div>
						    <script src="../resources/js/loginCheck.js" type="text/javascript"></script>
					    </form>
				    </div>
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