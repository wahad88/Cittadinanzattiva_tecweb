<?php
    //SCRIPT PER L'ELIMINAZIONE DELLE NEWS
    //RICHIEDI LE FUNZIONI PER MOFIFICARE IL FILE XML 
    include '../script/editDocument.php';
	
    //PRELEVA DALL'INPUT L'ID DELLA NEWS DA ELIMINARE
    if(isset($_POST["deleteNews"])) {
      $id = $_POST["deleteNews"];
    }
    //CARICA IL FILE XML
    $request = "editNews";
    $xml = loadDocument($request);
    $root = $xml->documentElement;
    $news = $root->getElementsByTagName("news");
    
    //ASSEGNA L'ID DELLA PRIMA NEWS A OLDID
    $oldId = $news[0]->getAttribute("id");
    
    //RIMUOVI LA NEWS
    $removeNews = $news->item($id);
    $oldNews = $root->removeChild($removeNews);
    
    //SE NEL DOCUMENTO SONO PRESENTI ANCORA NEWS, MODIFICANE L'ID
    if($news->item(0) != NULL) {
        //PRELEVA L'ID DELLA NEWS IN CIMA
        $newId = $news[0]->getAttribute('id');
    
        //SE L'ID DELLA VARIABILE NEWID CORRISPONDE ALL'ID DELLA VARIABILE OLDID  
        if($newId == $oldId) {
            //RIPRISTINO L'ORDINE DEGLI ID
            /*
            OVVERO SE HO UN DOCUMENTO CON 4 ID NELL'ORDINE 4->3->2->1 E GLI ID DELLE DUE VARIABILI CORRISPONDONO,
            ALLORA SIGNIFICA CHE E' STATA ELIMANATA UNA NEWS TRA 3 E 1, PER ESEMPIO LA NEWS 2, QUINDI LE NEWS ORA HANNO
            UN ORDINE 4->3->1, QUINDI DEVO MODIFICARE L'ORDINE DELLE NEWS IN MODO DA FARLE TORNARE NEL FORMATO 3->2->1
            */
            
            for($i = 0; $i < $oldId - 1; $i += 1) {
                $newId -= 1;
                $news[$i]->setAttribute('id', $newId);
            }
            //SALVA IL DOCUMENTO XML
            saveDocument($xml, "delete");
        } else {
          //ALTRIMENTI SE HO ELIMINATO LA NEWS IN CIMA AL DOCUMENTO L'ORDINE DEGLI ID RIMANE INALTERATO
          //E SALVO IL DOCUMENTO
		  saveDocument($xml, "deleteNews");
		}
    } else {
      //SE NON SONO STATE ELIMINATE NEWS SALVO IL DOCUMENTO ORIGINALE
	  saveDocument($xml, "deleteNews");
	}
?>