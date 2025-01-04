<?php
    if (!isset($_GET["mail"], $_GET["password"], $_GET["username"]) || empty($_GET["mail"]) || empty($_GET["password"]) || empty($_GET["username"])) {
        header("location: paginaRegistrati.php?messaggio=Inserisci tutti i dati richiesti");
        exit;
    }

    $mail = trim($_GET["mail"]);
    $password = trim($_GET["password"]);
    $nomeUtente = trim($_GET["nomeUtente"]);

    $fileUtenti = "../FileUtenti/utenti.csv";

    $righe = [];

    if (file_exists($fileUtenti)) {
        $fileContent = file($fileUtenti);
        foreach ($fileContent as $linea) {
            $linea = trim($linea);
            if (!empty($linea)) {
                $righe[] = $linea;
            }
        }
    } else {
        file_put_contents($fileUtenti, "");
    }

    foreach ($righe as $riga) {
        $datiUtente = explode(";", $riga);
        if ($datiUtente[1] === $nomeUtente || $datiUtente[0] === $mail) {
            header("location: paginaRegistrati.php?messaggio=Nome utente o mail già in uso");
            exit;
        }
    }

    $id = count($righe) + 1;
    $nuovoUtente = "$mail;$nomeUtente;$password;$id";
    file_put_contents($fileUtenti, $nuovoUtente . PHP_EOL, FILE_APPEND);

    $pathUtente = "../FileUtenti/$id";
    if (!file_exists($pathUtente)) {
        mkdir($pathUtente, 0777, true);
    }

    file_put_contents("$pathUtente/{$nomeUtente}_FileInfo.csv", "$nomeUtente;$id;$mail;$password;;");
    file_put_contents("$pathUtente/{$nomeUtente}_FilePost.csv", "$nomeUtente;");
    file_put_contents("$pathUtente/{$nomeUtente}_FileFollowers.csv", "$nomeUtente;");
    file_put_contents("$pathUtente/{$nomeUtente}_FileSeguiti.csv", "$nomeUtente;");

    header("location: paginaLogin.php?messaggio=Registrazione completata con successo");
    exit;
?>