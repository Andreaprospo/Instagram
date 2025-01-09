<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="iconaSito.png" type="image/png">
    <link rel="stylesheet" href="CSS/styleMessaggioErrore.css">
    <link rel="stylesheet" href="CSS/styleFooter.css">
    <link rel="stylesheet" href="CSS/stylePaginaRegistrati.css">
    <title>REGISTRAZIONE</title>
</head>
<body>
    <form action="gestoreRegistrati.php" method="get">
        <div>
            <label for="mail">MAIL</label>
            <input type="mail" id="mail" name="mail">
        </div>
        <div>
            <label for="username">USERNAME</label>
            <input type="text" id="username" name="username">
        </div>
        <div>
            <label for="password">PASSWORD</label>
            <input type="password" id="password" name="password">
        </div>
        <button>CONFIGURA PROFILO</button>
    </form>
</body>
</html>