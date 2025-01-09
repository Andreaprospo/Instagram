<?php

//solito
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET["pathFoto"])) {
    $pathFoto = $_GET["pathFoto"];
} else {
    //nel caso in cui non mette foto_proflo allora lascio vuoto
    $pathFoto = "";
}

if (isset($_GET["nome"])) {
    $nome = $_GET["nome"];
} else {
    //nel caso in cui non mette nome allora lascio vuoto
    $nome = "";
}

if (isset($_GET["descrizione"])) {
    $descrizione = $_GET["descrizione"];
} else {
    //nel caso in cui non mette descrizione allora lascio vuoto
    $descrizione = "";
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