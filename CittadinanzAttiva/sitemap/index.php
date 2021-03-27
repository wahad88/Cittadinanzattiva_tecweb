<?php
    session_start();
?>
<!--SITEMAP-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
	<head>
		<title>SiteMap</title>
		<meta charset="UTF-8" />
		<meta name="description" content="Mappa del sito di CittadinzAttiva" />
		<meta name="keywords" content="comuni, cittadini, attiva, mappa del sito, sitemap" />
		<meta name="author" content="Elia Vettoretto, Abdelwahad Kandoul, Luigi Perin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="../resources/stylesheet/core.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../resources/stylesheet/sitemap.css" rel="stylesheet" type="text/css" media="screen" />
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
				<p id="breadcrumb" class="breadcrumb">Home &rsaquo; <strong>Mappa del sito</strong></p>
				<div id="userNav" class="userNav">
			        <?php
	                  //SE ESISTE UNA SESSIONE MOSTRA LE OPZIONI UTENTE
	                  if (isset($_SESSION["userId"])) {
	                ?>
	                    <a href="../user/" title="Visualizza le impostazioni e i tuoi dati"><?php echo $_SESSION["userName"]; ?></a>
	                <?php
	                  }
	                ?>
	            </div>
			</div>
			<div class="wrapper">
                <div class="general">
                    <h2>Mappa del sito</h2>
                    <div class="sitemap">
                        <table id="sitemap-table" title="Tabella che rappresenta la struttura del sito">
                            <caption>Una semplice rappresentazione della struttura del sito</caption>
                            <tr>
                                <td id="home" colspan="3"><a href="../">Home</a></td>
                            </tr>
                            <tr>
                                <td headers="home"><a class="newsMap" href="../news/">News</a></td>
                                <td headers="home"><a class="serviceMap" href="../service/">Servizi</a></td>
                                <td headers="home"><a class="contactMap" href="../contatti/">Contatti</a></td>
                            </tr>
                            <tr>
                                <td rowspan="3"></td>
                                <td headers="home"><a class="serviceMap" href="../service/createReport/">Crea Segnalazione</a></td>
                                <td headers="home"><a class="contactMap" href="../contatti/contactRequest/">Mail Us</a></td>
                            </tr>
                            <tr>
                                <td headers="home"><a class="serviceMap" href="../service/reportList/">Visualizza Segnalazione</a></td>
                                <td rowspan="2"></td>
                            </tr>
                            <tr>
                                <td headers="home"><a class="serviceMap" href="../service/howToReport/">Guida alla segnalazione</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div id="tweak-footer" class="footer">
				<div class="utility">
				    <a href="../contatti/contactRequest/" title="Lascia un feedback">Lascia un feedback</a>
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