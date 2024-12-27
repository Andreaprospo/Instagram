<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Storia</title>
    </head>
    <body>
        <form action="gestoreAddStoria.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="file">Seleziona una foto:</label>
                <input type="file" name="file" id="file" >
            </div>
            <div>
                <label for="">data</label>
                <input type="date" name="data">
            </div>
            <button type="submit">Carica</button>
        </form>
    </body>
</html>