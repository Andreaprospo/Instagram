<?php
require_once "Classi/Profilo.php";

if (!isset($_SESSION))
    session_start();


$username = $_SESSION["utenteCorrente"]->getUsername();
$profilo = Profilo::getProfiloDaUsername($username);

$nome = $_POST['nome'];
$mail = $_POST['mail'];
$descrizione = $_POST['descrizione'];
$fotoProfilo = $_FILES['fotoProfilo'];

// Verifica che tutti i campi siano stati inseriti
if (!isset($nome, $mail, $descrizione) || empty($nome) || empty($mail) || empty($descrizione)) {
    header("Location: paginaModificaProfilo.php?messaggio=inserisci tutti i dati!");
    exit;
}

// Aggiorna i dati del profilo
$profilo->setNome($nome);
$profilo->setMail($mail);
$profilo->setDescrizione($descrizione);

// Salva la nuova foto del profilo se è stata caricata
if (!empty($fotoProfilo['name'])) {
    $pathFoto = $fotoProfilo['tmp_name'];
    if (!$profilo->salvaFotoProfilo($pathFoto)) {
        header("Location: paginaModificaProfilo.php?messaggio=errore nel caricamento della foto");
        exit;
    }
}

// Salva i dati aggiornati nel file
$profilo->toCSV();

// Aggiorna la sessione
$_SESSION["nome"] = $nome;
$_SESSION["mail"]=$mail;
$_SESSION["descrizione"]=$descrizione;

$_SESSION["utenteCorrente"] = $profilo;

// Reindirizza alla pagina del profilo
header("Location: paginaProfilo.php?username=$username");
exit;
?>