<?php
require_once "Classi/Profilo.php";

if(!isset($_SESSION))
    session_start();


$username = $_SESSION["utenteCorrente"]->getUsername();
$pathUtente = "./FileUtenti/$username";

if(isset($_SESSION["utenteCorrente"]))
    $_SESSION["utenteCorrente"] = null;

session_destroy();

//elimina la cartella dell'utente e tutto quello che c'è dentro così praticamente elimina il profilo
if (deleteDirectoryContents($pathUtente)) {
    header("location:index.php?messaggio=profilo eliminato con successo");
} else {
    header("location:paginaProfilo.php?messaggio=errore nell'eliminazione del profilo");
}
exit;
?>
<?php
    function deleteDirectoryContents($dir) {
        // Controlla se la directory esiste ed è effettivamente una directory
        if (!file_exists($dir) || !is_dir($dir)) {
            return false;
        }

        // Scansiona il contenuto della directory
        foreach (scandir($dir) as $item) {
            // Salta i riferimenti speciali "." e ".."
            if ($item === '.' || $item === '..') {
                continue;
            }

            // Costruisci il percorso completo
            $path = $dir . DIRECTORY_SEPARATOR . $item;

            // Se è una directory, richiama la funzione ricorsivamente e poi rimuovila
            if (is_dir($path)) {
                deleteDirectoryContents($path);
                rmdir($path);
            } else {
                // Se è un file, eliminalo
                unlink($path);
            }
        }

        // Elimina la directory corrente
        return rmdir($dir);
    }
?>