"use strict";
//FORM
var changeUser = document.getElementById("changeUser");
var changeEmail = document.getElementById("changeEmail");
var changePwd = document.getElementById("changePwd");
//PULSANTI DI INVIO FORM
var buttonUser = document.getElementById("submitUser");
var buttonPwd = document.getElementById("submitPwd");
var buttonEmail = document.getElementById("submitEmail");
//USER
var userNav = document.getElementById("userNav");
var user = userNav.getElementsByTagName("span");
//CAMPI DI CONTROLLO PER LO USERNAME
var oldUser = document.getElementById("oldUser");
var newUser = document.getElementById("newUser");
var errorOldUser = document.getElementById("errorOldUser");
var errorNewUser = document.getElementById("errorNewUser");
var verOldUser = false;
var verNewUser = false;
//AGGIUNGI UN EVENTO LISTENER ALL'INPUT
oldUser.addEventListener("keyup", verifyOldUser, false);
newUser.addEventListener("keyup", verifyNewUser, false);
//CAMPI DI CONTROLLO PER LA PWD
var oldPwd = document.getElementById("oldPassword");
var newPwd = document.getElementById("newPassword");
var errorOldPwd = document.getElementById("errorOldPwd");
var errorNewPwd = document.getElementById("errorNewPwd");
var verOldPwd = false;
var verNewPwd = false;
//AGGIUNGI UN EVENTO LISTENER ALL'INPUT
oldPwd.addEventListener("keyup", verifyOldPwd, false);
newPwd.addEventListener("keyup", verifyNewPwd, false);
//CAMPI CONTROLLO DELL'EMAIL
var oldEmail = document.getElementById("oldEmail");
var newEmail = document.getElementById("newEmail");
var errorOldEmail = document.getElementById("errorOldEmail");
var errorNewEmail = document.getElementById("errorNewEmail");
var verOldEmail = false;
var verNewEmail = false;
//AGGIUNGI UN EVENTO LISTENER ALL'INPUT
oldEmail.addEventListener("keyup", verifyOldEmail, false);
newEmail.addEventListener("keyup", verifyNewEmail, false);
//MESSAGGI D'ERRORE E/O ERRORI VARI
var voidField = "Attenzione: Non puoi lasciare vuoto questo campo";
var invalidPwd = "La password deve avere una lunghezza minima di 8, \
  contenere almeno una lettera maiuscola, una minuscola, \
  un numero e un carattere speciale.";
//CONTROLLO MATCH REGEX
var pos = 0;
//BLOCCA L'INVIO DELLA FORM CAMBIO USER
changeUser.addEventListener("submit", function(event) {
  event.preventDefault();
  if (verOldUser && verNewUser) {
    changeUser.submit();
  }
}, false);
//BLOCCA L'INVIO DELLA FORM CAMBIO PASSWORD
changePwd.addEventListener("submit", function(event) {
  event.preventDefault();
  if (verOldPwd && verNewPwd) {
    changePwd.submit();
  }
}, false);
//BLOCCA L'INVIO DELLA FORM CAMBIA EMAIL
changeEmail.addEventListener("submit", function(event) {
  event.preventDefault();
  if(verOldEmail && verNewEmail) {
    changeEmail.submit();
  }
}, false);
//FUNZIONE PER MOSTRARE LE OPZIONI UTENTE
function showTab (currentTab) {
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
//FUNZIONE CHE MOSTRA IL MESSAGGIO SELEZIONATO
function openMessage(id) {
  var link = "messagges/?messageId=" + id;
  window.open(link, "_self");
}
//FUNZIONE CHE MOSTRA IL MESSAGGIO SELEZIONATO (CASO KEYPRESS)
function openMessagePress(id, event) {
  if(event.which === 13) {
    openMessage(id);
  }
}
//FUNZIONE PER MOSTRARE LE OPZIONI DI MODIFICA
function showOption(option) {
  var div = document.getElementById("datiPersonali");
  var li = div.getElementsByTagName("ul")[0].children;
  var i = 0;
  //MOSTRA LA FORM RICHIESTA E NASCONDI QUELLA VECCHIA
  for (i = 1; i < 4; i += 1) {
    if (i === option) {
      div.children[i].className = "changeForm";
    } else {
      div.children[i].className = "hidden";
    }
  }
  //CAMBIA IL COLORE DEL BOTTONE DELLA SCHEDA ATTIVA
  option -= 1;
  for (i = 0; i < 3; i += 1) {
    if (i === option) {
      li[i].className = "activeOption";
    } else {
      li[i].className = "useless";
    }
  }
}
//FUNZIONE CHE CONTROLLA LO USERNAME
function verifyOldUser () {
  //SE VUOTO -> ERRORE
  if (oldUser.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorOldUser.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    oldUser.className = "firstInput invalid";
    //CONTROLLO -> FALSO
    verOldUser = false;
  } else {
    //CONTROLLA SE LO USER INSERITO E' GIUSTO
    if (oldUser.value === user[0].innerText) {
      errorOldUser.innerHTML = "";
      oldUser.className = "firstInput valid";
      verOldUser = true;
    } else {
      errorOldUser.innerHTML = "Attenzione: Lo username inserito non \
      corrisponde con quello attualmente in uso";
      oldUser.className = "firstInput invalid";
      verOldUser = false;
    }
    //SE L'INPUT E' CORRETTO CAMBIA IL COLORE DEL PULSANTE PER FAR CAPIRE
    //CHE E' POSSIBILE INVIARE LA FORM
    if (verOldUser && verNewUser) {
      buttonUser.className = "useless";
    } else {
      buttonUser.className = "disableButton";
    }
  }
}
function verifyNewUser () {
  if (newUser.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorNewUser.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    newUser.className = "secondInput invalid";
    //CONTROLLO -> FALSO
    verNewUser = false;
  } else {
    var reg = /^[a-zA-Z0-9_-]*$/g;
    pos = newUser.value.search(reg);
    if (pos !== 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorNewUser.innerHTML = "Lo Username deve essere composto solo da \
      lettere e numeri.";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      newUser.className = "secondInput invalid";
      //CONTROLLO -> FALSO
      verNewUser = false;
    } else {
      //CONTROLLO CHE LO USER NON ESISTA GIA'
      var xmlhttp = new XMLHttpRequest();
      //ID DEL TIPO RICERCA PER "liveSearch.php"
      var queryId = "&queryId=user";
      xmlhttp.onreadystatechange = function () {
        //SE LA RICHIESTA E' STATA ELABORATA
        if (this.readyState === 4 && this.status === 200) {
          if (this.responseText === 'false') {
            //STAMPA MESSAGGIO D'ERRORE
            errorNewUser.innerHTML = "Questo username non &egrave; disponibile";
            //IL CAMPO DIVENTA INVALIDO (ROSSO)
            newUser.className = "secondInput invalid";
            //CONTROLLO -> FALSO
            verNewUser = false;
          } else {
            errorNewUser.innerHTML = "";
            newUser.className = "secondInput valid";
            //CONTROLLO -> VERO
            verNewUser = true;
          }
        }
        //SE L'INPUT E' CORRETTO CAMBIA IL COLORE DEL PULSANTE PER FAR CAPIRE
        //CHE E' POSSIBILE INVIARE LA FORM
        if (verOldUser && verNewUser) {
          buttonUser.className = "useless";
        } else {
          buttonUser.className = "disableButton";
        }
      };
      //PREPARA LA RICHIESTA
      xmlhttp.open("GET", "../../resources/php/script/liveSearch.php?query=" + newUser.value + queryId, true);
      //INVIA
      xmlhttp.send();
    }
  }
}
//FUNZIONE CHE CONTROLLA LA PASSWORD
function verifyOldPwd () {
  //ESPRESSIONE REGOLARE PER CONTROLLA LA PWD
  var reg = /(^(?=.*[a-z])|(?=.*[A-Z]))(?=.*\d)(?=.*[^\da-zA-Z]).{8,32}$/gm;
  //CONTROLLA LA PWD
  if (oldPwd.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorOldPwd.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    oldPwd.className = "firstInput invalid";
    //CONTROLLO -> FALSO
    verOldPwd = false;
  } else {
    pos = oldPwd.value.search(reg);
    if (pos !== 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorOldPwd.innerHTML = "Inserisci una Password valida";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      oldPwd.className = "firstInput invalid";
    //CONTROLLO -> FALSO
    verOldPwd = false;
    } else {
      errorOldPwd.innerHTML = "";
      oldPwd.className = "firstInput valid";
      verOldPwd = true;
    }
  }
  //SE L'INPUT E' CORRETTO CAMBIA IL COLORE DEL PULSANTE PER FAR CAPIRE
  //CHE E' POSSIBILE INVIARE LA FORM
  if (verOldPwd && verNewPwd) {
    buttonPwd.className = "useless";
  } else {
    buttonPwd.className = "disableButton";
  }
}
//CONTROLLA LA NUOVA PASSWORD
function verifyNewPwd () {
  //SE VUOTO -> ERRORE
  var reg = /(^(?=.*[a-z])|(?=.*[A-Z]))(?=.*\d)(?=.*[^\da-zA-Z]).{8,32}$/gm;
  if (newPwd.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorNewPwd.innerHTML = "Attenzione: Non puoi lasciare vuoto questo campo";
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    newPwd.className = "secondInput invalid";
    //CONTROLLO -> FALSO
    verNewPwd = false;
  } else {
    pos = newPwd.value.search(reg);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos !== 0) {
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      newPwd.className = "secondInput invalid";
      //CONTROLLO -> FALSO
      verNewPwd = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorNewPwd.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      newPwd.className = "secondInput valid";
      //CONTROLLO -> VERO
      verNewPwd = true;
    }
  }
  //SE L'INPUT E' CORRETTO CAMBIA IL COLORE DEL PULSANTE PER FAR CAPIRE
  //CHE E' POSSIBILE INVIARE LA FORM
  if (verOldPwd && verNewPwd) {
    buttonPwd.className = "useless";
  } else {
    buttonPwd.className = "disableButton";
  }
}
//FUNZIONE CHE CONTROLLA SE LA VECCHIA EMAIL INSERITA CORRISPONDE A QUELLA
//NEL DATABASE
function verifyOldEmail () {
  if (oldEmail.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorOldEmail.innerHTML = voidField;
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    oldEmail.className = "firstInput invalid";
    verOldEmail = false;
  } else {
    //CONTROLLA SE LA MAIL INSERITA E' GIUSTA
    var xmlhttp = new XMLHttpRequest();
    //ID DEL TIPO RICERCA PER "liveSearch.php"
    var queryId = "&queryId=email";
    xmlhttp.onreadystatechange = function () {
      //SE LA RICHIESTA E' STATA ELABORATA
      if (this.readyState === 4 && this.status === 200) {
        if (this.responseText === oldEmail.value) {
          errorOldEmail.innerHTML = "";
          oldEmail.className = "firstInput valid";
          verOldEmail = true;
        } else {
          errorOldEmail.innerHTML = "Attenzione: L&#39; email inserita non \
          corrisponde con l&#39;email presente nel database";
          oldEmail.className = "firstInput invalid";
          verOldEmail = false;
        }
        //SE L'INPUT E' CORRETTO CAMBIA IL COLORE DEL PULSANTE PER FAR CAPIRE
        //CHE E' POSSIBILE INVIARE LA FORM
        if(verOldEmail && verNewEmail) {
          buttonEmail.className = "useless";
        } else {
          buttonEmail.className = "disableButton";
        }
      }
    };
    //PREPARA LA RICHIESTA
    xmlhttp.open("GET", "../../resources/php/script/liveSearch.php?query=" + user[0].innerHTML + queryId, true);
    //INVIA
    xmlhttp.send();
  }
}
//FUNZIONE CHE CONTROLLA LA NUOVA EMAIL
function verifyNewEmail () {
  
  //ESPRESSIONE REGOLARE PER CONTROLLARE L'EMAIL
  var reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\,.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  //CONTROLLA LA EMAIL
  //SE VUOTO -> ERRORE 
  if (newEmail.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorNewEmail.innerHTML = voidField;
    newEmail.className = "secondInput invalid";
    verNewEmail = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = newEmail.value.search(reg);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos !== 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorNewEmail.innerHTML = "Attenzione: Inserisci una email valida";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      newEmail.className = "secondInput invalid";
      //CONTROLLO -> FALSO
      verNewEmail = false;
      } else if (oldEmail.value === newEmail.value) {
        errorNewEmail.innerHTML = "Attenzione: La nuova email non pu&ograve; \
        essere uguale a quella vecchia";
        newEmail.className = "secondInput invalid";
        verNewEmail = false;
      } else {
        errorNewEmail.innerHTML = "";
        newEmail.className = "secondInput valid";
        verNewEmail = true;
      }
  }
  //SE L'INPUT E' CORRETTO CAMBIA IL COLORE DEL PULSANTE PER FAR CAPIRE
  //CHE E' POSSIBILE INVIARE LA FORM
  if(verOldEmail && verNewEmail) {
    buttonEmail.className = "useless";
  } else {
    buttonEmail.className = "disableButton";
  }
}