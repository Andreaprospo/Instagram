<?php

class Profilo
{
    //io ho pensato a questi attributi privati (POI FAMMI SAPERE)
    private $id, $nomeUtente, $mail, $password, $descrizione, $pathFoto, $seguiti = [], $followers = [], $post = [];

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
    public function getSeguiti()
    {
        return $this->seguiti;
    }
    public function aggiungiSeguito($idSeguito)
    {
        if (!in_array($idSeguito, $this->seguiti)) {
            $this->seguiti[] = $idSeguito;
        }
    }
    public function getFollowers()
    {
        return $this->followers;
    }
    public function aggiungiFollower($idFollower)
    {
        if (!in_array($idFollower, $this->followers)) {
            $this->followers[] = $idFollower;
        }
    }
    public function getPost()
    {
        return $this->post;
    }
    public function aggiungiPost($post)
    {
        $this->post[] = $post;
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
            return new Profilo($arrayDati[0], $arrayDati[1],$arrayDati[2], $arrayDati[3], $arrayDati[4],  $arrayDati[5]);
        }
    }
}
