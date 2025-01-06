<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="iconaSito.png" type="image/png">
        <link rel="stylesheet" href="CSS/styleMessaggioErrore.css">
        <link rel="stylesheet" href="CSS/styleFooter.css">
        <link rel="stylesheet" href="CSS/stylePaginaAddStoria.css">
        <title>Add Storia</title>
    </head>
    <body>
        <?php
            if (isset($_GET["messaggio"]) && !empty($_GET["messaggio"])) {
                echo "<div class=messaggio>Occhio, $_GET[messaggio]</div>";
            }
        ?>
        <div id = "container">
            <form action="gestoreAddStoria.php" method="post" enctype="multipart/form-data" id = "form">
                    <div>
                        <label for="file">Seleziona una foto:</label>
                        <input type="file" name="file" id="file" >
                    </div>
                    <button type="submit">Carica</button>
            </form>
        </div>
        <?php
            require_once "footer.php";
        ?>
    </body>
</html>