<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="iconaSito.png" type="image/png">
        <link rel="stylesheet" href="CSS/styleMessaggioErrore.css">
        <link rel="stylesheet" href="CSS/styleFooter.css">
        <link rel="stylesheet" href="CSS/stylePaginaAddPost.css">
        <title>ADD POST</title>
    </head>
    <body>
        <?php
            if (isset($_GET["messaggio"]) && !empty($_GET["messaggio"])) {
                echo "<div class=messaggio>ATTENZIONE, $_GET[messaggio]</div>";
            }
        ?>
        <div id="container">
            <form action="gestoreAddPost.php" method="get" enctype="multipart/form-data" id="form">
                <div>
                    <label for="file">SELEZIONA UNA FOTO:</label>
                    <input type="file" name="file" id="file">
                </div>
                <div>
                    <label for="descrizione">DESCRIZIONE</label>
                    <textarea name="descrizione" id="descrizione" rows="4" cols="50"></textarea>
                </div>
                <button type="submit">POSTA</button>
            </form>
        </div>
        <?php
            require_once "footer.php";
        ?>
    </body>
</html>