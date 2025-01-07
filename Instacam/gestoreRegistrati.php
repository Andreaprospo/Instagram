<?php
require_once "Classi/Profilo.php";

if (!isset($_GET["username"], $_GET["password"], $_GET["mail"]) || empty($_GET["username"]) || empty($_GET["password"]) || empty($_GET["mail"])) {
    header("location: paginaRegistrazione.php?messaggio=inserisci tutti i dati!");
    exit;
}

$username = $_GET["username"];
$password = $_GET["password"];
$mail = $_GET["mail"];

//nel caso in cui non mette descrizione allora lascio vuoto
if (isset($_GET["descrizione"])) {
    $descrizione = $_GET["descrizione"];
} else {
    $descrizione = "";
}

//nel caso in cui non mette foto allora lascio vuoto
if (isset($_GET["pathFoto"])) {
    $pathFoto = $_GET["pathFoto"];
} else {
    $pathFoto = "";
}

$pathUtente = "FileUtenti/$username";
if (is_dir($pathUtente)) {
    header("location: paginaRegistrazione.php?messaggio=utente già esistente!");
    exit;
} else {
    $profilo = new Profilo($username, $mail, $password, "");
    $profilo->creaGerarchia();
    $profilo->toCSV();

    header("location: paginaLogin.php?messaggio=registrazione avvenuta con successo!");
    exit;
}
?>