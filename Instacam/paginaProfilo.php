<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="iconaSito.png" type="image/png">
        <link rel="stylesheet" href="CSS/styleProfilo.css">
        <link rel="stylesheet" href="CSS/styleFooter.css">
        <title>Profilo</title>
    </head>
    <body>
        <?php
            require_once "Classi/Profilo.php";
            require_once "Classi/Post.php";

            if (!isset($_SESSION))
                session_start();
            //variabile appoggio
            $utenteCorrente = $_SESSION["utenteCorrente"];
            //piglio il profilo dall'username
        ?>

        <div id="container">
            <h1>Profilo di <?php echo $utenteCorrente->getUsername(); ?></h1>
            <img src="<?php echo $utenteCorrente->getPathFoto(); ?>" alt="Foto Profilo">
            <p>Email: <?php echo $utenteCorrente->getMail(); ?></p>
            <p>Descrizione: <?php echo $utenteCorrente->getDescrizione(); ?></p>

            <h2>Seguiti</h2>
            <ul>
                <?php
                $seguiti = $utenteCorrente->getSeguiti();
                foreach ($seguiti as $seguito) {
                    if($seguito == null)
                        continue;
                    echo "<li>" . $seguito->getUsername() . "</li>";
                }
                ?>
            </ul>

            <h2>Followers</h2>
            <ul>
            <?php
                $followers = $utenteCorrente->getFollowers();
                foreach ($followers as $follower) {
                    if($follower == null)
                        continue;
                    echo "<li>" . $follower->getUsername() . "</li>";
                }
                ?>
            </ul>

            

            <h2>Post</h2>
            <div id="container2">
                <?php
                $posts = $utenteCorrente->getPost();
                foreach ($posts as $post) {
                    echo "<div class='post'>";
                    echo "<img src='" . $post->getPathFoto() . "'>";
                    echo "<p>" . $post->getDescrizione() . "</p>";
                    echo "<p>Pubblicato il: " . $post->getDataPubblicazione() . "</p>";
                    echo "</div>";
                }
                ?>
            </div>

            <form action="paginaModificaProfilo.php" method="get">
                <button type="submit">Modifica Profilo</button>
            </form>

            <form action="gestoreEliminaProfilo.php" method="post">
                <button type="submit">Elimina Profilo</button>
            </form>

            <form action="gestoreLogout.php" method="post">
                <input type="hidden" name="comando" value="logout">
                <button type="submit">Logout</button>
            </form>
        </div>
        <?php
            require_once "footer.php";
        ?>
    </body>
</html>