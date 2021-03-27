"use strict";
//FORM
var contact = document.getElementById("contact-form");
//PULSANTE DI INVIO
var submitButton = document.getElementsByTagName("button");
//PRELEVA L'INPUT
var nome = document.getElementById("name");
var surname = document.getElementById("surname");
var email = document.getElementById("contact-email");
var textarea = document.getElementById("request-textarea");
//ERRORI
var errorName = document.getElementById("errorName");
var errorSurname = document.getElementById("errorSurname");
var errorEmail = document.getElementById("errorEmail");
var errorText = document.getElementById("errorTextarea");
//CONTROLLO ERRORI
var verName = false;
var verSurname = false;
var verEmail = false;
var verText = false;
//CONTROLLO REGEX
var pos = 0;
//PREVIENI L'INVIO DELLA FORM
contact.addEventListener("submit", function (event) {
  event.preventDefault();
  if(verName && verSurname && verEmail && verText) {
    contact.submit();
  }
}, false );
////EVENT LISTENER PER IL CONTROLLO DELL'INPUT
nome.addEventListener("keyup", checkName, false);
surname.addEventListener("keyup", checkSurname, false);
email.addEventListener("keyup", checkEmail, false);
textarea.addEventListener("keyup", checkText, false);
function checkName() {
  var pos = 0;
  //NOME
  if (nome.value === "") {
    errorName.innerHTML = "Non puoi lasciare vuoto questo campo";
    nome.className = "invalid";
    verName = false;
  } else {
    pos = nome.value.search(/[^a-zA-Z|\s|']/g);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorName.innerHTML = "Il nome deve contenere solo lettere";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      nome.className = "invalid";
      //CONTROLLO -> FALSO
      verName = false;
    } else { //ALTRIMENTI OK
      //CANCELLA MESSAGGIO D'ERRORE
      errorName.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      nome.className = "valid";
      //CONTROLLO -> VERO
      verName = true;
    }
  }
  if(verName && verSurname && verEmail && verText) {
    submitButton[0].className = "useless";
  } else {
    submitButton[0].className = "disableButton";
  }
}
function checkSurname() {
  //COGNOME    
  //SE VUOTO -> ERRORE
  if (surname.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorSurname.innerHTML = "Non puoi lasciare vuoto questo campo";
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    surname.className = "invalid";
    verSurname = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = surname.value.search(/[^a-zA-Z|\s|']/g); 
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE    
      errorSurname.innerHTML = "Il cognome deve contenere solo lettere";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      surname.className = "invalid";
      //CONTROLLO -> FALSO
      verSurname = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      errorSurname.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      surname.className = "valid";
      //CONTROLLO -> VERO
      verSurname = true;
    }
  }
  if(verName && verSurname && verEmail && verText) {
    submitButton[0].className = "useless";
  } else {
    submitButton[0].className = "disableButton";
  }
}
function checkEmail () {
  //EMAIL
  //SE VUOTO -> ERRORE
  if (email.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorEmail.innerHTML = "Non puoi lasciare vuoto questo campo";
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    email.className = "invalid";
    verEmail = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = email.value.search(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos !== 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorEmail.innerHTML = "Inserisci una email valida";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      email.className = "invalid";
      //CONTROLLO -> FALSO
      verEmail = false;
    } else { //ALTRIMENTI OK
      //CANCELLA MESSAGGIO D'ERRORE
      errorEmail.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      email.className = "valid";
      //CONTROLLO -> VERO
      verEmail = true;
    }
  }
  verEmail = preventSpamming();
  if(verName && verSurname && verEmail && verText) {
    submitButton[0].className = "useless";
  } else {
    submitButton[0].className = "disableButton";
  }
}
function checkText() {
  if (textarea.value === "") {
    //STAMPA MESSAGGIO D'ERRORE
    errorText.innerHTML = "Non puoi lasciare vuoto questo campo";
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    textarea.className = "invalid";
    verText = false;
  } else { //ALTRIMENTI OK
    //CANCELLA MESSAGGIO D'ERRORE
    errorText.innerHTML = "";
    //IL CAMPO DIVENTA VALIDO (VERDE)
    textarea.className = "valid";
    //CONTROLLO -> VERO
    verText = true;
  }
  if(verName && verSurname && verEmail && verText) {
    submitButton[0].className = "useless";
  } else {
    submitButton[0].className = "disableButton";
  }
}