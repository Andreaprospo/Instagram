<?php
    require_once "Classi/Storia.php";

    if (isset($_FILES['file'])) 
    {

        //prendo info dal file
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
      
        $estensioneFile = explode(".", $fileName)[1];
        //

        //nome utente che prendo dalla sessione 
        //$username = $_SESSION["utente"];
        $username = "Marco";
        $pathUtente = "FileUtenti/$username";
        $pathCartellaFoto = "$pathUtente/FotoStoria";
        //

        //crea la cartella se non esiste
        if (!is_dir($pathCartellaFoto)) {
            mkdir($pathCartellaFoto, 0777, true); 
        }
        //
        
        //combino il nome utente e metto id (+ 1 perchè restituisce l'ultimo id inserito)
        $idStoria = Storia::getLastId($username) + 1;
        $pathFinale = "$pathCartellaFoto/$idStoria.$estensioneFile";
        //

        //sposta il file e stampa il risultato
        if (move_uploaded_file($fileTmpPath, $pathFinale))
            echo "Successo";
        else
            echo "Errore";
        //

        //prendo la data di pubblicazione e il tempo corrente
        $infoDataPubblicazione = date("Y-m-d") . " " . date("h:i:s");
        //

        //aggiungo una nuova dupla nel file FilePubblicazioni.csv
        $storia  = new Storia($estensioneFile, $infoDataPubblicazione, $username);
        $storia->toCSV();
    } 
    else 
        echo "No file caricati";
?>