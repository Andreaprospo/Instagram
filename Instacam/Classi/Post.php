<?php

class Post
{
    private $id;
    private $usernameProfilo;
    private $estensione;
    private $pathFoto;
    private $luogo;
    private $data;
    private $descrizione;
    private $pathFileCommentiPost;
    private $pathFileLikePost;
    private $giaVisto;

    
    public function __construct($idPost, $usernameProfilo, $estensione, $dataPubblicazione, $descrizione = "")
    {
        $this->id = $idPost;
        $this->usernameProfilo = $usernameProfilo;
        $this->estensione = $estensione;
        $this->data = $dataPubblicazione;
        $this->descrizione = $descrizione;
        $this->pathFoto = "./FileUtenti/$usernameProfilo/FotoPost/$this->id.$this->estensione";
        $this->giaVisto = false;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getUsername()
    {
        return $this->usernameProfilo;
    }
    public function setUsername($usernameProfilo)
    {
        $this->usernameProfilo = $usernameProfilo;
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
    public function getLuogo()
    {
        return $this->luogo;
    }
    public function setLuogo($luogo)
    {
        $this->luogo = $luogo;
    }
    public function getData()
    {
        return $this->data;
    }
    public function setData($data)
    {
        $this->data = $data;
    }
    public function getPathFileCommentiPost()
    {
        return $this->pathFileCommentiPost;
    }
    public function setPathFileCommentiPost($pathFileCommentiPost)
    {
        $this->pathFileCommentiPost = $pathFileCommentiPost;
    }
    public function getPathFileLikePost()
    {
        return $this->pathFileLikePost;
    }
    public function setPathFileLikePost($pathFileLikePost)
    {
        $this->pathFileLikePost = $pathFileLikePost;
    }
    public function getGiaVisto()
    {
        return $this->giaVisto;
    }
    public function setGiaVisto($giaVisto)
    {
        $this->giaVisto = $giaVisto;
    }

    public function getDataPubblicazione() {
        return $this->data;
    }
    public function setDataPubblicazione($data) {
        $this->data = $data;
    }

    public function toCSV()
    {
        $dati = "$this->id;Post;$this->usernameProfilo;$this->estensione;$this->data;$this->descrizione;$this->luogo;$this->giaVisto\n";
        $path = "./FileUtenti/$this->usernameProfilo/FilePubblicazione.csv";
        file_put_contents($path, $dati, FILE_APPEND);
    }
    public function fromCSV($path)
    {
        if (file_exists($path)) {
            $dati = file_get_contents($path);
            $arrayDati = explode(";", $dati);
            $this->id = $arrayDati[0];
            $this->usernameProfilo = $arrayDati[2];
            $this->estensione = $arrayDati[3];
            $this->data = $arrayDati[4];
            $this->descrizione = $arrayDati[5];
            $this->luogo = $arrayDati[6];
            $this->giaVisto = $arrayDati[7];
        }
    }
    private function calcolaLike()
    {
        if (file_exists($this->pathFileLikePost)) {
            $likeData = file_get_contents($this->pathFileLikePost);
            $righe = explode("\n", $likeData); 
    
            $count = 0;
            foreach ($righe as $riga) {
                //controllo riga vuota, altrimenti non la conto (in teoria non ci dovrebbero essere righe vuote)
                //TODO: qua è un problema perchè se uno toglie like come lo gestiamo? lascia la riga vuota poi il metodo che useremo?
                if (trim($riga) !== "") {
                    $count++;
                }
            }
    
            return $count;
        }

        //ovviamente se non ci sono righe ritorna 0
        return 0;
    }

    public static function getLastId($nomeUtente) {
        $pathCartellaFoto = "./FileUtenti/$nomeUtente/FotoPost";

        $lastId = -1;
        $uploadDir = opendir($pathCartellaFoto);
    
        while($nomeFileIntero = readdir($uploadDir))
        {
            $idFile = explode(".", $nomeFileIntero)[0];
            if($idFile == "." || $idFile == "..")
                continue;

            if($lastId < $idFile)
                $lastId = $idFile;
            echo $idFile . "\n";
        }
        closedir($uploadDir);
        return $lastId;
    }

    public static function getPostsDaUser($nomeUtente) {
        $percorsoCartellaFoto = "./FileUtenti/$nomeUtente/FotoPost";
        $percorsoDescrizioni = "./FileUtenti/$nomeUtente/descrizioni.csv";
        $post = [];
        $descrizioni = [];
        

        if (file_exists($percorsoDescrizioni)) {
            $fileDescrizioni = file($percorsoDescrizioni);
            foreach ($fileDescrizioni as $linea) {
                list($idPost, $descrizione) = str_getcsv($linea);
                $descrizioni[$idPost] = $descrizione;
            }
        }
    
        if (is_dir($percorsoCartellaFoto)) {
            $fileFoto = scandir($percorsoCartellaFoto);
            foreach ($fileFoto as $elementoFile) {
                if ($elementoFile != '.' && $elementoFile != '..') {
                    $partiFile = explode(';', $elementoFile);
                    if (count($partiFile) > 1 && is_numeric($partiFile[0])) {
                        $idPost = (int)$partiFile[0];
                        $estensioneFile = end($partiFile);
                        $dataPubblicazione = date("Y-m-d H:i:s", filemtime("$percorsoCartellaFoto/$elementoFile"));
                        $descrizione = ""; 
    
                        //lettura della descrizione dal file
                        $pathDescrizione = "./FileUtenti/$nomeUtente/DescrizioniPost/{$idPost}.txt";
                        if (file_exists($pathDescrizione)) {
                            $descrizione = file_get_contents($pathDescrizione);
                        }
    
                        $post[] = new Post($nomeUtente, $estensioneFile, $dataPubblicazione, $descrizione);
                    }
                }
            }
        }
    
        return $post;
    }

    public static function parse($campi)
    {
        return new Post($campi[0], $campi[2], $campi[3], $campi[4], $campi[5]);
    }
}
?>