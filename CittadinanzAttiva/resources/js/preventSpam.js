function preventSpamming() {
  "use strict";
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      parser(this);
    }
  };
  xhttp.open("GET", "../../resources/xml/blockSpam.xml", true);
  xhttp.send();
}

function parser(xml) {
  "use strict";
  var xmlDoc = xml.responseXML;
  var contactEmail = document.getElementById("contact-email");
  var errorEmail = document.getElementById("errorEmail");
  var x = xmlDoc.documentElement.childNodes;
  var email = "";
  for (var i = 0; i < x.length; i += 1) {
    email = xmlDoc.getElementsByTagName("email")[i].nodeValue;
    if (email === contactEmail.value) {
      errorEmail.innerText = "This email has been banned from posting";
      return false;
    } else {
      return true;
    }
  }
}