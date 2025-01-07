<?php
    if(!isset($_SESSION))
        session_start();

    if(isset($_SESSION["utente"]))
    {
        header("location: paginaHome.php");
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - SocialApp</title>
        <link rel="icon" href="iconaSito.png" type="image/png">
        <link rel="stylesheet" href="CSS/styleIndex.css">
    </head>
    <body>
        <div class="container">
            <div class="logo">
                <img src="iconaSito.png" alt="SocialApp Logo">
            </div>
            <div class="buttons">
                <a href="paginaLogin.php">
                    <button class="login">Login</button>
                </a>
                <a href="paginaRegistrati.php">
                    <button class="register">Registrati</button>
                </a>
            </div>
        </div>
    </body>
</html>