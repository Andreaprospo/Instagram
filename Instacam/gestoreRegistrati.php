<?php
require_once "Classi/Profilo.php";

if (!isset($_GET["username"], $_GET["password"], $_GET["mail"]) || empty($_GET["username"]) || empty($_GET["password"]) || empty($_GET["mail"])) {
    header("location: paginaRegistrazione.php?messaggio=inserisci tutti i dati!");
    exit;
}

$username = $_GET["username"];
$password = $_GET["password"];
$mail = $_GET["mail"];


header()



?>