<?php
require_once "Classi/Post.php";

if (isset($_FILES["file"]) && !empty($_FILES["file"])) 
{
    $fileTmpPath = $_FILES["file"]["tmp_name"];
    $fileName = $_FILES["file"]["name"];

    if ($fileTmpPath == null) {
        header("location: paginaAddPost.php?messaggio=nessun file caricato!");
        exit;
    }

    $fileParts = explode(".", $fileName);
    $estensioneFile = end($fileParts);

    $username = "Marco";
    $pathUtente = "FileUtenti/$username";
    $pathCartellaFoto = "$pathUtente/FotoPost";

    if (!is_dir($pathCartellaFoto)) {
        // 0777 è il permesso di lettura e scrittura
        // true è per le cartelle nidificate che creare se non sono create (si parla delle precedenti)
        mkdir($pathCartellaFoto, 0777, true); 
    }

    $idPost = Post::getLastId($username) + 1;
    $pathFinale = "$pathCartellaFoto/$idPost.$estensioneFile";

    if (file_exists($fileTmpPath) && is_file($fileTmpPath) && is_readable($fileTmpPath)) {
        if (move_uploaded_file($fileTmpPath, $pathFinale)) {
            echo "Successo";
        } else {
            echo "Errore";
        }
    } else {
        echo "Il path non esiste.\n";
    }

    $infoDataPubblicazione = date("Y-m-d H:i:s");

    if (isset($_POST["descrizione"])) {
        $descrizione = $_POST["descrizione"];
    } else {
        $descrizione = "";
    }

    $post = new Post($username, $estensioneFile, $infoDataPubblicazione, $descrizione);
    $post->toCSV();
    header("location: paginaHome.php?popup=post caricato con successo");
} 
else 
{
    echo "No file caricati";
    header("location: paginaLogin.php?messaggio=nessun file caricato!");
}
exit;
?>