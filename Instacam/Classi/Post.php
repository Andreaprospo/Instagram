<?php

class Post
{
    private $id;
    private $idProfilo;
    private $descrizione;
    private $pathFoto;
    private $luogo;
    private $data;
    private $pathFileCommentiPost;
    private $pathFileLikePost;
    private $giaVisto;
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getIdProfilo()
    {
        return $this->idProfilo;
    }
    public function setIdProfilo($idProfilo)
    {
        $this->idProfilo = $idProfilo;
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
        $path = "FileUtenti/$this->idProfilo/FilePost/$this->id.csv";
        $dati = "$this->id;$this->idProfilo;$this->descrizione;$this->pathFoto;$this->luogo;$this->data;$this->pathFileCommentiPost;$this->pathFileLikePost;$this->giaVisto";
        file_put_contents($path, $dati);
    }
    public function fromCSV($path)
    {
        if (file_exists($path)) {
            $dati = file_get_contents($path);
            $arrayDati = explode(";", $dati);
            $this->id = $arrayDati[0];
            $this->idProfilo = $arrayDati[1];
            $this->descrizione = $arrayDati[2];
            $this->pathFoto = $arrayDati[3];
            $this->luogo = $arrayDati[4];
            $this->data = $arrayDati[5];
            $this->pathFileCommentiPost = $arrayDati[6];
            $this->pathFileLikePost = $arrayDati[7];
            $this->giaVisto = $arrayDati[8];
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
        $pathCartellaFoto = "FileUtenti/$nomeUtente/FotoPost";
        
        if (!is_dir($pathCartellaFoto)) {
            return 0;
        }
    
        $file = scandir($pathCartellaFoto);
        $idMassimo = 0;
    
        foreach ($file as $fileItem) {
            $parts = explode('.', $fileItem);
            if (count($parts) > 1) {
                $id = (int)$parts[0];
                if ($id > $idMassimo) {
                    $idMassimo = $id;
                }
            }
        }
    
        return $idMassimo;
    }

    public static function getPostsByUser($nomeUtente) {
        $percorsoCartellaFoto = "FileUtenti/$nomeUtente/FotoPost";
        $post = [];
    
        if (is_dir($percorsoCartellaFoto)) {
            $fileFoto = scandir($percorsoCartellaFoto);
            foreach ($fileFoto as $elementoFile) {
                if ($elementoFile != '.' && $elementoFile != '..') {
                    $partiFile = explode('.', $elementoFile);
                    if (count($partiFile) > 1 && is_numeric($partiFile[0])) {
                        $idPost = (int)$partiFile[0];
                        $estensioneFile = end($partiFile); //siccome non so che tipo di file mi carica allora devo fare così 
                        $dataPubblicazione = date("Y-m-d H:i:s", filemtime("$percorsoCartellaFoto/$elementoFile"));
                        $descrizione = ""; //TODO: leggere la descrizione dal file
                        $post[] = new Post($nomeUtente, $estensioneFile, $dataPubblicazione, $descrizione);
                    }
                }
            }
        }
    
        return $post;
    }
}

?>
