<?php
require_once "Classi/Profilo.php";

$username = $_POST['username'];
$pathUtente = "./FileUtenti/$username";

//elimina la cartella dell'utente e tutto quello che c'è dentro così praticamente elimina il profilo
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }
    if (!is_dir($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }
    return rmdir($dir);
}

if (deleteDirectory($pathUtente)) {
    header("location: Index.php?messaggio=profilo eliminato con successo");
} else {
    header("location: paginaProfilo.php?messaggio=errore nell'eliminazione del profilo");
}
exit;
?>