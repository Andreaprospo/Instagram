<?php

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
        $pathCartellaFoto = "$pathUtente/Foto";
        //

        //crea la cartella se non esiste
        if (!is_dir($pathCartellaFoto)) {
            mkdir($pathCartellaFoto, 0777, true); 
        }
        //

        //prendo l'ultimo id della storia così da identificarlo univocamente
        $idStoria = getLastId($username) + 1;
        //

        //combino il nome utente e metto id 
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
        $infoDaAggiungere = "$idStoria;Storia;$username;$infoDataPubblicazione;null;null;false";
        file_put_contents("$pathUtente/FilePubblicazione.csv", $infoDaAggiungere+"\n", FILE_APPEND);
    } 
    else 
        echo "No file caricati";
?>

<?php
    function getLastId($username)
    {
        $pathPartenza = "FileUtenti/$username/Foto/";
        $uploadDir = opendir($pathPartenza);
        $lastId = 0;

        while($nomeFileIntero = readdir($uploadDir))
        {
            $nomeFile = explode(".", $nomeFileIntero)[0];
            if($nomeFile == "." || $nomeFile == "..")
                continue;

            if($lastId < $nomeFile)
                $lastId = $nomeFile;
            echo $nomeFile . "\n";
        }
        closedir($uploadDir);
        return $lastId;
    }
?>