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
            $username = $_SESSION["utenteCorrente"]->getUsername();
            //piglio il profilo dall'username
            $profilo = Profilo::getProfiloDaUsername($username);
        ?>
        <?php
            require_once "footer.php";
        ?>

        <div id="container">
            <h1>Profilo di <?php echo $profilo->getUsername(); ?></h1>
            <img src="<?php echo $profilo->getPathFoto(); ?>" alt="Foto Profilo">
            <p>Email: <?php echo $profilo->getMail(); ?></p>
            <p>Descrizione: <?php echo $profilo->getDescrizione(); ?></p>

            <h2>Seguiti</h2>
            <ul>
                <?php
                $seguiti = $profilo->getSeguiti();
                foreach ($seguiti as $seguito) {
                    echo "<li>" . $seguito . "</li>";
                }
                ?>
            </ul>

            <h2>Followers</h2>
            <ul>
                <?php
                $followers = $profilo->getFollowers();
                foreach ($followers as $follower) {
                    echo "<li>" . $follower. "</li>";
                }
                ?>
            </ul>

            

            <h2>Post</h2>
            <div id="container2">
                <?php
                $posts = Post::getPostsDaUser($username);
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
                <input type="hidden" name="username" value="<?php echo $username; ?>">
                <button type="submit">Modifica Profilo</button>
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