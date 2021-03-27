<?php
  session_start();
  if(empty($_SESSION["userId"])) {
    header("Location: ../../");
    die("Ti stiamo reindirizzando alla pagina principale");
  }
?>
<!--CREA REPORT-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
	<head>
		<title>Crea Segnalazione</title>
		<meta charset="UTF-8" />
		<meta name="description" content="Crea una nuova segnalazione" />
		<meta name="keywords" content="comuni, cittadini, attiva, segnala, segnalazione, crea segnalazione" />
		<meta name="author" content="Elia Vettoretto, Abdelwahad Kandoul, Luigi Perin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="../../resources/stylesheet/core.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../../resources/stylesheet/service.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../../resources/stylesheet/form.css" rel="stylesheet" type="text/css"  media="screen" />
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
                <p id="breadcrumb" class="breadcrumb">Home &rsaquo; Servizi &rsaquo; <strong>Crea Segnalazione</strong></p>
	            <div id="userNav" class="userNav">
	                <?php
	                  if (isset($_SESSION["userName"])) {
	                ?>
	                <a href="../../user/"><?php echo $_SESSION["userName"]; ?></a>
	                <?php
	                  }
	                ?>
	            </div>
	        </div>
	        <div class="wrapper">
				 <div class="general">
				    <div class="reportDiv">
					    <h2>Crea Segnalazione</h2>
					    <form autocomplete="on" id="reportForm" class="contenuto-modulo animato" 
					    action="../../resources/php/form/checkReport.php"  method="post" enctype="multipart/form-data">
						    <div id="tab_0" class="container">
							    <h3>Passo 1 di 3</h3>
							    <fieldset>
								    <legend>Tipo Segnalazione</legend>
								    <p>I campi contrassegnati da un * sono obbligatori</p>
								    <label for="tipoSegnalazione">Seleziona il tipo di segnalazione *</label>
								    <select id="tipoSegnalazione" name="tipoSegnalazione">
									    <option value=""></option>
									    <option value="Altro">Altro</option>
									    <option value="Animali">Animali</option>
								    	<option value="Autoveicoli Abbandonati">Autoveicoli Abbandonati</option>
									    <option value="Barriere Architettoniche">Barriere Architettoniche</option>
									    <option value="Buche / Strade Dissestate">Buche / Strade Dissestate</option>
									    <option value="Contenitori Rifiuti">Contenitori Rifiuti</option>
									    <option value="Furti / Microcriminalit&agrave;">Furti / Microcriminalit&agrave;</option>
								    	<option value="Graffiti">Graffiti</option>
								    	<option value="Immigrati / Nomadi">Immigrati / Nomadi</option>
									    <option value="Inquinamento">Inquinamento</option>
									    <option value="Illuminazione Pubblica">Illuminazione Pubblica</option>
									    <option value="Abusivismo / Occupazione">Abusivismo / Occupazione</option>
									    <option value="Parcheggi / Divieti di Sosta">Parcheggi / Divieti di Sosta</option>
									    <option value="Rifiuti">Rifiuti</option>
									    <option value="Segnaletica Stradale / Semafori">Segnaletica Stradale / Semafori</option>
									    <option value="Situazioni di Degrado Sociale">Situazioni di Degrado Sociale</option>
									    <option value="Verde Pubblico">Verde Pubblico</option>
								    </select>
								    <p class="errorField" id="errorSelect"></p>
								    <button type="button" id="firstNextBtn" class="nextBtn disableButton">Avanti</button>
							    </fieldset>
						    </div>
						    <div id="tab_1" class="container hidden">
							    <h3>Passo 2 di 3</h3>
							    <fieldset>
								    <legend>Luogo Segnalazione</legend>
								    <label for="provincia">Provincia *</label>
								    <input type="text" id="provincia" name="provincia" placeholder="Treviso"  maxlength="21"
								    required="required" />
								    <img src="../../resources/img/icon/loading.gif" id="loadingProv" class="loadingIcon hidden" alt="Icona caricamento" />
								    <div id="selectProv" class="selectCountry hidden">
								    </div>
								    <p class="errorField" id="errorProv"></p>
								    <label for="paese">Comune *</label>
								    <input type="text" id="paese" name="comune" placeholder="Paese" maxlength="34"
								    required="required" />
								    <img src="../../resources/img/icon/loading.gif" id="loadingPaese" class="loadingIcon hidden" alt="Icona caricamento" />
								    <div id="selectPaese" class="selectCountry hidden">
								    </div>
								    <p class="errorField" id="errorPaese"></p>
								    <label for="nomeStrada">Nome della strada *</label>
								    <input type="text" id="nomeStrada" name="toponimo" placeholder="Martiri della libert&agrave;" maxlength="30" 
								    required="required" />
								    <p class="errorField" id="errorAddress"></p>
								    <button type="button" id="prevButton_1" class="prevBtn">Indietro</button>
								    <button type="button" id="nextButton_2" class="nextBtn disableButton">Avanti</button>
							    </fieldset>
						    </div>
						    <div id="tab_2" class="container hidden">
							    <h3>Passo 3 di 3</h3>
							    <fieldset>
							    	<legend>Descrizione</legend>
							    	<label for="text">Fornisci una breve descrizione del problema *</label>
							    	<textarea id="text" name="description" placeholder="Inserisci una descrizione del problema" 
							    	required="required" rows="8" cols="31"></textarea>
							    	<p class="errorField" id="errorText"></p>
							    	<label for="fileToUpload">Carica prova fotografica</label>
							    	<input type="file" id="fileToUpload" name="fileToUpload" />
							    	<p id="img_rule_noscript">Il file deve avere una dimensione massima di 2MB e deve essere in formato JPG, JPEG, PNG, GIF</p>
							    	<button type="button" id="prevButton_2" class="prevBtn">Indietro</button>
							    	<button type="submit" id="sendReport" class="nextBtn disableButton">Invia</button>
							    </fieldset>
						    </div>
						    <script src="../../resources/js/liveSearch.js" type="text/javascript"></script>
						    <script src="../../resources/js/reportCheck.js" type="text/javascript"></script>
					    </form>
				    </div>
				</div>
			</div>
			<div id="tweak-footer" class="footer">
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