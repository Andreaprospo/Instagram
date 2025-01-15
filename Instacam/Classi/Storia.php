<?php

    class Storia
    {
        private $id;
        private $estensione;
        private $data;
        private $username;
        private $numeroVisualizzazioni;
        private $pathFoto;
        private $giaVisto;

        public function __construct($id, $username, $estensione, $data)
        {
            $this->id = $id;
            $this->estensione = $estensione;
            $this->data = $data;
            $this->username = $username;
            $this->numeroVisualizzazioni = 0;
            $this->pathFoto = Storia::extractPathFoto($id, $username);
        }
        public function toCSV()
        {
            $path = "./FileUtenti/$this->username/FilePubblicazione.csv";
            $dati = "$this->id;Storia;$this->username;$this->estensione;$this->data;$this->giaVisto\n";
            file_put_contents($path, $dati, FILE_APPEND);
        }

        public function fromCSV($id, $username)
        {
            $pathStoria = "./FileUtenti/$username/FilePubblicazioni.csv";
            if(file_exists($pathStoria))
            {
                $contenuto = file_get_contents($pathStoria);
                $righe = explode("\n", $contenuto);
                foreach ($righe as $riga) {
                    $campi = explode(";", $riga);
                    if($campi[0] == $id)
                        return new Storia($id, $campi[2], $campi[3], $campi[4]);
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
        public function getPathFoto()
        {
            return $this->pathFoto;
        }
        //-----------------//


        //-------SET-------//
        public function setData($data)
        {
            $this->data = $data;
        }
        public function setIdProfilo($id)
        {
            $this->id = $id;
        }
        public function setNumeroVisualizzazioni($numeroVisualizzazioni = 0)
        {
            //DA CAMBIARE, BISOGNA HOMEPAGE
            $this->numeroVisualizzazioni = $numeroVisualizzazioni;
        }
        //-----------------//

        public static function getLastId($username)
        {
            $pathPartenza = "./FileUtenti/$username/FotoStoria/";
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

        //-----------------//

        public static function parse($campi)
        {
            return new Storia($campi[0], $campi[2], $campi[3], $campi[4]);
        }

        private function extractPathFoto($id, $username)
        {
            return "./FileUtenti/$username/FotoStoria/$id.$this->estensione";
        }

        public static function checkDate($date)
        {
            //quella che avevo setta
            $dateSet = strtotime($date);
            //quella di ora
            $currentDate = time();

            //calcola il timespan
            $timeSpan = $dateSet - $currentDate;

            //guarda i giorni passati
            $dayPassed = $timeSpan / (60 * 60 * 24);

            //se è passato più di un giorno allora return true 
            //altrimenti return false
            if ($dayPassed >= 1)
                return true;
            return false;
        }
    }
   
?>