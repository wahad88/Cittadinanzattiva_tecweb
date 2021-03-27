<?php 
    session_start();
?>
<!--NEWS-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
    <head>
        <title>Ultime News</title>
		<meta charset="UTF-8" />
		<meta name="description" content="Leggi le ultime news su CittadinanzAttiva" />
		<meta name="keywords" content="comuni, cittadini, attiva, news" />
		<meta name="author" content="Elia Vettoretto, Abdelwahad Kandoul, Luigi Perin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="../resources/stylesheet/core.css" rel="stylesheet" type="text/css" media="screen" />
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
		    			<a href="../contatti/" title="Vai alla pagina dei contatti" tabindex="3">CONTATTACI</a>
			   		</li>
<?php
  if(isset($_SESSION["userId"])) {
?>
    			    <li>
				        <a href="../resources/php/form/Logout.php" tabindex="4">LOGOUT</a>
				    </li>
<?php
  }
?>
                </ul>
				<div id="nav_cover" class="nav_cover"></div>
				<p id="breadcrumb" class="breadcrumb">Home &rsaquo; <strong>News</strong></p>
				<div id="userNav" class="userNav">
<?php
  if (isset($_SESSION["userId"])) {
?>
	                <a href="../user/" title="Visualizza le impostazioni e i tuoi dati" tabindex="5"><?php echo $_SESSION["userName"]; ?></a>
<?php
  }
?>
	            </div>
	        </div>
	        <div class="wrapper">
				<div class="general">
					<h2>Ultime News</h2>
					<div class="news">
						<div class="searchDiv">
							<label for="searchNews" id="searchLable">Cerca velocemente una news</label>
							<input type="text" id="searchNews" onkeyup="searchNews()" tabindex="5" placeholder="Cerca news..." />
							<span id="radio-select">Seleziona il tipo di campo da ricercare</span>
							<input type="radio" id="idReport" name="queryValue" value="0" checked="checked" tabindex="6" />
							<label for="idReport">ID</label>
							<input type="radio" id="newsName" name="queryValue" value="1" tabindex="7" />
							<label for="newsName">Titolo</label>
							<input type="radio" id="date" name="queryValue" value="2" tabindex="8" />
							<label for="date">Data</label>
							<p id="noResults"></p>
						</div>
                    <?php
                      //RICHIEDI LO SCRIPT CHE CARICA LE NEWS
                      require_once '../resources/php/script/loadNews.php';
                      echo "\r\n";
                    ?>
                        <script src="../resources/js/searchNews.js" type="text/javascript"></script>
					</div>
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
