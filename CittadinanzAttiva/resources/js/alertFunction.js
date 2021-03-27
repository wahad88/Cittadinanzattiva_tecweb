//FUNZIONE CHE PRELEVA I PARAMETRI DELL'URL
function getUrlVars() {
  "use strict";
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
    vars[key] = value;
  });
  return vars;
}
//FUNZIONE CHE STAMPA UN MESSAGGIO DI ERRORE/SUCCESSO 
function alertFunction () {
  "use strict";
  //ALERT
  var alertDiv = document.getElementById("alert"); //CONTENITORE ALERT
  var closeX = document.getElementById("closeAlert"); //CHIUDI L'ALERT
  var alertMsg = document.getElementById("alertMessage"); //MESSAGIO ALERT
  //SE LE VARIABILI SONO DEFINITE
  if(alertDiv && alertMsg && closeX) {
    //EVENT LISTENER PER CHIUDERE L'ALERT
    closeX.addEventListener("click", function () {
      alertDiv.className = "alert hidden";
      closeX.tabIndex = "-1";
      closeX.className = "hidden";
      alertMsg.innerHTML = "";
    }, false);
    closeX.addEventListener("keypress", function () {
      alertDiv.className = "alert hidden";
      closeX.tabIndex = "-1";
      closeX.className = "hidden";
      alertMsg.innerHTML = "";
    }, false);
  }
  var query = getUrlVars();
  var title = document.getElementsByTagName("title");
  var page = title[0].innerText;
  //SE I PARAMETRI SONO DEFINITI
  if (query.id || query.status) {
    switch (page) {
      //ALERT PER LA PAGINA CONTATTI
      case "Contatti":
        if (query.status === "200") { //LA RICHIESTA E' STATA INVIATA CORRETTAMENTE
          alertSuccess(alertDiv, closeX); //ALERT VERDE -> SUCCESSO
          alertMsg.innerHTML = "La tua richiesta &egrave; stata \
          inviata correttamente.";
        } else { //ERRORE INTERNO, NON E' STATA INVIATA LA RICHIESTA
          alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
          alertMsg.innerHTML = "Non &egrave; stato possibile inviare la tua \
          richiesta. Riprova pi&ugrave; tardi.";
        }
        break;
      //ALERT PER LA PAGINA OPZIONI UTENTE
      case "Opzioni Utente":
        switch (query.id) {
          //CAMBIO USERNAME
          case "user":
            if (query.status === "200") { //LO USERNAME E' STATO CAMBIATA
              alertSuccess(alertDiv, closeX); //ALERT VERDE -> SUCCESSO
              alertMsg.innerHTML = "Lo Username &egrave; stato cambiato correttamente.";
            } else { //ERRORE INTERNO, NON E' STATO CAMBIATA L'EMAIL
              alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
              alertMsg.innerHTML = "Non &egrave; stato possibile cambiare lo \
              Username. Riprova pi&ugrave; tardi.";
            }
            break;
          //CAMBIO PASSWORD  
          case "pwd":
            switch (query.status) {
              case "200": //LA PASSWORD E' STATA CAMBIATA CORRETTAMENTE
                alertSuccess(alertDiv, closeX); //ALERT VERDE -> SUCCESSO
                alertMsg.innerHTML = "La Password &egrave; stata cambiata \
                correttamente.";
                break;
              case "500": //ERRORE INTERNO, LA PWD NON E' STATA CAMBIATA
                alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
                alertMsg.innerHTML = "Non &egrave; stato possibile cambiare la \
                Password. Riprova pi&ugrave; tardi.";
                break;
              case "404": //ERRORE DELL'UTENTE, LA PWD NON CORRISPONDE
                alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
                alertMsg.innerHTML = "La Password inserita nel campo &quot;Vecchia \
                Password&quot; non corrisponde con quella presente nel database.";
                break;
              case "403": //ERRORE DELL'UTENTE, NON HA INSERITO UNA NUOVA PASSWORD
                alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
                alertMsg.innerHTML = "Non hai inserito una nuova password.";
                break;
            }
            break;
          //CAMBIO EMAIL
          case "email":
            if (query.status === "200") { //L'EMAIL E' STATA CAMBIATA
              alertSuccess(alertDiv, closeX); //ALERT VERDE -> SUCCESSO
              alertMsg.innerHTML = "L&#39;email &egrave; stata cambiata correttamente.";
            } else { //ERRORE INTERNO, NON E' STATO CAMBIATA L'EMAIL
              alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
              alertMsg.innerHTML = "Non &egrave; stato possibile cambiare l&#39;\
              email. Riprova pi&ugrave; tardi.";
            }
            break;
        }
        break;
      case "Servizi":
        if (query.status === "200") { //LA SEGNALAZIONE E' STATA INVIATA CORRETTAMENTE
          alertSuccess(alertDiv, closeX); //ALERT VERDE -> SUCCESSO
          alertMsg.innerHTML = "La tua segnalazione &egrave; stata \
          inviata correttamente.";
        } else { //ERRORE INTERNO, NON E' STATA INVIATA LA SEGNALAZIONE
          alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
          alertMsg.innerHTML = "Non &egrave; stato possibile inviare la tua \
          segnalazione. Riprova pi&ugrave; tardi.";
        }
        break;
      case "Login":
        if (query.status === "404") {
          alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
          alertMsg.innerHTML = "Username o Password errati";
        }
        break;
    }
  }
}
function alertSuccess (alertDiv, closeX) {
  "use strict";
  alertDiv.className = "alert success";
  closeX.tabIndex = "0";
  closeX.className = "closeAlert";
}
function alertFailed (alertDiv, closeX) {
  "use strict";
  alertDiv.className = "alert failed";
  closeX.tabIndex = "0";
  closeX.className = "closeAlert";
}