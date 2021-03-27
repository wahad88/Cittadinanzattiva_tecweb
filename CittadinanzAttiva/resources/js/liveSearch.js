//VARIABILE PER LA RICERCA AJAX
var queryId = "";
//LISTA PER SCEGLIERE LA PROVINCIA E COMUNE
var selectProv = document.getElementById("selectProv");
var selectPaese = document.getElementById("selectPaese");
//VARIABILE PER L'ICONA DI CARICAMENTO
var loadingProv = document.getElementById("loadingProv");
var loadingPaese = document.getElementById("loadingPaese");
//FUNZIONE LIVESEARCH
function liveSearch(type, query, prov) {
  "use strict";
  var linkSearch = "../../resources/php/script/liveSearch.php?query=";
  switch (type) {
    case "prov":
      queryId = "&queryId=prov";
      linkSearch = linkSearch + query + queryId;
      break;
    case "paese":
      //SE IL CAMPO PROVINCIA E' VUOTO NON USARE IL LIVESEARCH
      if(prov !== "") {
	    queryId = "&queryId=paese";
	    linkSearch = linkSearch + query + queryId + "&prov=" + prov;
      }
      break;
  }
  if(query !== "") {
    //RICHIESTA AJAX
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
    //SE LA RICHIESTA E' STATA ELABORATA
      if (this.readyState === 4 && this.status === 200) {
        var response = this.responseText;
        if (response.length === 0) {
          response = "<p>Nessun risultato</p>";
        }
        if (type === "prov") {
          //MOSTRA LE PROVINCIE E NASCONDI L'ICONA DI CARICAMENTO
          setTimeout (function () {
            //NASCONDI L'ICONA DI CARICAMENTO
            loadingProv.className = "loadingIcon hidden";
            //MOSTRA I SUGGERIMENTI
            selectProv.className = "selectCountry";
            selectProv.innerHTML = response;
          }, 500);
        } else {
          //MOSTRA I COMUNI E NASCONDI L'ICONA DI CARICAMENTO
          setTimeout(function(){
            //NASCONDI L'ICONA DI CARICAMENTO
            loadingPaese.className = "loadingIcon hidden";
            //MOSTRA I SUGGERIMENTI
            selectPaese.className = "selectCountry";
            selectPaese.innerHTML = response;
          }, 500);
        }
      } else {
          //SE LA RISPOSTA NON E' PRONTA
          //PROVINCIA
          if (type === "prov") {
            //MOSTRA L'ICONA DI CARICAMENTO
            loadingProv.className = "loadingIcon show";
            //NASCONDI I SUGGERIMENTI
            selectProv.className = "selectCountry hidden";
          } else { //PAESE
            //MOSTRA L'ICONA DI CARICAMENTO
            loadingPaese.className = "loadingIcon show";
            //NASCONDI I SUGGERIMENTI
            selectPaese.className = "selectCountry hidden";
          }
      }
    };
    //PREPARA LA RICHIESTA
    if (query !== "") {
      xmlhttp.open("GET", linkSearch , true);
      xmlhttp.send();
    }
  } else {
    selectProv.className = "selectCountry hidden";
    selectPaese.className = "selectCountry hidden";
  }
}
//SELEZIONATO IL SUGGERIMENTO, NASCONDILO
function setInput(input, type) {
  if (type === "prov") {
    provincia.value = input;
    selectProv.className = "selectCountry hidden";
  } else {
    paese.value = input;
	selectPaese.className = "selectCountry hidden";
  }
}
//NASCONDI I SUGGERIMENTI SE L'INPUT NON HA PIU' FOCUS
function hideSearch(type) {
  if(type === "prov") {
    setTimeout(function(){
      selectProv.className = "selectCountry hidden";
	}, 500);
  } else if (type === "paese") {
    setTimeout(function(){
      selectPaese.className = "selectCountry hidden";
	}, 500);
  }
}