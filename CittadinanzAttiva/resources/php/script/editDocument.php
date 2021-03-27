<?php
  //FUNZIONE CHE TESTA L'INPUT
  //IMPEDISCE L'INTRODUZIONE DI CODICE MALIGNO
  function test_input ($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  //RITORNA L'INPUT "RIPULITO"
  return $data;
  }
  //FUNZIONE CHE CARICA IL DOCUMENTO XML RICHIESTO DA ALTRE FUNZIONI
  function loadDocument ($request) {
    //CONDIZIONI INIZIALI
    $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    //CONTROLLA IL TIPO DI RICHIESTA E CARICA IL XML FILE ADEGUATO
    switch ($request) {
      case "sitemap":
        $dom->load("../sitemap.xml");
        break;
      case "news":
        $dom->load("../resources/xml/news.xml");
        break;
      case "deleteNews":
        $dom->load("../../resources/xml/news.xml");
        break;
      case "editNews":
        $dom->load("../../xml/news.xml");
        break;
      case "prov":
        $dom->load("../../xml/provincie.xml");
        break;
      case "paese":
        $dom->load("../../xml/comuni.xml");
        break;
    }
    //RITORNA IL FILE ALLA FUNZIONE CHIAMANTE
    return $dom;
  }
  function saveDocument ($dom, $type) {
    if ($dom->save("../../xml/news.xml")) {
      header ("Location: ../../../user/admin/?id=$type&status=200");
    } else {
      header ("Location: ../../../user/admin/?id=$type&status=500");
    }
  }
?>