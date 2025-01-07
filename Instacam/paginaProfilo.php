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
        //TODO: prendere l'username dall'utente loggato
        $username = "Marco";
        $profilo = Profilo::fromCSV($username);
    ?>
    <div id="container">
        <h1>Profilo di <?php echo $profilo->getUsername(); ?></h1>
        <p>Email: <?php echo $profilo->getMail(); ?></p>
        <p>Descrizione: <?php echo $profilo->getDescrizione(); ?></p>
        <p>Seguiti: <?php echo $profilo->getSeguiti(); ?></p>
        <p>Followers: <?php echo $profilo->getFollowers(); ?></p>
        <img src="<?php echo $profilo->getPathFoto(); ?>">

        <h2>Post</h2>
        <div id="post-container">
            <?php
                $posts = Post::getPostsByUser($username);
                foreach ($posts as $post) {
                    echo "<div class='post'>";
                    echo "<img src='" . $post->getPathFoto() . "'>";
                    echo "<p>" . $post->getDescrizione() . "</p>";
                    echo "<p>Pubblicato il: " . $post->getDataPubblicazione() . "</p>";
                    echo "</div>";
                }
            ?>
        </div>

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