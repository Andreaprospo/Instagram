<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
        <form action="gestoreAddStoria.php" method="POST">
            <div>
                <label for="file">Seleziona una foto:</label>
                <input type="file" name="file" id="file" accept="image/*">
            </div>
            <div>
                <label for="">data</label>
                <input type="date" name="data">
            </div>
            <button>Manda</button>
        </form>
    </body>
</html>