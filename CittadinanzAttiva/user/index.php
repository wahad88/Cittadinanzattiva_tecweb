<?php
  session_start();
  if (empty($_SESSION["userId"])) {
    header("Location: ../");
    die("Ti stiamo reindirizzando alla pagina principale");
  } else if ($_SESSION["userLevel"] == 65) {
      header("Location: admin/");
      die();
  } else {
    //CONNETTITI AL DATABASE
    include("../resources/php/database/config.php");
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
  }
?>
<!--OPZIONI UTENTE-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
    <head>
        <title>Opzioni Utente</title>
		<meta charset="utf-8" />
		<meta name="description" content="Opzioni utente" />
		<meta name="keywords" content="comuni, cittadini, attiva" />
		<meta name="author" content="Elia Vettoretto, Abdelwahad Kandoul, Luigi Perin" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="../resources/stylesheet/core.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../resources/stylesheet/form.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../resources/stylesheet/user.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../resources/stylesheet/mobile.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../resources/stylesheet/print.css" rel="stylesheet" type="text/css" media="print" />
		<link href="../resources/stylesheet/fonts/Exo.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../favicon.ico" rel="shortcut icon" type="image/x-icon" media="all" />
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
				<span class="burger-menu" id="burger-menu" onclick="showMenu()"></span>
                <p id="breadcrumb" class="breadcrumb">Home &rsaquo; <strong>Opzioni Utente</strong></p>
	            <div id="userNav" class="userNav">
	                <span><?php echo $_SESSION['userName']; ?></span>
                </div>
            </div>
            <div class="wrapper">
	            <div class="general">
	                <div id="alert" class="alert hidden">
	                    <span id="closeAlert" class="closeAlert hidden">&times;</span>
	                    <p id="alertMessage"></p>
	                </div>
	                <h2>Benvenuto nella tua area personale</h2>
	                <h3>Da qui puoi modificare i tuoi dati, leggere i messaggi, e reimpostare le tue informazioni di contatto</h3>
	                <div class="userOption">
	                    <button type="button" class="activeButton" title="Modifica/Aggiorna i tuoi dati personali" onclick="showTab(1)"
	                    tabindex="5">Dati personali</button>
	                    <button type="button" title="Leggi i messaggi" onclick="showTab(3)" tabindex="6">Messaggi</button>
	                    <button type="button" title="Visualizza le tue statistiche" onclick="showTab(5)" tabindex="7">Riepilogo</button>
	                </div>
	                <div class="userOptionCover">
	                    <div id="datiPersonali" class="divScheda">
                            <div class="subNav">
                                <ul>
                                    <li class="activeOption" onclick="showOption(1)" tabindex="8">Modifica <span lang="en" xml:lang="en">Username</span></li>
                                    <li class="useless" onclick="showOption(2)" tabindex="9">Modifica Password</li>
                                    <li class="useless" onclick="showOption(3)" tabindex="10">Modifica Email</li>
                                </ul>
                            </div>
                            <div id="username" class="changeForm">
                                <form id="changeUser" method="post" action="../resources/php/form/changeUserData.php" >
                                    <fieldset>
                                        <legend>Modifica <span lang="en" xml:lang="en">Username</span></legend>
                                        <label for="oldUser" class="firstLabel">Vecchio Username</label>
                                        <input type="text" name="oldUser" id="oldUser" class="firstInput" 
                                        autocomplete="username" placeholder="Vecchio Utente" required="required" />
                                        <p id="errorOldUser" class="errorField firstError"></p>
                                        <label for="newUser" class="secondLabel">Nuovo Username</label>
                                        <input type="text" name="newUser" id="newUser" class="secondInput" 
                                        autocomplete="new-username" placeholder="Nuovo Utente" required="required" />
                                        <p id="errorNewUser" class="errorField secondError"></p>
                                        <button type="submit" id="submitUser" class="disableButton">Cambia Username</button>
                                    </fieldset>
                                </form>
                            </div>
                            <div id="pwd" class="hidden">
                                <form id="changePwd" method="post" action="../resources/php/form/changeUserData.php">
                                    <fieldset>
                                        <legend>Modifica Password</legend>
                                        <label for="oldPassword" class="firstLabel">Vecchia Password</label>
                                        <input type="password" name="oldPassword" id="oldPassword" class="firstInput" 
                                        autocomplete="password" placeholder="Vecchia Password" required="required" />
                                        <p id="errorOldPwd" class="errorField firstError"></p>
                                        <label for="newPassword" class="secondLabel">Nuova Password</label>
                                        <input type="password" name="newPassword" id="newPassword" class="secondInput" 
                                        autocomplete="new-password" placeholder="Nuova Password" required="required" />
                                        <p id="errorNewPwd" class="errorField secondError"></p>
                                        <button type="submit" id="submitPwd" class="disableButton">Cambia Password</button>
                                    </fieldset>
                                </form>
                            </div>
                            <div id="email" class="hidden">
                                <form id="changeEmail" method="post" action="../resources/php/form/changeUserData.php" >
                                    <fieldset>
                                        <legend>Modifica l&#39;email</legend>
                                        <label for="oldEmail" class="firstLabel">Vecchia email</label>
                                        <input type="email" name="oldEmail" id="oldEmail" class="firstInput" 
                                        autocomplete="email" placeholder="Vecchia Email" required="required" onkeyup="verifyOldEmail()" />
                                        <p id="errorOldEmail" class="errorField firstError"></p>
                                        <label for="newEmail" class="secondLabel">Nuova email</label>
                                        <input type="email" name="newEmail" id="newEmail" class="secondInput" 
                                        autocomplete="new-email" placeholder="Nuova Email" required="required" onkeyup="verifyNewEmail()" />
                                        <p id="errorNewEmail" class="errorField secondError"></p>
                                        <button type="submit" id="submitEmail" class="disableButton">Cambia email</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        <div id="divMessaggi" class="hidden">
                            <table id="messageTable" title="Tabella dei messaggi">
                                <caption>Qui vengono riportati tutti i messaggi ricevuti</caption>
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
  //PREPARA LA QUERY PER CERCARE I MESSAGGI
  $sql = "SELECT IdMessaggio, User, Testo, Letto FROM messaggi JOIN utente
          ON utente.ID = messaggi.Mittente WHERE Destinatario = $userId ORDER BY IdMessaggio DESC;";  
  //EFFETUA LA QUERY
  $result = mysqli_query($mysqli, $sql);
  //SE LA QUERY HA PRODOTTO UN RISULTATO
  if (mysqli_num_rows($result) > 0) {
  //STAMPA LE RIGHE DELLA TABELLA
    while ($row = mysqli_fetch_array($result)) {
      $count = 9;
      //MOSTRA SOLO I PRIMI 50 CARATTERI DEL MESSAGGIO
      $sub = substr($row["Testo"], 0, 50);
?>                                  <tr onclick="openMessage(<?php echo $row["IdMessaggio"]; ?>)" 
                                        onkeypress="openMessagePress(<? echo $row["IdMessaggio"]; ?>, event)" 
                                        tabindex="<? echo $count; ?>">
                                        <td headers="mittente" class="width-20"><?php echo $row["User"]; ?></td>
                                        <td headers="messaggio"><?php echo $sub; ?>...</td>
                                        <td headers="letto" class="width-20"><?php echo $row["Letto"]; ?></td>
<?php
      $count += 1;
    }
  } else {
?>
                                    <tr>
                                        <td headers="mittente messaggio letto" class="width-50" colspan="3">Non ci sono messaggi</td>
                                    </tr>
<?php
  }
?>
                                </tbody>
                            </table>
                        </div>
                        <div id="statistics" class="hidden">
                            <h4 id="statistics-h4">Le tue statistiche</h4>
<?php
  //NUMERO DI SEGNALAZIONI EFFETTUATE
  $sql = "SELECT COUNT(IDSegnalazione) AS Tot FROM segnalazione WHERE IDUtente = $userId;";
  $result = mysqli_query($mysqli, $sql);
  if (mysqli_num_rows($result) > 0) {
    $reportCount = mysqli_fetch_array($result);
  }
  //ULTIMA SEGNALAZIONE EFFETTUATA
  $sql = "SELECT TipoSegnalazione, Comune, DataSegnalazione, OraSegnalazione 
  FROM segnalazione WHERE IDUtente = $userId 
  ORDER BY DataSegnalazione DESC LIMIT 1";
  $result = mysqli_query($mysqli, $sql);
  if (mysqli_num_rows($result) > 0) {
    $lastReport = mysqli_fetch_array($result);
  }
  //SEGNALAZIONI RISOLTE
  $sql = "SELECT COUNT(*) AS TotRisolte 
  FROM segnalazione WHERE IDUtente = $userId 
  AND Risolta = 1 GROUP BY Risolta HAVING TotRisolte > 0";
  $result = mysqli_query($mysqli, $sql);
  if (mysqli_num_rows($result) > 0) {
    $totRisolte = mysqli_fetch_array($result);
    $risolte = $totRisolte["TotRisolte"];
  } else {
    $risolte = 0;
  }
  //MOSTRA IL RIEPILOGO DELLE STATISTICHE DELL'UTENTE
?>
                            <p>Hai effettuato un totale di <strong><?php echo $reportCount["Tot"]; ?> segnalazione/i</strong></p>
                            <p>L&#39;ultima segnalazione che hai effettuato &egrave; avvenuta in data <strong><?php echo $lastReport["DataSegnalazione"]; ?></strong> 
                            alle ore <strong><?php echo $lastReport["OraSegnalazione"]; ?></strong>,
                            per il comune di <strong><?php echo $lastReport["Comune"]; ?></strong>.</p>
                            <p>Il problema che hai segnalato &egrave;: <strong><?php echo $lastReport["TipoSegnalazione"]; ?></strong>.</p>
                            <p>Al momento <?php echo $risolte ?> delle tue segnalazioni sono state risolte.</p>
                        </div>
	                </div>
	                <script src="../resources/js/userOption.js" type="text/javascript"></script>
                </div>
	        </div>
            <div class="footer">
				<div class="utility">
					<a href="../sitemap/" title="Vai alla mappa del sito">Mappa del sito</a>
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