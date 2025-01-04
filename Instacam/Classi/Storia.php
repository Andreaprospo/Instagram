<?php

    class Storia
    {
        private $id, $estensione, $data, $username, $numeroVisualizzazioni, $giaVisto;

        public function __construct($username, $estensione, $data)
        {
            $this->id = $this->getLastId($username);
            $this->estensione = $estensione;
            $this->data = $data;
            $this->username = $username;
            $this->numeroVisualizzazioni = 0;
        }
        public function toCSV()
        {
            $path = "FileUtenti/$this->username/FilePubblicazione.csv";
            $dati = "$this->id;Storia;$this->username;$this->estensione;$this->data;$this->giaVisto\n";
            file_put_contents($path, $dati, FILE_APPEND);
        }

        public function fromCSV($id, $username)
        {
            $pathStoria = "FileUtenti/$username/FilePubblicazioni.csv";
            if(file_exists($pathStoria))
            {
                $contenuto = file_get_contents($pathStoria);
                $righe = explode("\n", $contenuto);
                foreach ($righe as $riga) {
                    $campi = explode(";", $riga);
                    if($campi[0] == $id)
                        return new Storia($campi[2], $campi[3], $campi[4]);
                }
            }
            return null;
        }

        //-------GET-------//
        public function getIdStoria()
        {
            return $this->id;
        }
        public function getData()
        {
            return $this->data;
        }

        public function getUsername(): mixed
        {
            return $this->username;
        }

        public function getNumeroVisualizzazioni()
        {
            return $this->numeroVisualizzazioni;
        }
        public function getGiaVisto()
        {
            return $this->giaVisto;
        }
        //-----------------//


        //-------SET-------//
        public function setPathFoto()
        {
            //Controllo path
        }
        public function setData()
        {
            
        }
        public function setIdProfilo()
        {
            
        }
        public function setNumeroVisualizzazioni()
        {
            
        }
        //-----------------//

        public static function getLastId($username)
        {
            $pathPartenza = "FileUtenti/$username/FotoStoria/";
            $uploadDir = opendir($pathPartenza);
            $lastId = -1;
    
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
    }
?>