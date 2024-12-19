<?php
    if(!isset($_GET["user"], $_GET["password"]) || empty($_GET["user"]) || empty($_GET["user"]))
    {
        header("location: paginaLogin.php?messaggio=Inserisci tutti i dati");
        exit;
    }
?>