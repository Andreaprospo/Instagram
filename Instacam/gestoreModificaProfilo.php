<?php

    if (!(isset($_SESSION)))
        session_start();

    //piglio i dati dalla get
    $nomeUtente = $_GET['moficaUsername'];
    $email = $_GET['moficaEmail'];
    $descrizione = $_GET['moficaDescrizione'];

    //PATH
    $percorsoFileInfo = "./FileUtenti/$nomeUtente/fileInfo.csv";

    //devo andare a copiare quello che c'è scritto dentro per poterlo modificare
    //quindi prima copio le informazioni e le metto nel vettore in locazioni differenti
    //poi vado a sovrascrivere ogni campo

    //esempio:
    //[0] = nomeUtente
    //[1] = mail
    //[2] = password
    //[3] = descrizione 
    //TODO: devo creare nuova pagina configurazione profilo con inserimento immagine profilo e descrizione

    //vado a sovrascrivere nel file con il metodo toCsv

    $vettoreAppoggio[]; //dove vado a storarmi le modifiche che poi devo scrivermi nel file
    //vado a sovrascrivere i dati del profilo

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

    header("Location: paginaProfilo.php?username=$nomeUtente");
    exit;
?>