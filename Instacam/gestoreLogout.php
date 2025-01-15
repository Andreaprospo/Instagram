<?php
    session_start();
    if(!isset($_SESSION))
        if(isset($_SESSION["utenteCorrente"]))
            $_SESSION["utenteCorrente"] = null;
    session_destroy();
    header("location: index.php?messaggio=hai effettuato correttamente il logout");
    exit;
?>
