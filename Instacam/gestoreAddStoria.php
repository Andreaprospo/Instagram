<?php

    if (isset($_FILES['file'])) 
    {

        //prendo info dal file
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
      
        $estensioneFile = explode(".", $fileName)[1];

        //nome utente che prendo dalla sessione 
        //$username = $_SESSION["utente"];
        $username = "Marco";
        $pathCartellaFoto = "FileUtenti/$username/Foto";

        if (!is_dir($pathCartellaFoto)) {
            mkdir($pathCartellaFoto, 0777, true); // Crea la directory se non esiste
        }

        //prendo l'ultimo id della storia così da identificarlo univocamente
        $idStoria = getLastId($username) + 1;

        //combino il nome utente e metto id 
        $pathFinale = "$pathCartellaFoto/$idStoria.$estensioneFile";

        if (move_uploaded_file($fileTmpPath, $pathFinale))
            echo "Successo";
        else
            echo "Errore";

    } 
    else 
    {
        echo "No file caricati";
    }

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