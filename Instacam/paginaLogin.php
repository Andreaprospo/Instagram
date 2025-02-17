<?php
    require_once "Classi/Profilo.php";

    if(!isset($_SESSION))
        session_start();
    
    if(isset($_SESSION["utenteCorrente"]))
    {
        header("location:paginaHome.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="iconaSito.png" type="image/png">
    <link rel="stylesheet" href="CSS/stylePaginaLogin.css">
    <link rel="stylesheet" href="CSS/styleMessaggioErrore.css">
    <title>Pagina Login</title>
</head>
    <body>
        <div class="container">
            <?php
                if (isset($_GET["messaggio"]) && !empty($_GET["messaggio"])) {
                    echo "<div class=messaggio>Occhio, $_GET[messaggio]</div>";
                }
            ?>
            <form action="gestoreLogin.php" id = "mainForm">
                <div>
                    <label for="username">Username</label>
                    <input type="text" id = "username" name = "username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id = "password" name = "password">
                </div>
                <button>Manda</button>
            </form>
            <form action="paginaRegistrati.php">
                <button>Registrati</button>
            </form>
        </div>
    </body>
</html>