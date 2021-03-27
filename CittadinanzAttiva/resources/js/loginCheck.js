//FORM
var loginForm = document.getElementById("loginForm");
//INPUT
var user = document.getElementById("username");
var pwd = document.getElementById("password");
//ERRORI
var wrongUser = document.getElementById("wrongUser");
var wrongPwd = document.getElementById("wrongPwd");
//CONTROLLO INPUT
var verUser = false;
var verPwd = false;
//PULSANTE DI INVIO
var submitButton = document.getElementById("submitButton");
//EVENT LISTENER PER L'INPUT
user.addEventListener("keyup", verifyUser, false);
pwd.addEventListener("keyup", verifyPwd, false);
//PREVIENI L'INVIO DELLA FORM
loginForm.addEventListener("submit", function (event) {
  event.preventDefault();
  if(verUser && verPwd) {
    loginForm.submit();
  }
}, false);
//FUNZIONE CHE PRELEVA I PARAMETRI DELL'URL
function getUrlVars() {
  "use strict";
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
    vars[key] = value;
  });
  return vars;
}
//CONTROLLA SE L'UTENTE INSERISCE CORRETTAMENTE I DATI
/*IN REALTA VIENE CONTROLLATO SOLO SE IL CAMPO NON VENGA LASCIATO VUOTO,
IL CONTROLLO VERO VIENE EFFETTUATO LATO SERVER PER SICUREZZA*/
function verifyUser() {
  if (user.value === "") {
    user.className = "invalid";
    wrongUser.innerHTML = "Non puoi lasciare questo campo vuoto";
    verUser = false;
  } else {
    user.className = "valid";
    wrongUser.innerHTML = "";
    verUser = true;
  }
}
function verifyPwd () {
  if (pwd.value === "") {
    pwd.className = "invalid";
    wrongPwd.innerHTML = "Non puoi lasciare questo campo vuoto";
    verPwd = false;
  } else {
    pwd.className = "valid";
    wrongPwd.innerHTML = "";
    verPwd = true;
  }
  if(verUser && verPwd) {
    submitButton.className = "useless";
  } else {
    submitButton.className = "disableButton";
  }
}
//CANCELLA L'INPUT
function clearInput() {
  "use strict";
  //USERNAME
  user.value = "";
  wrongUser.innerHTML = "";
  user.className = "useless";
  //PASSWORD
  pwd.value = "";
  wrongPwd.innerHTML = "";
  pwd.className = "useless";
}