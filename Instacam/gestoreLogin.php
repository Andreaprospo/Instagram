<?php
    require_once "Classi/Profilo.php";

    if(!isset($_GET["password"], $_GET["password"]) || empty($_GET["username"]) || empty($_GET["username"]))
    {
        header("location: paginaLogin.php?messaggio=inserisci tutti i dati!");
        exit;
    }

    $username = $_GET["username"];

    if(is_dir("./FileUtenti/$username"))
    {
        $profilo = Profilo::fromCSV($username);
        
        $password = $profilo->getPassword();
        if($password == $_GET["password"])
        {
            if(!isset($_SESSION))
                session_start();

            $_SESSION["utenteCorrente"] = $profilo;
            echo "save";
            header("location:paginaHome.php");
            exit;
        }
        else
        {

        }
        header("location: paginaLogin.php?messaggio=password errata!");
        exit;
    }
    else
    {
        header("location: paginaLogin.php?messaggio=utente non esistente!");
        exit;

    }
?>