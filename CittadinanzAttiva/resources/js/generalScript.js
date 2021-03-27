//FUNZIONE CHIAMANTE PER LO SCROLLCHECK
window.onscroll = function() {
  "use strict";
  scrollFunction();
};
//FUNZIONE CHE MODIFCA L'ALTEZZA DELLA NAVBAR IN BASE ALLO SCROLL
function scrollFunction() {
  "use strict";
  //PRELEVA GLI ELEMENTI DEL MENU' DI NAVIGAZIONE
  var navBar = document.getElementById("navbar");
  var navCover = document.getElementById("nav_cover");
  var logo = document.getElementById("logo_div");
  var breadcrumb = document.getElementById("breadcrumb");
  var user = document.getElementById("userNav");
  //PRELEVA IL VALORE DELLO SCROLL
  var elementScroll = document.documentElement.scrollTop || document.body.scrollTop;
  //RIDUCI IL MENU' DI NAVIGAZIONE SE LO SCROLL E' MAGGIORE DI 45PX
    if (elementScroll > 45) {
      navBar.className = "nav resized_nav";
      navCover.className = "nav_cover resized_cover";
      logo.className = "logo logo_resized";
      breadcrumb.className = "breadcrumb breadcrumb_resized";
      if (user !== null) {
        user.className = "userNav userNav_resized";
      }
    } else {
      //RIPRISTINA LA DIMENSIONE ORIGINALE DEL MENU'
      navBar.className = "nav";
      navCover.className = "nav_cover";
      logo.className = "logo";
      breadcrumb.className = "breadcrumb";
      if (user !== null) {
        user.className = "userNav";
      }
    }
}
//FUNZIONE CHE MOSTRA IL MENU' SU MOBILE
function showMenu () {
  "use strict";
  var burgerMenu = document.getElementById("burger-menu");
  var nav = document.getElementById("nav_cober");
  var ul = document.getElementsByTagName("ul");
  if (burgerMenu.className === "burger-menu") {
    burgerMenu.className = "close-burger-menu";
    ul[0].className = "nav-mobile";
  } else {
    burgerMenu.className = "burger-menu";
    ul[0].className = "useless";
  } 
}
//FUNZIONE CHE AGGIUSTA LA POSIZIONE DEL FOOTER PER RISOLUZIONI CON ALTEZZA >= 1024px
function tweakFooter () {
  var height = screen.height;
  var tweak_footer = document.getElementById("tweak-footer");
  if (tweak_footer) {
    if(height >= 1024) {
      tweak_footer.className += " tweak-footer";
    }
  }
}