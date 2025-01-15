<?php

if (!(isset($_SESSION)))
    session_start();

require_once "Classi/Profilo.php";

$username = $_GET["username"];
$password = $_GET["password"];
$mail = $_GET["mail"];

if (!isset($_GET["username"], $_GET["password"], $_GET["mail"]) || empty($_GET["username"]) || empty($_GET["password"]) || empty($_GET["mail"])) {
    header("location: paginaRegistrazione.php?messaggio=inserisci tutti i dati!");
    exit;
}

// Controllo che tra gli utenti (tra i file) caricati ce ne sia uno con lo stesso "$username"
$directory = '/FileUtenti';
$files = scandir($directory);

// Controllo che tra gli utenti (tra i file) caricati ce ne sia uno con lo stesso "$nomeUtente"
$directory = 'FileUtenti';
$fileUtenti = scandir($directory);

foreach ($fileUtenti as $fileUtente) {
    if ($fileUtente !== '.' && $fileUtente !== '..') {
        $percorsoFileDiInformazioniUtente = $directory . '/' . $fileUtente . '/FileInfo.csv';
        if (file_exists($percorsoFileDiInformazioniUtente)) {
            $contenutoFile = file_get_contents($percorsoFileDiInformazioniUtente);
            $righe = explode("\n", $contenutoFile);
            foreach ($righe as $riga) {
                $dati = str_getcsv($riga);
                if ($dati[0] === $username) {
                    header("location: paginaRegistrazione.php?messaggio=nome utente già in uso!");
                    exit;
                }
            }
        }
    }
}

// Controllo che la mail non sia già in uso da nessun utente (tra i file) caricati
foreach ($fileUtenti as $fileUtente) {
    if ($fileUtente !== '.' && $fileUtente !== '..') {
        $percorsoFileDiInformazioniUtente = $directory . '/' . $fileUtente . '/FileInfo.csv';
        if (file_exists($percorsoFileDiInformazioniUtente)) {
            $contenutoFile = file_get_contents($percorsoFileDiInformazioniUtente);
            //PHP_EOL è il separatore di riga è una costante predefinita in PHP 
            $righe = explode("\n", $contenutoFile);
            foreach ($righe as $riga) {
                $dati = str_getcsv($riga);
                if ($dati[2] === $mail) {
                    header("location: paginaRegistrazione.php?messaggio=mail già in uso!");
                    exit;
                }
            }
        }
    }
}

// Salva in sessione l'utente appena registrato
$_SESSION["username"] = $username;
$_SESSION["password"] = $password;
$_SESSION["mail"] = $mail;

header("location: paginaConfigurazioneProfilo.php?messaggio=successo");
?>