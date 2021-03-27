<?php
  session_start();
  if (empty($_SESSION["userId"])) {
   header("Location: ../../");
   die("Ti stiamo reindirizzando alla pagina principale");
  } else if ($_SESSION["userLevel"] !== 65) {
    header("Location: ../../");
    die("Ti stiamo reindirizzando alla pagina principale");
  } else {
    //CONNETTITI AL DATABASE
    include("../../resources/php/database/config.php");
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
  }
?>
<!--OPZIONI UTENTE AMMINISTRATORE-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
    <head>
        <title>Opzioni Amministratore</title>
		<meta charset="utf-8" />
		<meta name="description" content="Opzioni utente" />
		<meta name="keywords" content="comuni, cittadini, attiva" />
		<meta name="author" content="Elia Vettoretto, Abdelwahad Kandoul, Luigi Perin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="../../resources/stylesheet/core.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../../resources/stylesheet/form.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../../resources/stylesheet/user.css" rel="stylesheet" type="text/css"  media="screen" />
		<link href="../../resources/stylesheet/mobile.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../../resources/stylesheet/print.css" rel="stylesheet" type="text/css" media="print" />
		<link href="../../resources/stylesheet/fonts/Exo.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../../favicon.ico" rel="shortcut icon" type="image/x-icon" media="all" />
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
                <p id="breadcrumb" class="breadcrumb">Home &rsaquo; <strong>Amministrazione</strong></p>
	            <div id="userNav" class="userNav">
	                <span><?php echo $_SESSION["userName"]; ?></span>
                </div>
            </div>
            <div class="wrapper">
	            <div class="general">
	                <div id="alert" class="alert hidden">
	                    <span id="closeAlert" class="closeAlert hidden">&times;</span>
	                    <p id="alertMessage"></p>
	                </div>
	                <h2>Benvenuto nell&#39; area di amministrazione</h2>
	                <h3>Da qui puoi caricare\eliminare nuove\vecchie news, controllare le attivita del sito e molto altro.</h3>
	                <div class="userOption">
	                    <button type="button" class="activeButton" title="Modifica/Aggiorna i tuoi dati personali" onclick="showTab(1)"
	                    tabindex="5">Amministrazione</button>
	                    <button type="button" title="Leggi i messaggi" onclick="showTab(3)" tabindex="6">Richieste</button>
	                    <button type="button" title="Visualizza le tue statistiche" onclick="showTab(5)" tabindex="7">Statistiche</button>
	                </div>
	                <div class="userOptionCover">
	                    <div id="datiPersonali" class="divScheda">
                            <div class="subNav">
                                <ul>
                                    <li class="activeOption" onclick="showOption(1)" tabindex="8">Carica news</li>
                                    <li class="useless" onclick="showOption(2)" tabindex="9">Elimina News</li>
                                    <li class="useless" onclick="showOption(3)" tabindex="10">Scrivi Messaggio</li>
                                    <li class="useless" onclick="showOption(4)" tabindex="11">Elimina Segnalazione</li>
                                    <li class="useless" onclick="showOption(5)" tabindex="12">Modifica Segnalazione</li>
                                </ul>
                            </div>
                            <div id="caricaNews" class="changeForm administration">
                                <form id="formCaricaNews" method="post" action="../../resources/php/form/submitNews.php">
                                    <fieldset>
                                        <legend id="legend-caricaNews">Inserisci una nuova News</legend>
								        <label for="titolo">Titolo</label>
								        <input type="text" id="titolo" name="news_title" placeholder="Titolo" 
								        maxlength="60" required="required" />
								        <label for="news">Contenuto</label>
								        <textarea id="news" name="news_body" placeholder="Inserisci la news"  
								        maxlength="800" required="required" rows="5" cols="40"></textarea>
                                        <button type="submit" id="submitNews">Carica News</button>
                                    </fieldset>
                                </form>
                            </div>
                            <div id="deleteNews" class="hidden">
                                <form id="formDeleteNews" method="post" action="../../resources/php/form/removeNews.php">
                                    <fieldset>
                                        <legend>Elimina una News</legend>
                                        <label for="delete" id="label-deleteNews">Seleziona la notizia da eliminare</label>
<?php
  //SELEZIONA LA NEWS DA ELIMINARE
  include '../../resources/php/script/editDocument.php';
  //CARICA DOCUMENTO DELLE NEWS
  $request ="deleteNews";
  $xml = loadDocument($request);
  $root = $xml->documentElement;
  $news = $root->getElementsByTagName("news");
  //CONTROLLA SE IL DOCUMENTO E' VUOTO
  if($news->item(0) == NULL) {
?>
                                        <p>Non ci sono notizie da eliminare</p>
<?php
  } else {
    //ALTRIMENTI STAMPA L'ELENCO DELLE NEWS
?>
                                        <select id="delete" name="deleteNews" required="required">
<?php
    $value = 0;
    //ID DELLA PRIMA NEWS
    $newsId = $news[0]->getAttribute("id");
    //NUMERO DI NEWS TOTALI
    $totNews = $newsId;
    for($i = 0; $i < $totNews; $i += 1) {
      //TITOLO DELLA NEWS
      $title = $news[$i]->getElementsByTagName("titolo");
?>
                                            <option value="<?php echo $value; ?>">News #<?php echo $newsId; ?> - <?php echo $title[0]->nodeValue; ?></option>
<?php
      $newsId -= 1;
      $value += 1;
    }
?>
                                        </select>
							            <button type="submit" id="button-deleteNews">Elimina News</button>
<?php  
  } 
?>
                                    </fieldset>
                                </form>
                            </div>
                            <div id="msg" class="hidden">
                                <form id="sendMessagge" method="post" action="../../resources/php/form/sendMessage.php" >
                                    <fieldset>
                                        <legend id="legend-messaggio">Scrivi un nuovo messaggio</legend>
                                        <label for="destinatario">Destinatario</label>
                                        <select id="destinatario" name="destinatario" required="required">
<?php
  $sql = "SELECT User FROM utente WHERE User <> 'admin';";
  $result = mysqli_query($mysqli, $sql);
  if (mysqli_num_rows($result) > 0) {
  //STAMPA LE OPTION
    while ($row = mysqli_fetch_array($result)) {
?>
                                            <option value="<?php echo $row["User"]; ?>"><?php echo $row["User"]; ?></option>
<?php
    }
  }
?>
                                        </select>
                                        <label for="corpoMsg">Testo</label>
                                        <textarea id="corpoMsg" name="bodyMsg" required="required" rows="5" cols="40"
                                        placeholder="Scrivi il tuo messaggio..."></textarea>
                                        <button type="submit">Invia Messaggio</button>
                                    </fieldset>
                                </form>
                            </div>
                            <div id="deleteReport" class="hidden">
                                <form method="post" action="../../resources/php/form/editReport.php">
                                    <fieldset>
                                        <legend>Elimina segnalazione</legend>
                                        <label for="deleteReportId" id="label-deleteReport">Scegli una segnalazione da eliminare</label>
                                        <select id="deleteReportId" name="report" required="required">
<?php
  $sql = "SELECT IDSegnalazione, Comune FROM segnalazione ORDER BY IDSegnalazione;";
  $result = mysqli_query($mysqli, $sql);
  if (mysqli_num_rows($result) > 0) {
  //STAMPA LE OPTION
    while ($row = mysqli_fetch_array($result)) {
?>
                                            <option value="<?php echo $row["IDSegnalazione"]; ?>">ID: <?php echo $row["IDSegnalazione"]; ?>; Comune: <?php echo $row["Comune"]; ?></option>
<?php
    }
  }
?>
                                        </select>
                                        <input type="hidden" name="formType" value="delete" />
                                        <button type="submit" id="button-deleteReport">Elimina Segnalazione</button>
                                    </fieldset>
                                </form>
                            </div>
                            <div id="editReport" class="hidden">
                                <form method="post" action="../../resources/php/form/editReport.php">
                                    <fieldset>
                                        <legend>Modifica stato segnalazione</legend>
                                        <label for="editReportId" id="label-editReport">Scegli la segnalazione da impostare come risolta</label>
                                        <select id="editReportId" name="report" required="required">
<?php
  $sql = "SELECT IDSegnalazione, Comune FROM segnalazione ORDER BY IDSegnalazione;";
  $result = mysqli_query($mysqli, $sql);
  if (mysqli_num_rows($result) > 0) {
  //STAMPA LE OPTION
    while ($row = mysqli_fetch_array($result)) {
?>
                                            <option value="<?php echo $row["IDSegnalazione"]; ?>">ID: <?php echo $row["IDSegnalazione"]; ?>; Comune: <?php echo $row["Comune"]; ?></option>
<?php
    }
  }
?>
                                        </select>
                                        <input type="hidden" name="formType" value="edit" />
                                        <button type="submit" id="button-editReport">Imposta stato</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        <div id="divMessaggi" class="hidden">
                            <table id="messageTable" title="Tabella dei messaggi">
                                <caption>Qui vengono riportate tutte le richieste ricevute</caption>
				                <thead>
				                    <tr>
					                   	<th id="mittente">Mittente</th>
					                   	<th id="messaggio">Messaggio</th>
					                   	<th id="letto">Letto</th>
					                </tr>
				                </thead>
				                <tbody>
<?php
  $userId = $_SESSION["userId"];
  //PREPARA LA QUERY PER CERCARE LE RICHIESTE
  $sql = "SELECT IDRichiesta, Email, Richiesta, RichiestaLetta FROM richieste ORDER BY IDRichiesta DESC";  
  //EFFETUA LA QUERY
  $result = mysqli_query($mysqli, $sql);
  //SE LA QUERY HA PRODOTTO UN RISULTATO
  if (mysqli_num_rows($result) > 0) {
  //STAMPA LE RIGHE DELLA TABELLA
    while ($row = mysqli_fetch_array($result)) {
      $count = 12;
      //MOSTRA SOLO I PRIMI 50 CARATTERI DEL MESSAGGIO
      $sub = substr($row["Richiesta"], 0, 50);
?>
                                    <tr onclick="openRequest('<?php echo $row["IDRichiesta"]; ?>')" 
                                        onkeypress="openRequestPress('<?php echo $row["IDRichiesta"]; ?>', event)" 
                                        tabindex="<?php echo $count; ?>">
                                        <td headers="mittente" class="width-20"><?php echo $row["Email"]; ?></td>
                                        <td headers="messaggio"><?php echo $sub; ?>...</td>
                                        <td headers="letto" class="width-20"><?php echo $row["RichiestaLetta"]; ?></td>
                                    </tr>
<?php  
    }
    $count += 1;
  } else {
?>                                  <tr>
                                        <td colspan="3">Non ci sono richieste</td>
                                    </tr>
<?php
  }
?>
                                </tbody>
                            </table>
                        </div>
                        <div id="statistics" class="hidden">
                            <h4 id="statistics-h4">Totale segnalazioni effettuate</h4>
<?php
 //NUMERO DI SEGNALAZIONI EFFETTUATE
 $sql = "SELECT COUNT(IDSegnalazione) AS Tot FROM segnalazione";
 $result = mysqli_query($mysqli, $sql);
 if (mysqli_num_rows($result) > 0) {
   $reportCount = mysqli_fetch_array($result);
 }
 //ULTIMA SEGNALAZIONE EFFETTUATA
 $sql = "SELECT User, TipoSegnalazione, Comune, DataSegnalazione, OraSegnalazione 
        FROM segnalazione JOIN utente ON segnalazione.IDUtente = utente.ID
        ORDER BY DataSegnalazione DESC LIMIT 1";
 $result = mysqli_query($mysqli, $sql);
 if (mysqli_num_rows($result) > 0) {
   $lastReport = mysqli_fetch_array($result);
 }
 //SEGNALAZIONI RISOLTE
 $sql = "SELECT COUNT(*) AS TotRisolte 
         FROM segnalazione 
         WHERE Risolta = 1 
         GROUP BY Risolta HAVING TotRisolte > 0";
 $result = mysqli_query($mysqli, $sql);
 if (mysqli_num_rows($result) > 0) {
   $totRisolte = mysqli_fetch_array($result);
   $risolte = $totRisolte["TotRisolte"];
 } else {
   $risolte = 0;
   }
 //MOSTRA IL RIEPILOGO DELLE STATISTICHE DELL'UTENTE
?>
                            <p>Sono state effettuate un totale di <strong><?php echo $reportCount["Tot"]; ?> segnalazioni</strong></p>
                            <p>L&#39;ultima segnalazione effettuata &egrave; avvenuta in data <strong><?php echo $lastReport["DataSegnalazione"]; ?></strong> 
                            alle ore <strong><?php echo $lastReport["OraSegnalazione"]; ?></strong>,
                            per il comune di <strong><?php echo $lastReport["Comune"]; ?></strong>.</p>
                            <p>&Egrave; stata effettuata dall&#39; utente <strong><?php echo $lastReport["User"]; ?></strong>.</p>
                            <p>Il problema segnalato &egrave;: <strong><?php echo $lastReport["TipoSegnalazione"]; ?></strong>.</p>
                            <p>Al momento <?php echo $risolte; ?> segnalazione\i &egrave;\sono stata\e risolta\e.</p>
                        </div>
	                </div>
	                <script src="../../resources/js/administration.js" type="text/javascript"></script>
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