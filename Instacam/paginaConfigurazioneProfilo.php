<!DOCTYPE html>
<html lang="it">
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
    
    <form action="gestoreConfigurazioneProfilo.php" method="post" enctype="multipart/form-data">

        <div>
            <label for="fotoProfilo">FOTO PROFILO</label>
            <input type="file" id="fotoProfilo" name="fotoProfilo" accept="image/*">
        </div>

        <div>
            <label for="nome">NOME</label>
            <input type="text" id="nome" name="nome">
        </div>

        <div>
            <label for="descrizione">DESCRIZIONE</label>
            <input type="text" id="descrizione" name="descrizione">
        </div>
        
        <button>REGISTRATI</button>
    </form>
</body>
</html>