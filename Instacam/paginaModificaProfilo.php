<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="iconaSito.png" type="image/png">
    <link rel="stylesheet" href="CSS/styleProfilo.css">
    <link rel="stylesheet" href="CSS/styleFooter.css">
    <title>MODIFICA PROFILO</title>
</head>
<body>
    <?php
        require_once "Classi/Profilo.php";

        if (!isset($_SESSION))
            session_start();

        $username = $_SESSION["utenteCorrente"]->getUsername();
        //piglio il profilo dall'username
        $profilo = Profilo::getProfiloDaUsername($username);

    ?>
    <?php
        require_once "footer.php";
    ?>

    <div id="container">
        <h1>Modifica Profilo di <?php echo htmlspecialchars($profilo->getUsername()); ?></h1>

        <form action="gestoreModificaProfilo.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="fotoProfilo">FOTO PROFILO</label>
                <input type="file" id="fotoProfilo" name="fotoProfilo" accept="image/*">
            </div>

            <div>
                <label for="nome">NOME</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($profilo->getNome()); ?>">
            </div>

            <div>
                <label for="mail">EMAIL</label>
                <input type="email" id="mail" name="mail" value="<?php echo htmlspecialchars($profilo->getMail()); ?>">
            </div>

            <div>
                <label for="descrizione">DESCRIZIONE</label>
                <textarea id="descrizione" name="descrizione" cols="30" rows="10"><?php echo htmlspecialchars($profilo->getDescrizione()); ?></textarea>
            </div>

            <button type="submit">Salva Modifiche</button>
        </form>

        <form action="gestoreEliminaProfilo.php" method="post">
            <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <button type="submit">Elimina Profilo</button>
        </form>
    </div>
    <?php
        require_once "footer.php";
    ?>
</body>
</html>