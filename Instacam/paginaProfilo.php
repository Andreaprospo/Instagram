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

        //variabile appoggio
        $username = $_GET["utente"];
        //piglio il profilo dall'username
        $profilo = Profilo::getProfiloDaUsername($username);
    ?>

    <div id="header">
        <a href="paginaHome.php">HOME</a>
        <a href="paginaAddPost.php">AGGIUNGI POST</a>
        <a href="paginaAddStoria.php">AGGIUNGI STORIA</a>
    </div>

    <div id="container">
        <h1>Profilo di <?php echo $profilo->getUsername(); ?></h1>
        <p>Email: <?php echo $profilo->getMail(); ?></p>
        <p>Descrizione: <?php echo $profilo->getDescrizione(); ?></p>

        <h2>Seguiti</h2>
        <ul>
            <?php
                $seguiti = $profilo->getSeguiti();
                foreach ($seguiti as $seguito) {
                    echo "<li>" . htmlspecialchars($seguito) . "</li>";
                }
            ?>
        </ul>

        <h2>Followers</h2>
        <ul>
            <?php
                $followers = $profilo->getFollowers();
                foreach ($followers as $follower) {
                    echo "<li>" . htmlspecialchars($follower) . "</li>";
                }
            ?>
        </ul>

        <img src="<?php echo $profilo->getPathFoto(); ?>" alt="Foto Profilo">

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