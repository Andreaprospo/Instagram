<?php
    require_once "Classi/Profilo.php";

    if(isset($_GET["username"]) && !empty($_GET["username"]))
    {
        if(!isset($_SESSION))
            session_start();
        $utenteDaSeguire = $_GET["username"];
        $utenteCorrente = $_SESSION["utenteCorrente"];
        $utenteCorrente->aggiungiSeguito($utenteDaSeguire);
        header("location:paginaHome.php");
        exit;
    }
?>