<?php

class Profilo
{
    //io ho pensato a questi attributi privati (POI FAMMI SAPERE)
    private $username;
    private $mail;
    private $password;
    private $descrizione;
    private $nome;
    private $pathFoto;
    private $seguiti = [];
    private $followers = [];
    private $post = [];
    private $stories = [];
    
    public function __construct($username, $mail, $password, $descrizione, $pathFoto, $nome) {
        $this->username = $username;
        $this->mail = $mail;
        $this->password = $password;
        $this->descrizione = $descrizione;
        $this->pathFoto = $pathFoto;
        $this->nome = $nome;
    }

    public function salvaFotoProfilo($pathFoto)
    {
        $directory = "FileUtenti/$this->username";
        $estensione = pathinfo($pathFoto, PATHINFO_EXTENSION);
        $targetFile = $directory . "/fotoProfilo." . $estensione;

        //controlla se la directory esiste, altrimenti la crea
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        //sposta il file caricato nella directory dell'utente
        if (move_uploaded_file($pathFoto, $targetFile)) {
            $this->pathFoto = $targetFile;
            return true;
        } else {
            return false;
        }
    }

    
    public static function getProfiloDaUsername($username) {

        $pathProfilo = "./FileUtenti/$username/FileInfo.csv";

        if (file_exists($pathProfilo)) {
            $dati = file_get_contents($pathProfilo);
            $dati = explode(";", $dati);
            return new Profilo(
                $dati[0],
                $dati[1],
                $dati[2],
                $dati[3],
                $dati[4],
                $dati[5],
            );
        } else {
            return null;
        }
    }
    

    // SENZA controlli le set (NO CONTROLLI)

    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getMail()
    {
        return $this->mail;
    }
    public function setMail($mail)
    {
        $this->mail = $mail;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getDescrizione()
    {
        return $this->descrizione;
    }
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }
    public function getPathFoto()
    {
        return $this->pathFoto;
    }
    public function setPathFoto($pathFoto)
    {
        $this->pathFoto = $pathFoto;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function aggiungiSeguito($username)
    {
        if (!in_array($username, $this->seguiti)) {
            $this->seguiti[] = $username;
            file_put_contents("./FileUtenti/$this->username/FileSeguiti.csv", $username . "\n", FILE_APPEND);
            file_put_contents("./FileUtenti/$username/FileFollowers.csv", $this->username . "\n",FILE_APPEND);
        }
    }
    public function aggiungiPost($post)
    {
        $this->post[] = $post;
    }

    public function getSeguiti() {

        $info = file_get_contents("./FileUtenti/$this->username/FileSeguiti.csv");
        $allUsernameUser = explode("\n", $info);
        $allUser = [];
        foreach ($allUsernameUser as $username) {
            if($username == null)
                continue;
            $allUser[] = Profilo::fromCSV($username);
        }
        $this->seguiti = $allUser;
        return $this->seguiti;

    }

    public function getFollowers() {

        $info = file_get_contents("./FileUtenti/$this->username/FileFollowers.csv");
        $allUsernameUser = explode( "\n", $info);
        $allUser = [];
        foreach ($allUsernameUser as $username) {
            if($username == null)
                continue;
            $allUser[] = Profilo::fromCSV($username);
        }
        $this->followers = $allUser;
        return $this->followers ;
    }

    public function getPost() {

        $allPost = [];
        $info = file_get_contents("./FileUtenti/$this->username/FilePubblicazione.csv");
        $allPubblicazione = explode("\n", $info);
        foreach($allPubblicazione as $pubblicazione)
        {
            if($pubblicazione == null)
                continue;
            $campi = explode(";", $pubblicazione);
            if($campi[1] == "Post")
                $allPost[] = Post::parse($campi);
        }
        $this->post = $allPost;
        return $this->post;
   
    }
    public function getStories() {

        $allStories = [];
        $info = file_get_contents("./FileUtenti/$this->username/FilePubblicazione.csv");
        $allPubblicazione = explode("\n", $info);
        foreach($allPubblicazione as $pubblicazione)
        {
            if($pubblicazione == null)
                continue;
            $campi = explode(";", $pubblicazione);
            if($campi[1] == "Storia")
            {
                if(!Storia::checkDate($campi[4]))
                    $allStories[] = Storia::parse($campi);
            }
        }
        $this->stories = $allStories;
        return $this->stories;
    }
    public function toCSV()
    {
        $path = "./FileUtenti/$this->username/FileInfo.csv";
        $dati = "$this->username;$this->mail;$this->password;$this->descrizione;$this->pathFoto;$this->nome;\n";
        file_put_contents($path, $dati);
    }
    public static function fromCSV($username)
    {
        $path = "./FileUtenti/$username";
        if(file_exists($path))
        {
            $dati = file_get_contents("$path/FileInfo.csv");
            $arrayDati = explode(";", $dati);
            require_once "Classi/Profilo.php";
            return new Profilo($arrayDati[0], $arrayDati[1],$arrayDati[2], $arrayDati[3], $arrayDati[4], $arrayDati[5]);
        }      
        return null;
    }

    public function creaGerarchia()
    {
        $pathUtente = "./FileUtenti/$this->username";
        mkdir($pathUtente, 0777, true); 
        mkdir($pathUtente . "/CartellaCommenti", 0777, true); 
        mkdir($pathUtente . "/FotoPost", 0777, true); 
        mkdir($pathUtente . "/FotoStoria", 0777, true); 
        file_put_contents($pathUtente . "/FileFollowers.csv", "", FILE_APPEND);
        file_put_contents($pathUtente . "/FileInfo.csv", "", FILE_APPEND);
        file_put_contents($pathUtente . "/FileLikePost.csv", "", FILE_APPEND);
        file_put_contents($pathUtente . "/FilePubblicazione.csv", "", FILE_APPEND);
        file_put_contents($pathUtente . "/FileSeguiti.csv", "", FILE_APPEND);
        file_put_contents($pathUtente . "/FileCommenti.csv", "", FILE_APPEND);
        copy("./fotoProfiloBase.jpg", "$pathUtente/fotoProfilo.jpg");
    }


}