<?php
    require_once "Classi/Storia.php";

    if (isset($_FILES["file"]) && !empty($_FILES["file"])) 
    {
        //prendo info dal file
        $fileTmpPath = $_FILES["file"]["tmp_name"];
        $fileName = $_FILES["file"]["name"];

        if($fileTmpPath == null)
        {
            header("location: paginaAddStoria.php?messaggio=nessun file caricato!");
            exit;
        }
        
        $estensioneFile = explode(".", $fileName)[1];

        //nome utente che prendo dalla sessione 
        //$username = $_SESSION["utente"];
        $username = "Marco";
        $pathUtente = "FileUtenti/$username";
        $pathCartellaFoto = "$pathUtente/FotoStoria";

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
        if (file_exists($fileTmpPath) && is_file($fileTmpPath) && is_readable($fileTmpPath))
        {
            if (move_uploaded_file($fileTmpPath, $pathFinale))
                echo "Successo";
            else
                echo "Errore";
        }
        else 
        {
            echo "Il path non esiste.\n";
        }
        //

        //prendo la data di pubblicazione e il tempo corrente
        $infoDataPubblicazione = date("Y-m-d") . " " . date("h:i:s");
        //

        //aggiungo una nuova dupla nel file FilePubblicazioni.csv
        $storia  = new Storia($username, $estensioneFile, $infoDataPubblicazione);
        $storia->toCSV();
        header("location: paginaHome.php?popup=storia caricata con successo");
    } 
    else 
    {
        echo "No file caricati";
        header("location: paginaLogin.php?messaggio=nessun file caricato!");
    }
    exit;
    
?>