<?php
    require_once "Classi/Profilo.php";

    if(!isset($_GET["password"], $_GET["password"]) || empty($_GET["username"]) || empty($_GET["username"]))
    {
        header("location: paginaLogin.php?messaggio=Inserisci tutti i dati");
        exit;
    }

    $username = $_GET["username"];

    if(is_dir("FileUtenti/$username"))
    {
        $password = Profilo::fromCSV($username)->getPassword();
        if($password == $_GET["password"])
            header("location: paginaHome.php");
        else
            header("location: paginaLogin.php?messaggio=Password errata");
        exit;
    }
    else
    {
        header("location: paginaLogin.php?messaggio=Utente non esistente");
    }

?>
