<?php

class Profilo
{
    //io ho pensato a questi attributi privati (POI FAMMI SAPERE)
    private $username;
    private $mail;
    private $password;
    private $descrizione;
    private $pathFoto;
    private $seguiti = [];
    private $followers = [];
    private $post = [];
    private $stories = [];
    
    public function __construct($username, $mail, $password, $descrizione) {
        $this->username = $username;
        $this->mail = $mail;
        $this->password = $password;
        $this->descrizione = $descrizione;
        $foto = "./FileUtenti/$this->username/fotoProfilo.jpg";
        if(!file_exists($foto))
            $foto = "";
        $this->pathFoto = $foto;
        $this->seguiti = $this->getSeguiti();
    }
    public static function getProfiloDaUsername($username) {

        $pathProfilo = "FileUtenti/$username/FileInfo.csv";

        if (file_exists($pathProfilo)) {
            $dati = file_get_contents($pathProfilo);
            $dati = explode(";", $dati);
            return new Profilo(
                $dati[0],
                $dati[1],
                $dati[2],
                $dati[3],
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

    public function aggiungiSeguito($username)
    {
        if (!in_array($username, $this->seguiti)) {
            $this->seguiti[] = $username;
            file_put_contents("./FileUtenti/$this->username/FileSeguiti.csv", $username . "\n", FILE_APPEND);
            file_put_contents("./FileUtenti/$username/FileFollowers.csv", $this->username . "\n",FILE_APPEND);
        }
    }

    // public function aggiungiFollower($username)
    // {
    //     if (!in_array($username, $this->followers)) {
    //         $this->followers[] = $username;
    //     }
    // }
    public function aggiungiPost($post)
    {
        $this->post[] = $post;
    }

    public function getSeguiti() {

        $info = file_get_contents("./FileUtenti/$this->username/FileSeguiti.csv");
        $allUsernameUser = explode( "\n", $info);
        $allUser = [];
        foreach ($allUsernameUser as $username) {
            if($username == null)
                continue;
            $allUser[] = Profilo::fromCSV($username);
        }
        $this->seguiti = $allUser;
        return $this->seguiti ;

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
        $vettorePost = [];
        for ($i = 0; $i < count($this->post); $i++) {
            $vettorePost[] = $this->post[$i];
        }
        return $vettorePost;
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
                $allStories[] = Storia::parse($campi);
        }
        $this->stories = $allStories;
        return $this->stories;

    }
    public function toCSV()
    {
        $path = "./FileUtenti/$this->username/FileInfo.csv";
        $dati = "$this->username;$this->mail;$this->password;$this->descrizione";
        file_put_contents($path, $dati);
    }
    public static function fromCSV($username)
    {
        $path = "./FileUtenti/$username";
        if(file_exists($path))
        {
            $dati = file_get_contents("$path/FileInfo.csv");
            $arrayDati = explode(";", $dati);
    
            $foto = "fotoProfilo.jpg";
            if(!file_exists($foto))
                $foto = "";
            return new Profilo($arrayDati[0], $arrayDati[1],$arrayDati[2], $arrayDati[3]);
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
    }
}