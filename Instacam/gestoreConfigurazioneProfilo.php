<?php

if (!(isset($_SESSION)))
    session_start();

require_once "Classi/Profilo.php";
print_r($_SESSION["utenteCorrente"]);
echo "CIOA";

$username = $_SESSION["username"];
$mail = $_SESSION["mail"];
$password = $_SESSION["password"];

$descrizione = $_POST["descrizione"];
$nome = $_POST["nome"];
$fotoProfilo = $_FILES["fotoProfilo"];

if (!isset($username, $mail, $password, $descrizione, $nome, $fotoProfilo) || empty($username) || empty($mail) || empty($password) || empty($descrizione) || empty($nome) || empty($fotoProfilo['name'])) {
    header("location: paginaConfigurazioneProfilo.php?messaggio=inserisci tutti i dati!");
    exit;
}

$profilo = new Profilo($username, $mail, $password, $descrizione, "", $nome);

//salva la foto del profilo
$pathFoto = $fotoProfilo['tmp_name'];
if ($profilo->salvaFotoProfilo($pathFoto)) {
    //salva il profilo
    $profilo->creaGerarchia();
    $profilo->toCSV();

    $_SESSION["descrizione"] = $descrizione;
    $_SESSION["nome"] = $nome;
    $_SESSION["fotoProfilo"] = $profilo->getPathFoto();
    
    header("location: paginaProfilo.php?messaggio=successo");
    $_SESSION["utenteCorrente"] = $profilo;
} else {
    header("location: paginaConfigurazioneProfilo.php?messaggio=errore nel caricamento della foto");
}
?>