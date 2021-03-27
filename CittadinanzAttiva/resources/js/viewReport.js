"use strict";
//INPUT RICERCA
var input = document.getElementById("searchTable");
//ERRORE
var errorSearch = document.getElementById("errorSearch");
//FORM DI RICERCA
var searchForm = document.getElementById("searchForm");
//PULSANTE STAMPA
var printButton = document.getElementById("printButton");
//PREVIENI L'INVIO DELLE FORM DI RICERCA
if (searchForm) {
  searchForm.addEventListener("submit", function(event) {
    event.preventDefault();
    if(checkQuery()) {
      searchForm.submit();
    }
  }, false);
}
//AGGIUNGI EVENT LISTENER PER LA STAMPA
if(printButton) {
  printButton.addEventListener("click", function(event) {
    event.stopPropagation();
    window.print();
  }, false);
}
//FUNZIONE CHE CONTROLLA SE L'UTENTE NON STIA CERCANDO NIENTE
function checkQuery() {
  if(input.value === "") {
    errorSearch.innerHTML = "Inserisci un termine per effettuare la ricerca";
    return false;
  } else {
    errorSearch.innerHTML = "";
    return true;
  }
}
//FUNZIONE CHE APRE LA SEGNALAZIONE RICHIESTA (CASO KEYPRESS)
function openReportPress(reportId, event) {
  if(event.which === 13) {
    openReport(reportId);
  }
}
//FUNZIONE CHE APRE LA SEGNALAZIONE RICHIESTA (CASO ONCLICK)
function openReport(reportId) {
  var reportLink = "../viewReport/?reportId=" + reportId;
  window.open(reportLink, "_self");
}