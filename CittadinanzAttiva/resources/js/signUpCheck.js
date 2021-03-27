/*PRELEVA GLI ELEMENTI*/
//FORM
var regForm = document.getElementById("regForm");
//TAB 1
var tab_0 = document.getElementById("tab_0");
var nome = document.getElementById("nome");
var cognome = document.getElementById("cognome");
var cf = document.getElementById("cf");
var data = document.getElementById("date");
//TAB 2
var tab_1 = document.getElementById("tab_1");
var indirizzo = document.getElementById("indirizzo");
var civico = document.getElementById("civico");
var paese = document.getElementById("paese");
var provincia = document.getElementById("provincia");
//TAB 3
var tab_2 = document.getElementById("tab_2");
var telefono = document.getElementById("telefono");
var cellulare = document.getElementById("cellulare");
var email = document.getElementById("email");
//TAB 4
var tab_3 = document.getElementById("tab_3");
var regUsername = document.getElementById("regUsername");
var regPassword = document.getElementById("regPassword");
var cofPassword = document.getElementById("cofPassword");
//VARIABILI DI CONTROLLO
var verNome = false;
var verCognome = false;
var verCF = false;
var verData = false;
var verAddress = false;
var verCivico = false;
var verComune = false;
var verProv = false;
var verTel = false;
var verCell = false;
var verEmail = false;
var verUser = false;
var verPwd = false;
var verCofPwd = false;
//PREVIENI L'INVIO DELLA FORM
regForm.addEventListener("submit", function (event) {
  event.preventDefault();
}, false);
//EVENT LISTENER PER IL CONTROLLO DELL'INPUT
nome.addEventListener("keyup", checkNome, false);
cognome.addEventListener("keyup", checkCognome, false);
cf.addEventListener("keyup", checkCF, false);
data.addEventListener("keyup", checkData, false);
indirizzo.addEventListener("keyup", checkAddress, false);
civico.addEventListener("keyup", checkCivico, false);
paese.addEventListener("keyup", checkComune, false);
provincia.addEventListener("keyup", checkProv, false);
telefono.addEventListener("keyup", checkTel, false);
cellulare.addEventListener("keyup", checkCell, false);
email.addEventListener("keyup", checkEmail, false);
regUsername.addEventListener("keyup", checkUser, false);
regPassword.addEventListener("keyup", checkPwd, false);
cofPassword.addEventListener("keyup", checkCofPwd, false);
//PULSANTI
var firstNextBtn = document.getElementById("firstNextBtn");
var nextButton_2 = document.getElementById("nextButton_2");
var nextButton_3 = document.getElementById("nextButton_3");
var sendForm = document.getElementById("sendForm");
var prevButton_1 = document.getElementById("prevButton_1"); 
var prevButton_2 = document.getElementById("prevButton_2");
var prevButton_3 = document.getElementById("prevButton_3");
//PROCEDI CON LA SECONDA TAB
firstNextBtn.addEventListener("click", function () {
  if(verNome && verCognome && verData && verCF) {
    nextTab(0);
  } else {
    console.log(false);
  }
}, false);
//PROCEDI CON LA TERZA TAB
nextButton_2.addEventListener("click", function () {
 if (verProv && verComune && verCivico && verAddress) {
   nextTab(1);
 } 
}, false);
//PROCEDI CON LA QUARTA TAB
nextButton_3.addEventListener("click", function () {
 if (verCell && verEmail) {
   nextTab(2);
 }
}, false);
//INVIA LA FORM
sendForm.addEventListener("click", function() {
  if (verUser && verPwd && verCofPwd) {
    regForm.submit();
  }
}, false);
//TORNA ALLA PRIMA TAB
prevButton_1.addEventListener("click", function () {
  prevTab(0);
}, false);
//TORNA ALLA SECONDA TAB
prevButton_2.addEventListener("click", function () {
  prevTab(1);
}, false);
//TORNA ALLA TERZA TAB
prevButton_2.addEventListener("click", function () {
  prevTab(2);
}, false);
/*VARIABILI PER IL DISPLAY DEGLI ERRORI*/
var errorName = document.getElementById("errorName");
var errorSurname = document.getElementById("errorSurname");
var errorCf = document.getElementById("errorCf");
var errorData = document.getElementById("errorData");
var errorAddress = document.getElementById("errorAddress");
var errorCivico = document.getElementById("errorCivico");
var errorPaese = document.getElementById("errorPaese");
var errorProv = document.getElementById("errorProv");
var errorTel = document.getElementById("errorTel");
var errorCell = document.getElementById("errorCell");
var errorEmail = document.getElementById("errorEmail");
var errorUser = document.getElementById("errorUser");
var errorPwd = document.getElementById("errorPwd");
var errorCofPwd = document.getElementById("errorCofPwd");
/*POS = VARIABILE CHE TIENE IL RISULTATO DEL MATCH DELL'INPUT CON LA REGEX*/
var pos = 0;
/*SALVA SPAZIO*/
var voidField = "Non puoi lasciare vuoto questo campo";
var onlyLetter = " deve contenere solo lettere";
//FUNZIONE PER PULIRE L'INPUT
function clearInput(tab) {
  "use strict";
  //TAB 0
  switch (tab) {
    case 0:
	  //RESETTA L'INPUT
      nome.value = "";
      cognome.value = "";
      data.value = "";
      cf.value = "";
      //RESETTA IL MESSAGGIO DI ERRORE
      errorName.innerHTML = "";
      errorSurname.innerHTML = "";
      errorData.innerHTML = "";
      errorCf.innerHTML = "";
      //RESETTA LA CLASSE CSS DELL'INPUT
      nome.className = "useless";
      cognome.className = "useless";
      data.className = "useless";
      cf.className = "useless";
      break;
    case 1:
      //RESETTA L'INPUT
      indirizzo.value = "";
      civico.value = "";
      paese.value = "";
      provincia.value = "";
      //RESETTA IL MESSAGGIO DI ERRORE
      errorAddress.innerHTML = "";
      errorCivico.innerHTML = "";
      errorPaese.innerHTML = "";
      errorProv.innerHTML = "";
      //RESETTA LA CLASSE CSS DELL'INPUT
      indirizzo.className = "useless";
      civico.className = "useless";
      paese.className = "useless";
      provincia.className = "useless";
      break;
    case 2:
      //RESETTA L'INPUT
      telefono.value = "";
      cellulare.value = "";
      email.value = "";
      //RESETTA IL MESSAGGIO DI ERRORE
      errorTel.innerHTML = "";
      errorCell.innerHTML = "";
      errorEmail.innerHTML = "";
      //RESETTA LA CLASSE CSS DELL'INPUT
      telefono.className = "useless";
      cellulare.className = "useless";
      email.className = "useless";
      break;
    case 3:
      //RESETTA L'INPUT
      regUsername.value = "";
      regPassword.value = "";
      cofPassword.value = "";
      //RESETTA IL MESSAGGIO DI ERRORE
      errorUser.innerHTML = "";
      errorPwd.innerHTML = "";
      errorCofPwd.innerHTML = "";
      //RESETTA LA CLASSE CSS DELL'INPUT
	  regUsername.className = "useless";
      regPassword.className = "useless";
      cofPassword.className = "useless";
      break;
  }
}
//FUNZIONE PER SCORRERE ALL'INDIETRO LE TAB DELLA FORM
function prevTab(currentTab) {
  "use strict";
  switch (currentTab) {
    //SE E' LA SECONDA TAB NASCONDILA E MOSTRA LA PRIMA
    case 0:
      tab_1.className = "container hidden";
      tab_0.className = "container";
      break;
    //SE E' LA TERZA TAB, NASCONDILA E MOSTRA LA SECONDA
    case 1:
      tab_2.className = "container hidden";
      tab_1.className = "container";
      break;
    //SE E' LA QUARTA TAB, NASCONDILA E MOSTRA LA TERZA
    case "2":
      tab_3.className = "container hidden";
      tab_2.className = "container";
      break;
  }
}
//FUNZIONE PER SCORRERE IN AVANTI LE TAB DELLA FORM
function nextTab(currentTab) {
  "use strict";
  switch (currentTab) {
    //SE LE' LA PRIMA TAB, NASCONDILA E MOSTRA LA SECONDA
    case 0:
      tab_0.className = "container hidden";
      tab_1.className = "container";
      break;
    //SE E' LA SECONDA TAB, NASCONDILA E MOSTRA LA TERZA
    case 1:
      tab_1.className = "container hidden";
      tab_2.className = "container";
      break;
    //SE E' LA TERZA TAB, NASCONDILA E MOSTRA LA QUARTA
    case 2:
      tab_2.className = "container hidden";
      tab_3.className = "container";
      break;
  }
}
//FUNZIONE DI CONTROLLO DELL'INPUT
function checkNome() {
  "use strict";
  //NOME
  //SE VUOTO -> ERRORE
  if (nome.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorName.innerHTML = voidField;
    //IL CAMPO DIVENTA ROSSO (INVALIDO)
    nome.className = "invalid";
    //CONTROLLO -> FALSO
    verNome = false;
  } else {
  //L'INPUT MATCHA LA REGEX?
    pos = nome.value.search(/[^a-zA-Z|\s|']/g);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorName.innerHTML = "Il nome" + onlyLetter;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      nome.className = "invalid";
      //CONTROLLO -> FALSO
      verNome = false;
    } else { //ALTRIMENTI OK
      //CANCELLA MESSAGGIO D'ERRORE
      errorName.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      nome.className = "valid";
      //CONTROLLO -> VERO
      verNome = true;
    }
  }
  if(verNome && verCognome && verData && verCF) {
    firstNextBtn.className = "nextBtn";
  } else {
    firstNextBtn.className = "nextBtn disableButton";
  }
}
//COGNOME
function checkCognome() {
  "use strict";
  //SE VUOTO -> ERRORE
  if (cognome.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorSurname.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    cognome.className = "invalid";
    verCognome = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = cognome.value.search(/[^a-zA-Z|\s|']/g);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorSurname.innerHTML = "Il cognome" + onlyLetter;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      cognome.className = "invalid";
      //CONTROLLO -> FALSO
      verCognome = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorSurname.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      cognome.className = "valid";
      //CONTROLLO -> FALSO
      verCognome = true;
    }
  }
  if(verNome && verCognome && verData && verCF) {
    firstNextBtn.className = "nextBtn";
  } else {
    firstNextBtn.className = "nextBtn disableButton";
  }
}
//CODICE FISCALE
function checkCF() {
  "use strict";
  //SE VUOTO -> ERRORE
  if (cf.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorCf.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    cf.className = "invalid";
    //CONTROLLO -> FALSO
    verCF = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = cf.value.search(/^[A-Z]{6}\d{2}[A-Z]{1}\d{2}[A-Z]{1}\d{3}[A-Z]$/);
    //SE SEARCH != 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos !== 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorCf.innerHTML = "Codice Fiscale Errato";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      cf.className = "invalid";
      //CONTROLLO -> FALSO
      verCF = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorCf.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      cf.className = "valid";
      //CONTROLLO -> VERO
      verCF = true;
    }
  }
  if(verNome && verCognome && verData && verCF) {
    firstNextBtn.className = "nextBtn";
  } else {
    firstNextBtn.className = "nextBtn disableButton";
  }
}
//DATA
function checkData() {
  "use strict";
  //SE VUOTA -> ERRORE
  if (data.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorData.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    data.className = "invalid";
    //CONTROLLO -> FALSO
    verData = false;
  } else {
    var regs = data.value.match(/^(\d{4})\-(\d{1,2})\-(\d{1,2})$/);
    //SE L'ANNO INSERITO SUPERA LE 4 CIFRE
    if(regs === null) {
      //STAMPA MESSAGGIO D'ERRORE
      errorData.innerHTML = "Inserisci un anno compreso tra il 1900 ed il 2001";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      data.className = "invalid";
      //CONTROLLO -> FALSO
      verData = false;
    } else if (regs[1] < 1900 || regs[1] > 2001) { //CONTROLLA SE L'ANNO E' COMPRESO TRA IL 1900 E IL 2001
      //STAMPA MESSAGGIO D'ERRORE
      errorData.innerHTML = "Inserisci un anno compreso tra il 1900 ed il 2001";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      data.className = "invalid";
      //CONTROLLO -> FALSO
      verData = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorData.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      data.className = "valid";
      //CONTROLLO -> VERO
      verData = true;
    }
  }
  if(verNome && verCognome && verData && verCF) {
    firstNextBtn.className = "nextBtn";
  } else {
    firstNextBtn.className = "nextBtn disableButton";
  }
}
//INDIRIZZO
function checkAddress() {
  "use strict";
  //SE VUOTO -> ERRORE
  if (indirizzo.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorAddress.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    indirizzo.className = "invalid";
    //CONTROLLO -> FALSO
    verAddress = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = indirizzo.value.search(/[^a-zA-Z|\s|\/.|,|']/g);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorAddress.innerHTML = "L'indirizzo" + onlyLetter;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      indirizzo.className = "invalid";
      //CONTROLLO -> FALSO
      verAddress = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorAddress.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      indirizzo.className = "valid";
      //CONTROLLO -> VERO
      verAddress = true;
    }
  }
  if(verProv && verComune && verCivico && verAddress) {
    nextButton_2.className = "nextBtn";
  } else {
    nextButton_2.className = "nextBtn disableButton";
  }
}
//CIVICO
function checkCivico() {
  "use strict";
  //SE VUOTO -> ERRORE
  if (civico.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorCivico.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    civico.className = "invalid";
    //CONTROLLO -> FALSO
    verCivico = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = civico.value.search(/[0-9][\\]*[\/]*[a-zA-Z]*/g);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos !== 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorCivico.innerHTML = "Il civico deve contenere solo numeri";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      civico.className = "invalid";
      //CONTROLLO -> FALSO
      verCivico = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorCivico.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      civico.className = "valid";
      //CONTROLLO -> VERO
      verCivico = true;
    }
  }
  if(verProv && verComune && verCivico && verAddress) {
    nextButton_2.className = "nextBtn";
  } else {
    nextButton_2.className = "nextBtn disableButton";
  }
}
//COMUNE
function checkComune() {
  "use strict";
  //SE VUOTO -> ERRORE
  if (paese.value === "") {
    errorPaese.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    paese.className = "invalid";
    //CONTROLLO -> FALSO
    verComune = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = paese.value.search(/[^a-zA-Z\s\/.,']/g);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorPaese.innerHTML = "Il campo" + onlyLetter;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      paese.className = "invalid";
      //CONTROLLO -> FALSO
      verComune = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorPaese.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      paese.className = "valid";
      //CONTROLLO -> VERO
      verComune = true;
    }
  }
  if(verProv && verComune && verCivico && verAddress) {
    nextButton_2.className = "nextBtn";
  } else {
    nextButton_2.className = "nextBtn disableButton";
  }
}
//PROVINCIA
function checkProv() {
  "use strict";
  //SE VUOTO -> ERRORE
  if (provincia.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorProv.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    provincia.className = "invalid";
    //CONTROLLO -> FALSO
    verProv = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = provincia.value.search(/[^a-zA-Z\s\/.,']/g);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorProv.innerHTML = "Il campo" + onlyLetter;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      provincia.className = "invalid";
      //CONTROLLO -> FALSO
      verProv = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorProv.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      provincia.className = "valid";
      //CONTROLLO -> VERO
      verProv = true;
    }
  }
  if(verProv && verComune && verCivico && verAddress) {
    nextButton_2.className = "nextBtn";
  } else {
    nextButton_2.className = "nextBtn disableButton";
  }
}
//TELEFONO
function checkTel() {
  "use strict";
  //IL CAMPO PUO' ESSERE VUOTO
  //SE IMMESSO CONTROLLA CHE SIA VALIDO
  if (telefono.value !== "") {
    //L'INPUT MATCHA LA REGEX?
    pos = telefono.value.search(/[^0-9]/);
    //SE POS >= 0 L'INPUT IMMESSO E' ERRATO
    if (pos >= 0) {
      //STAMPA MESSAGGIO DI ERRORE
      errorTel.innerHTML = "Inserisci un numero di telefono valido";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      telefono.className = "valid";
      //CONTROLLO -> FALSO
      verTel = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorTel.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      telefono.className = "valid";
      //CONTROLLO -> VERO
      verTel = true;
    }
  } else { 
      //SE NON VIENE IMMESSO NESSUN NUMERO METTI CONTROLLO A VERO
      verTel = true;
  }
  if(verCell && verEmail) {
    nextButton_3.className = "nextBtn";
  } else {
    nextButton_3.className = "nextBtn disableButton";
  }
}
//CELLULARE
function checkCell() {
  "use strict";
  //SE VUOTO -> ERRORE
  if (cellulare.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorCell.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    cellulare.className = "invalid";
    //CONTROLLO -> FALSO
    verCell = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = cellulare.value.search(/[^0-9]/);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorCell.innerHTML = "Inserisci un numero di cellulare valido";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      cellulare.className = "invalid";
      //CONTROLLO -> FALSO
      verCell = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorCell.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      cellulare.className = "valid";
      //CONTROLLO -> VERO
      verCell = true;
    }
  }
  if(verCell && verEmail) {
    nextButton_3.className = "nextBtn";
  } else {
    nextButton_3.className = "nextBtn disableButton";
  }
}
//EMAIL
function checkEmail() {
  "use strict";
  //SE VUOTO -> ERRORE
  if (email.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorEmail.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    email.className = "invalid";
    verEmail = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = email.value.search(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\,.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos !== 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorEmail.innerHTML = "Inserisci una email valida";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      email.className = "invalid";
      //CONTROLLO -> FALSO
      verEmail = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorEmail.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      email.className = "valid";
      //CONTROLLO -> VERO
      verEmail = true;
    }
  }
  if(verCell && verEmail) {
    nextButton_3.className = "nextBtn";
  } else {
    nextButton_3.className = "nextBtn disableButton";
  }
}
//USERNAME
function checkUser() {
  "use strict";
  //SE VUOTO -> ERRORE
  if (regUsername.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorUser.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    regUsername.className = "invalid";
    //CONTROLLO -> FALSO
    verUser = false;
  } else { //CONTROLLA SE IL NOME UTENTE ESISTE
    var xmlhttp = new XMLHttpRequest();
    //ID DEL TIPO RICERCA PER "liveSearch.php"
    var queryId = "&queryId=user";
    xmlhttp.onreadystatechange = function () {
      //SE LA RICHIESTA E' STATA ELABORATA
      if (this.readyState === 4 && this.status === 200) {
        //SE IL NOME UTENTE E' GIA' PRESENTE RITORNA FALSO
        if (this.responseText === "false") {
          //STAMPA MESSAGGIO D'ERRORE
          errorUser.innerHTML = "Questo nome utente non &egrave; disponibile";
          //IL CAMPO DIVENTA INVALIDO (ROSSO)
          regUsername.className = "invalid";
          //CONTROLLO -> FALSO
          verUser = false;
        } else {
          //CANCELLA MESSAGGIO D'ERRORE
          errorUser.innerHTML = "";
          //IL CAMPO DIVENTA VALIDO (VERDE)
          regUsername.className = "valid";
          //CONTROLLO -> VERO
          verUser = true;
        }
      }
    };
    //PREPARA LA RICHIESTA
    xmlhttp.open("GET", "../resources/php/script/liveSearch.php?query=" + regUsername.value + queryId, true);
    //INVIA
    xmlhttp.send();
  }
  if(verUser && verPwd && verCofPwd) {
    sendForm.className = "nextBtn";
  } else {
    sendForm.className = "nextBtn disableButton";
  }
}
//PASSWORD
function checkPwd() {
  "use strict";
  //SE VUOTO -> ERRORE
  if (regPassword.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorPwd.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    regPassword.className = "invalid";
    //CONTROLLO -> FALSO
    verPwd = false;
  } else {
    //MESSAGGIO PASSWORD INVALIDA
    var invalidPwd = "La password deve avere una lunghezza minima di 8, \
    contenere almeno una lettera maiuscola, una minuscola, \
    un numero e un carattere speciale";
    //L'INPUT MATCHA LA REGEX?
    pos = regPassword.value.search(/(^(?=.*[a-z])|(?=.*[A-Z]))(?=.*\d)(?=.*[^\da-zA-Z]).{8,32}$/gm);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos !== 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorPwd.innerHTML = invalidPwd;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      regPassword.className = "invalid";
      //CONTROLLO -> FALSO
      verPwd = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorPwd.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      regPassword.className = "valid";
      //CONTROLLO -> VERO
      verPwd = true;
    }
  }
  if(verUser && verPwd && verCofPwd) {
    sendForm.className = "nextBtn";
  } else {
    sendForm.className = "nextBtn disableButton";
  }
}
//CONFERMA PASSWORD
function checkCofPwd() {
  "use strict";
  //SE VUOTO -> ERRORE
  if (cofPassword.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorCofPwd.innerHTML = "Non puoi lasciare vuoto questo campo";
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    cofPassword.className = "invalid";
    //CONTROLLO -> FALSO
    verCofPwd = false;
  } else {
    if (cofPassword.value !== regPassword.value) {
      //STAMPA MESSAGGIO D'ERRORE
      errorCofPwd.innerHTML = "Le password non combaciano";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      cofPassword.className = "invalid";
      //CONTROLLO -> FALSO
      verCofPwd = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorCofPwd.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      cofPassword.className = "valid";
      //CONTROLLO -> VERO
      verCofPwd = true;
    }
  }
  if(verUser && verPwd && verCofPwd) {
    sendForm.className = "nextBtn";
  } else {
    sendForm.className = "nextBtn disableButton";
  }
}