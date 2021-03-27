//FORM
var reportForm = document.getElementById("reportForm");
//PRELEVA IL VALORE DELL'INPUT
var select = document.getElementById("tipoSegnalazione");
var provincia = document.getElementById("provincia");
var paese = document.getElementById("paese");
var nomeStrada = document.getElementById("nomeStrada");
var text = document.getElementById("text");
//PULSANTI AVANTI/INDIETRO
var firstNextBtn = document.getElementById("firstNextBtn");
var prevButton_1 = document.getElementById("prevButton_1");
var nextButton_2 = document.getElementById("nextButton_2");
var prevButton_2 = document.getElementById("prevButton_2");
var sendReport = document.getElementById("sendReport");
//VARIABILI DI ERRORE
var errorSelect = document.getElementById("errorSelect");
var errorProv = document.getElementById("errorProv");
var errorPaese = document.getElementById("errorPaese");
var errorAddress = document.getElementById("errorAddress");
var errorText = document.getElementById("errorText");
//VARIABILE DI CONTROLLO PER IL MATCH
var pos = 0;
//VARIABILI DI CONTROLLO
var verSelect = false;
var verProv = false; 
var verPaese = false;
var verStrada = false;
var verText = false;
//TAB
var tab_0 = document.getElementById("tab_0");
var tab_1 = document.getElementById("tab_1");
var tab_2 = document.getElementById("tab_2");
//PREVIENI L'INVIO DELLA FORM
reportForm.addEventListener("submit", function (event) {
  event.preventDefault();
}, false);
//EVENT LISTENER PER IL CONTROLLO DELL'INPUT
select.addEventListener("click", checkSelect, false);
provincia.addEventListener("keyup", checkProv, false);
paese.addEventListener("keyup", checkPaese, false);
nomeStrada.addEventListener("keyup", checkStrada, false);
text.addEventListener("keyup", checkText, false);
provincia.addEventListener("blur", function () {
  hideSearch("prov");
}, false);
paese.addEventListener("blur", function () {
  hideSearch("paese");
}, false);
//EVENT LISTENER PER IL CONTROLLO DELLE TAB
//PROCEDI CON LA SECONDA TAB
firstNextBtn.addEventListener("click", function () {
  if(verSelect) {
    nextTab(0);
  }
}, false);
//TORNA ALLA PRIMA TAB
prevButton_1.addEventListener("click", function() {
  prevTab(1);
}, false);
//PROCEDI CON LA TERZA TAB
nextButton_2.addEventListener("click", function () {
 if (verProv && verPaese && verStrada) {
   nextTab(1);
 } 
}, false);
//TORNA ALLA SECONDA TAB
prevButton_2.addEventListener("click", function () {
  prevTab(2);
}, false);
//INVIA LA FORM
sendReport.addEventListener("click", function() {
  if(verText) {
    reportForm.submit();
  }
}, false);
//CONTROLLA LA SELECT
function checkSelect() {
  "use strict";
  //PRELIEVA IL VALORE DELLA SELECT
  //SE E' VUOTO -> ERRORE
  if (select.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorSelect.innerHTML = "Seleziona la tipologia di segnalazione";
    //IL CAMPO DIVENTA ROSSO (INVALIDO)
    select.className = "invalid";
    //CONTROLLO -> FALSO
    verSelect = false;
  } else { //ALTRIMENTI
    //CANCELLA MESSAGGIO DI ERRORE
    errorSelect.innerHTML = "";
    //IL CAMPO DIVENTA VERDE (VALIDO)
    select.className = "valid";
    //CONTROLLO -> VERO
    verSelect = true;
  }
  if(verSelect) {
    firstNextBtn.className = "nextBtn";
  } else {
    firstNextBtn.className = "nextBtn disableButton";
  }
}
//CONTROLLA LA PROVINCIA
function checkProv() {
  "use strict";
  liveSearch("prov", provincia.value, "");
  //SE LA PROVINCIA E' VUOTA
  if (provincia.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorProv.innerHTML = "Non puoi lasciare vuoto questo campo";
    //IL CAMPO DIVENTA ROSSO (INVALIDO)
    provincia.className = "invalid";
    //CONTROLLO -> FALSO
    verProv = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = provincia.value.search(/[^a-zA-Z\s\/.,']/g);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorProv.innerHTML = "Il campo deve contenere solo lettere";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      provincia.className = "invalid";
      //CONTROLLO -> FALSO
      verProv = false;
    } else {
      //CANCELLA MESSAGGIO DI ERRORE
      errorProv.innerHTML = "";
      //IL CAMPO DIVENTA ROSSO (INVALIDO)
      provincia.className = "valid";
      //CONTROLLO -> VERO
      verProv = true;
    }
  }
  if(verProv && verPaese && verStrada) {
      nextButton_2.className = "nextBtn";
  } else {
      nextButton_2.className = "nextBtn disableButton";
  }
}
//CONTROLLA IL CAMPO PAESE
function checkPaese() {
  "use strict";
  liveSearch("paese", paese.value, provincia.value);
  if (paese.value === "") {
    //STAMPA MESSAGGIO DI ERRORE
    errorPaese.innerHTML = "Non puoi lasciare vuoto questo campo";
    //IL CAMPO DIVENTA ROSSO (INVALIDO)
    paese.className = "invalid";
    //CONTROLLO -> FALSO
    verPaese = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = paese.value.search(/[^a-zA-Z\s\/.,']/g);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorPaese.innerHTML = "Il camp deve contenere solo lettere";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      paese.className = "invalid";
      //CONTROLLO -> FALSO
      verPaese = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorPaese.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      paese.className = "valid";
      //CONTROLLO -> VERO
      verPaese = true;
    }
  }
  if(verProv && verPaese && verStrada) {
      nextButton_2.className = "nextBtn";
  } else {
      nextButton_2.className = "nextBtn disableButton";
  }
}
//CONTROLLA LA STRADA
function checkStrada () {
  "use strict";
  if (nomeStrada.value === "") {
    //STAMPA MESSAGGIO DI ERRORE
    errorAddress.innerHTML = "Non puoi lasciare vuoto questo campo";
    //IL CAMPO DIVENTA ROSSO (INVALIDO)
    nomeStrada.className = " invalid";
    //CONTROLLO -> FALSO
    verStrada = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = nomeStrada.value.search(/[^a-zA-Z|\s|\/.|,|']/g);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorAddress.innerHTML = "Il nome della strada deve contenere solo lettere";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      nomeStrada.className = "invalid";
      //CONTROLLO -> FALSO
      verStrada = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorAddress.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      nomeStrada.className = "valid";
      //CONTROLLO -> VERO
      verStrada = true;
    }
  }
  if(verProv && verPaese && verStrada) {
      nextButton_2.className = "nextBtn";
  } else {
      nextButton_2.className = "nextBtn disableButton";
  }
}
//CONTROLLA IL TESTO
function checkText () {
  "use strict";
  //SE Il CAMPO E' VUOTO -> ERRORE
  if (text.value === "") {
    //STAMPA MESSAGGIO DI ERRORE
    errorText.innerHTML = "Non puoi lasciare vuoto questo campo";
    //IL CAMPO DIVENTA ROSSO (INVALIDO)
    text.className = " invalid";
    //CONTROLLO -> FALSO
    verText = false;
  } else {
    //CANCELLA MESSAGGIO DI ERRORE
    errorText.innerHTML = "";
    //IL CAMPO DIVENTA VALIDO (VALIDO)
    text.className = " valid";
    //CONTROLLO -> VERO
    verText = true;
  }
  if(verText) {
      sendReport.className = "nextBtn";
  } else {
      sendReport.className = "nextBtn disableButton";
  }
}
//FUNZIONE PER SCORRERE IN AVANTI LE TAB DELLA FORM
function nextTab(currentTab) {
  "use strict";
  //SE LE' LA PRIMA TAB, NASCONDILA E MOSTRA LA SECONDA
  if (currentTab === 0) {
    tab_0.className = "container hidden";
    tab_1.className = "container";
  }
  //SE E' LA SECONDA TAB, NASCONDILA E MOSTRA LA TERZA
  if (currentTab === 1) {
    tab_1.className = "container hidden";
    tab_2.className = "container";
  }
}
//FUNZIONE PER SCORRERE ALL'INDIETRO LE TAB DELLA FORM
function prevTab(currentTab) {
  "use strict";
  //SE E' LA SECONDA TAB NASCONDILA E MOSTRA LA PRIMA
  if (currentTab === 1) {
    tab_1.className = "container hidden";
    tab_0.className = "container";
  }
  //SE E' LA TERZA TAB, NASCONDILA E MOSTRA LA SECONDA
  if (currentTab === 2) {
    tab_2.className = "container hidden";
    tab_1.className = "container";
  }
}