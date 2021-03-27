<?php
  session_start(); //INIZIA LA SESSIONE
  include "resources/php/database/config.php";
  $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
?>
<!--HOME PAGE-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
    <head>
		<meta charset="UTF-8" />
		<meta name="description" content="Benvenuti in CittadinanzAttiva, la prima piattaforma web per aiutare il tuo comune" />
		<title>Cittadinanzattiva.city, il primo portale per aiutare il tuo comune</title>
		<meta name="keywords" content="CittadinanzAttiva, Comuni, Provincie, Aiutare, Segnalazioni, Progetto, aiuta il tuo comune, 
		segnala un problema" />
		<meta name="author" content="Elia Vettoretto, Abdelwahad Kandoul, Luigi Perin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="resources/stylesheet/core.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="resources/stylesheet/mobile.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="resources/stylesheet/print.css" rel="stylesheet" type="text/css" media="print" />
		<link href="resources/stylesheet/fonts/Exo.css" rel="stylesheet" type="text/css" media="all" />
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href="favicon.ico" rel="icon" type="image/x-icon" />
		<script src="resources/js/generalScript.js" type="text/javascript"></script>
		<script src="resources/js/alertFunction.js" type="text/javascript"></script>
		<script src="resources/js/handleOnLoad.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="core">
		    <div class="nav" id="navbar">
				<div id="logo_div" class="logo">
					<img src="resources/img/icon/logo_img.png" id="logo_img" alt="Logo di CittadinanzAttiva" />
					<h1 tabindex="1">CittadinanzAttiva.city</h1>
				</div>
				<span class="burger-menu" id="burger-menu" onclick="showMenu()"></span>
			    <ul>
			       	<li>
		    	        <a href="service/" tabindex="2" title="Vai alla pagina dei servizi">SERVIZI</a>
			        </li>
			        <li>
			        	<a href="news/" title="Vai alla pagina delle news" tabindex="3">NEWS</a>
			        </li>
			        <li>
			        	<a href="contatti/"  id="contatti_home" title="Vai alla pagina dei contatti" tabindex="4">CONTATTACI</a>
			       	</li>
<?php
  if(isset($_SESSION["userId"])) {
?>
				    <li>
				        <a href="resources/php/form/Logout.php">LOGOUT</a>
				    </li>
<?php
  }
?>
				</ul>
				<div id="nav_cover" class="nav_cover"></div>
				<p id="breadcrumb" class="breadcrumb"><strong>Home</strong></p>
				<div id="userNav" class="userNav">
<?php
  if (isset($_SESSION["userId"])) {
?>
				    <a href="user/" title="Visualizza le impostazioni e i tuoi dati"><?php echo $_SESSION["userName"]; ?></a>
<?php
  }
?>
				</div>
			</div>
            <div class="wrapper">
                <div class="general">
<?php
  //SE ESISTE UNA SESSIONE ATTIVA
  if (isset($_SESSION["userId"])) {
    include "resources/php/script/date.php";  
    $date = lastLogin();
?>
                    <h2>Bentornato <?php echo $_SESSION["userName"]; ?></h2>
                    <h3>Il tuo ultimo accesso &egrave; stato effettuato il <?php echo $date["lastData"]; ?> alle ore <?php echo $date["lastOra"]; ?></h3>
                    <h4 id="lastLogin">Da allora sono passati ben: <?php interval($date["lastData"], $date["lastOra"]); ?></h4>
<?php
    if($_SESSION["userLevel"] !== 65) {
      //SE E' UN UTENTE NORMALE MOSTRA SE HA MESSAGGI
      $sql = "SELECT Letto FROM messaggi WHERE Letto = 'No' AND Destinatario = " . $_SESSION["userId"];
      $result = mysqli_query($mysqli, $sql);
      if (mysqli_num_rows($result)) {
?>
                    <p id="newMsg">Hai un nuovo <a href="user/?id=divMessaggi">messaggio</a></p>
<?php
      } else {
?>                  <p id="noMsg">Non hai nuovi messaggi</p>
<?php
      }
    } else {
      //ALTRIMENTI MOSTRA I FEEDBACK
      $sql = "SELECT RichiestaLetta FROM richieste WHERE RichiestaLetta = 'No'";
      $result = mysqli_query($mysqli, $sql);
      if (mysqli_num_rows($result)) {
?>
                    <p id="newMsg">Hai un nuovo <a href="user/admin/?id=divMessaggi">feedback</a></p>
<?php
      } else {
?>                  <p id="noMsg">Non hai nuovi feedback</p>
<?php
      }
    }
  } else {
    //MOSTRA LA PAGINA INIZIALE
?>
                    <h2>Benvenuto in Cittadinanzattiva</h2>
                    <h3>Il primo portale per aiutare il tuo comune</h3>
					<div id="accedi">
                        <a href="login/" id="login" title="Effettua l&#39;accesso" tabindex="5">Accedi</a>
                    </div>
                    <div id="registrati">
                        <a href="signin/" id="reg" title="Effettua la registrazione" tabindex="6">Registrati</a>
                    </div>
                    <h4>Cos&#39;&egrave; CittadinazAttiva</h4>
                    <p>CittadinanzAttiva &egrave; un progetto svilupatto da 3 
                       studenti di informatica dell&#39;Universit&agrave; di Padova.
					<br />
                    Lo scopo del progetto &egrave; quello di creare una piattaforma 
                    web per permettere ai cittadini di tutti i comuni italiani e non
                    solo di inviare dei &ldquo;rapporti&rdquo; sullo stato del 
                    proprio comune per segnalare eventuali problemi, rendendo 
                    pi&ugrave; facile al comune stesso la visione dei vari problemi
                    da affrontare e intervenire il pi&ugrave; rapidamente possibile.</p>
<?php
  }
?>
                </div>
            </div>
			<div <?php if (isset($_SESSION["userId"])) { ?>id="tweak-footer"<?php } ?> class="footer">
				<div class="utility">
					<a href="sitemap/" title="Vai alla mappa del sito">Mappa del sito</a>
					<a href="contatti/contactRequest/" title="Lascia un feedback">Lascia un feedback</a>
					<a href="privacy/Termini-e-Condizioni.pdf" id="privacy" title="Visualizza i termini e le condizioni">Termini di Servizio</a>
				</div>
				<div class="footerCover">
				    <div class="social">
				        <p>Puoi trovarci anche su</p>
				    	<a href="https://www.facebook.com" title="Pagina Facebook di CittadinanzAttiva">
				    	    <img src="resources/img/social/fb.png" id="facebook" alt="Seguici su Facebook!" />
				    	</a>
				    	<a href="https://www.instagram.com" title="Pagina Instagram di CittadinanzAttiva">
				    	    <img src="resources/img/social/ins.png" id="instagram" alt="Seguici su Instagram!" />
				    	</a>
				    	<a href="https://www.twitter.com" title="Pagina Twitter di CittadinanzAttiva">
				    	    <img src="resources/img/social/twit.png" id="twitter" alt="Seguici su Twitter!" />
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