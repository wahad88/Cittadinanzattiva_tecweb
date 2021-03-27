window.onload = function () {
  var query = getUrlVars();
  var alertDiv = document.getElementById("alert"); //CONTENITORE ALERT
  var closeX = document.getElementById("closeAlert"); //CHIUDI L'ALERT
  var alertMsg = document.getElementById("alertMessage"); //MESSAGIO ALERT
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
  if (query) {
    switch (query.id) {
      case "divMessaggi":
        showTab(3);
        break;
      case "request":
        if (query.status === "200") { //IL FEEDBACK E' STATO ELIMINATO CORRETTAMENTE
          alertSuccess(alertDiv, closeX); //ALERT VERDE -> SUCCESSO
          alertMsg.innerHTML = "Il feedback &egrave; stato \
          eliminato correttamente.";
        } else { //ERRORE INTERNO, NON E' STATO ELIMINATO IL FEEDBACK
          alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
          alertMsg.innerHTML = "Non &egrave; stato possibile eliminare il \
          feedback. Riprova pi&ugrave; tardi.";
        }
        break;
      case "submitNews":
        if (query.status === "200") { //LA NEWS E'STATA CARICATA
          alertSuccess(alertDiv, closeX); //ALERT VERDE -> SUCCESSO
          alertMsg.innerHTML = "La news &egrave; stata caricata correttamente.";
        } else { //ERRORE INTERNO, LA NEWS NON E' STATA CARICATA 
          alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
          alertMsg.innerHTML = "Non &egrave; stato possibile caricare la \
          news. Riprova pi&ugrave; tardi.";
        }
        break;
      case "deleteNews":
        if (query.status === "200") { //LA NEWS E' STATA ELIMINATA  
          alertSuccess(alertDiv, closeX); //ALERT VERDE -> SUCCESSO
          alertMsg.innerHTML = "La news &egrave; stata eliminata correttamente.";
        } else { //ERRORE INTERNO, NON E' STATA ELIMINATA LA NEWS
          alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
          alertMsg.innerHTML = "Non &egrave; stato possibile eliminare la \
          news. Riprova pi&ugrave; tardi.";
        }
        break;
      case "msg":
        if (query.status === "200") { //IL MESSAGGIO E' STATO INVIATO
          alertSuccess(alertDiv, closeX); //ALERT VERDE -> SUCCESSO
          alertMsg.innerHTML = "Il messaggio &egrave; stato inviato correttamente.";
        } else { //ERRORE INTERNO, NON E' STATO INVIATO IL MESSAGGIO
          alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
          alertMsg.innerHTML = "Non &egrave; stato possibile inviare il \
          messaggio. Riprova pi&ugrave; tardi.";
        }
        break;
      case "deleteNews":
        if (query.status === "200") { //LA NEWS E' STATA ELIMINATA  
          alertSuccess(alertDiv, closeX); //ALERT VERDE -> SUCCESSO
          alertMsg.innerHTML = "La news &egrave; stata eliminata correttamente.";
        } else { //ERRORE INTERNO, NON E' STATA ELIMINATA LA NEWS
          alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
          alertMsg.innerHTML = "Non &egrave; stato possibile eliminare la \
          news. Riprova pi&ugrave; tardi.";
        }
        break;
      case "deleteReport":
        if (query.status === "200") { //LA SEGNALAZIONE E' STATA ELIMINATA
          alertSuccess(alertDiv, closeX); //ALERT VERDE -> SUCCESSO
          alertMsg.innerHTML = "La segnalazione &egrave; stata eliminata correttamente.";
        } else { //ERRORE INTERNO, NON E' STATA ELIMINATA LA SEGNALAZIONE
          alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
          alertMsg.innerHTML = "Non &egrave; stato possibile eliminare la \
          segnalazione. Riprova pi&ugrave; tardi.";
        }
        break;
      case "editReport":
        if (query.status === "200") { //LA SEGNALAZIONE E' STATA RISOLTA
          alertSuccess(alertDiv, closeX); //ALERT VERDE -> SUCCESSO
          alertMsg.innerHTML = "Lo stato della  segnalazione &egrave; \
          stato modificato correttamente.";
        } else { //ERRORE INTERNO, NON E' STATA RISOLTA LA SEGNALAZIONE
          alertFailed(alertDiv, closeX); //ALERT ROSSO -> FALLIMENTO
          alertMsg.innerHTML = "Non &egrave; stato possibile modificare lo \
          stato della segnalazione. Riprova pi&ugrave; tardi.";
        }
        break;
    }
  }
};
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
//FUNZIONE PER MOSTRARE LE OPZIONI UTENTE
function showTab (currentTab) {
  "use strict";
  //PULSANTI
  var divButton = document.getElementsByClassName("userOption");
  var button = divButton[0].getElementsByTagName("button");
  //SCHEDE
  var divOption = document.getElementsByClassName("userOptionCover");
  var divScheda = divOption[0].childNodes;
  //VARIABILE PER IL CICLO FOR
  var i = 0;
  var j = 0;
  //CICLO PER MOSTRARE IL NOME DELLA SCHEDA CORRENTE
  for (i = 1; i < 6; i += 2) {
    if (i === currentTab) {
      button[j].className = "activeButton";
    } else {
      button[j].className = "useless";
    }
    j += 1;
  }
  //CICLO PER MOSTRARE LA SCHEDA SELEZIONATA
  for (i = 1; i < 6; i += 2) {
    if (i === currentTab) {
      divScheda[i].className = "divScheda";
    } else {
      divScheda[i].className = "hidden";
    }
  }
}
//FUNZIONE PER MOSTRARE LE OPZIONI DI MODIFICA
function showOption(option) {
  "use strict";
  var div = document.getElementById("datiPersonali");
  var li = div.getElementsByTagName("ul")[0].children;
  var i = 0;
  //MOSTRA LA FORM RICHIESTA E NASCONDI QUELLA VECCHIA
  for (i = 1; i < 6; i += 1) {
    if (i === option) {
      div.children[i].className = "changeForm administration";
    } else {
      div.children[i].className = "hidden";
    }
  }
  //CAMBIA IL COLORE DEL BOTTONE DELLA SCHEDA ATTIVA
  option -= 1;
  for (i = 0; i < 5; i += 1) {
    if (i === option) {
      li[i].className = "activeOption";
    } else {
      li[i].className = "useless";
    }
  }
}
//FUNZIONE CHE MOSTRA IL MESSAGGIO SELEZIONATO
function openRequest(id) {
  "use strict";
  var link = "../request/?requestId=" + id;
  window.open(link, "_self");
}
//FUNZIONE CHE MOSTRA IL MESSAGGIO SELEZIONATO (CASO KEYPRESS)
function openRequestPress(id, event) {
  "use strict";
  if(event.which === 13) {
    openMessage(id);
  }
}
//FUNZIONE CHE PRELEVA I PARAMETRI DELL'URL
function getUrlVars() {
  "use strict";
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
    vars[key] = value;
  });
  return vars;
}