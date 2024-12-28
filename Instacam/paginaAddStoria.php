<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="iconaSito.png" type="image/png">
        <title>Add Storia</title>
    </head>
    <body>
        <form action="gestoreAddStoria.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="file">Seleziona una foto:</label>
                <input type="file" name="file" id="file" >
            </div>
            <button type="submit">Carica</button>
        </form>
        <?php
            require_once "footer.php";
        ?>
    </body>
</html>