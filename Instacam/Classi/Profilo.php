<?php

class Profilo
{
    //io ho pensato a questi attributi privati (POI FAMMI SAPERE)
    private $id;
    private $nomeUtente;
    private $mail;
    private $password;
    private $descrizione;
    private $pathFoto;
    private $seguiti = [];
    private $followers = [];
    private $post = [];
    
    //costruttore che ha pathFoto vuoto siccome non sempre deve essere passato
    public function __construct($id, $mail, $password, $descrizione, $pathFoto = "") {
        $this->id = $id;
        $this->mail = $mail;
        $this->password = $password;
        $this->descrizione = $descrizione;
        $this->pathFoto = $pathFoto;
    }

    // SENZA controlli le set (NO CONTROLLI)
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getNomeUtente()
    {
        return $this->nomeUtente;
    }
    public function setNomeUtente($nomeUtente)
    {
        $this->nomeUtente = $nomeUtente;
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

    public function aggiungiSeguito($idSeguito)
    {
        if (!in_array($idSeguito, $this->seguiti)) {
            $this->seguiti[] = $idSeguito;
        }
    }

    public function aggiungiFollower($idFollower)
    {
        if (!in_array($idFollower, $this->followers)) {
            $this->followers[] = $idFollower;
        }
    }
    public function aggiungiPost($post)
    {
        $this->post[] = $post;
    }

    public function getSeguiti() {
        $stringaSeguiti = "";
        for ($i = 0; $i < count($this->seguiti); $i++) {
            $stringaSeguiti .= $this->seguiti[$i] . "\n";
        }
        return $stringaSeguiti;
    }

    public function getFollowers() {
        $stringaFollowers = "";
        for ($i = 0; $i < count($this->followers); $i++) {
            $stringaFollowers .= $this->followers[$i] . "\n";
        }
        return $stringaFollowers;
    }

    public function getPost() {
        $stringaPost = "";
        for ($i = 0; $i < count($this->post); $i++) {
            $stringaPost .= $this->post[$i] . "\n";
        }
        return $stringaPost;
    }
    public function toCSV()
    {
        $path = "../FileUtenti/$this->id/FileInfo.csv";
        $dati = "$this->id;$this->nomeUtente;$this->mail;$this->password;$this->descrizione;$this->pathFoto";
        file_put_contents($path, $dati);
    }
    public static function fromCSV($username)
    {
        if (file_exists("FileUtenti/$username")) {
            $dati = file_get_contents("FileUtenti/$username/FileInfo.csv");
            $arrayDati = explode(";", $dati);

            //creare un costruttore per poter ritornare un oggetto Profilo
            //COSTRUTTORE FATTO
            return new Profilo($arrayDati[0], $arrayDati[1],$arrayDati[2], $arrayDati[3], $arrayDati[4]);
        }
    }
}