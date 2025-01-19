<?php
require_once "Classi/Profilo.php";

if (!isset($_SESSION))
    session_start();


$profilo = $_SESSION["utenteCorrente"];

$mail = null;
$descrizione = null;
$fotoProfilo = null;

if(isset($_POST["mail"]))
    $profilo->setMail($_POST["mail"]);

if(isset($_POST["descrizione"]))
    $profilo->setDescrizione($_POST["descrizione"]);

if(isset($_FILES["fotoProfilo"])) 
{
    $fotoProfilo = $_FILES["fotoProfilo"];
    if (!empty($fotoProfilo['name'])) {
        print_r($fotoProfilo);
        $pathFoto = $fotoProfilo['tmp_name'];
        $estensione = pathinfo($fotoProfilo["name"], PATHINFO_EXTENSION);
        if (!$profilo->salvaFotoProfilo($pathFoto, $estensione)) {
            header("location:paginaModificaProfilo.php?messaggio=errore nel caricamento della foto");
            exit;
        }
    }
}  


$profilo->saveInfo();
//Reindirizza alla pagina del profilo
header("location: paginaProfilo.php");
exit;
?>