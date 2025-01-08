<?php
require_once "Classi/Profilo.php";
require_once "Classi/Post.php";

// TODO: prendere l'username dall'utente loggato
$username = "Marco";

//recupera il profilo dell'utente
$pathProfilo = "FileUtenti/$username/profilo.csv";
$profilo = Profilo::getProfiloDaUsername($username); 
$profilo->fromCSV($pathProfilo);

//recupera i post dell'utente
$posts = Post::getPostsDaUser($username);
?>