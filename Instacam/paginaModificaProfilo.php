<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="iconaSito.png" type="image/png">
        <link rel="stylesheet" href="CSS/styleProfilo.css">
        <link rel="stylesheet" href="CSS/styleFooter.css">
        <title>Pagina Modifica Profilo</title>
    </head>
    <body>
        <?php
            require_once "Classi/Profilo.php";

            if (!isset($_SESSION))
                session_start();

            //variabile appoggio
            $username = $_SESSION["utenteCorrente"]->getUsername();
            //piglio il profilo dall'username
            $profilo = Profilo::getProfiloDaUsername($username);
        ?>
        <?php
            require_once "footer.php";
        ?>

        <div id="container">

            <h1>Pagina Modifica Pofilo</h1>

            <form action="gestoreModificaPaginaProfilo.php" method="get">
                <h2>Profilo di </h2>
                <textarea name="moficaUsername" id="moficaUsername" cols="30" rows="10" value="<?php echo $profilo->getUsername(); ?>"></textarea>

                <h2>Email </h2>
                <textarea name="moficaEmail" id="moficaEmail" cols="30" rows="10" value="<?php echo $profilo->getEmail(); ?>"></textarea>

                <h2>Descrizione </h2>
                <textarea name="moficaDescrizione" id="moficaDescrizione" cols="30" rows="10" value="<?php echo $profilo->getDescrizione(); ?>"></textarea>
            </form>

            <form action="gestoreEliminaProfilo.php" method="post">
                <input type="hidden" name="username" value="<?php echo $username; ?>">
                <button type="submit">Elimina Profilo</button>
            </form>
        </div>
        <?php
            require_once "footer.php";
        ?>
    </body>
</html>
