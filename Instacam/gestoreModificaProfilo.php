<?php
if (!(isset($_SESSION)))
    session_start();

//piglio i dati 
$nomeUtente = $_GET['username'];
$nome = $_GET['nome'];
$email = $_GET['email'];
$descrizione = $_GET['descrizione'];


$percorsoFileInfo = "path/to/fileInfo.csv";
$datiProfilo = array_map('str_getcsv', file($percorsoFileInfo));
$intestazione = array_shift($datiProfilo);

//vado a pescarmi il profilo a cui devo aggiornare i dati
$indiceUtente = 0;
foreach ($datiProfilo as $indice => $dati) {
    if ($dati[0] == $nomeUtente) {
        $indiceUtente = $indice;
        break;
    }
}

//vado a sovrascrivere i dati del profilo
if ($indiceUtente != 0) {
    if (!empty($nome)) {
        $datiProfilo[$indiceUtente][1] = $nome;
    }
    if (!empty($email)) {
        $datiProfilo[$indiceUtente][2] = $email;
    }
    if (!empty($descrizione)) {
        $datiProfilo[$indiceUtente][3] = $descrizione;
    }

    //questo mi serve per scriverlo su file
    $file = fopen($percorsoFileInfo, 'w');
    fputcsv($file, $intestazione);
    foreach ($datiProfilo as $riga) {
        fputcsv($file, $riga);
    }
    fclose($file);


    //questo mi serve per aggiornare la sessione
    $_SESSION['utenteCorrente']['nome'] = $nome;
    $_SESSION['utenteCorrente']['email'] = $email;
    $_SESSION['utenteCorrente']['descrizione'] = $descrizione;


    //questo mi serve per aggiornare l'oggetto profilo
    $_SESSION['profilo']->setNome($nome);
    $_SESSION['profilo']->setEmail($email);
    $_SESSION['profilo']->setDescrizione($descrizione);
}

header("Location: paginaProfilo.php?username=$nomeUtente");
exit;

?>