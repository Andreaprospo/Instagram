<?php

    class Storia
    {
        private $id, $pathFoto, $data, $idProfilo, $numeroVisualizzazioni, $giaVisto, $pathFileLikeStoria;

        public function toCSV()
        {
            $path = "../FileUtenti/$this->idProfilo/FileStoria/$this->id$this->idProfilo.csv";
            $dati = "$this->id;$this->idProfilo,$this->pathFoto,$this->data,$this->giaVisto,$this->pathFileLikeStoria";
            file_put_contents($path, $dati, FILE_APPEND);
        }

        public function fromCSV()
        {
            
        }

        public function getPathFoto()
        {
            return $this->pathFoto;
        }
        public function getData()
        {
            return $this->pathFoto;
        }

        public function getIdProfilo(): mixed
        {
            return $this->pathFoto;
        }

        public function getNumeroVisualizzazioni()
        {
            return $this->pathFoto;
        }
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

    }

?>