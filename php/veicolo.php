<?php 

    class Veicolo 
    {
        private $targa = null;
        private $modello = null;
        private $cilindrata = null;
        private $anno = null;
        private $posti = null;
        private $cambio = null;
        private $carburante = null;
        private $colori_Esterni = null;
        private $url_Immagine = null;
        private $descrizione = null;
        private $chilometri_Percorsi = null;
        private $disponibile = true;
        private $data_Aggiunta = null;

        public function __construct(){
            try {
                $this->$targa = $targa;

            } catch (Exception $exc) {
                header('Location: '.$_SERVER['PATH_INFO'].'html/404.html');
                exit();
            }
        }

        public function getTarga(){
            return $this->targa;
        }

        public function getModello(){
            return $this->modello;
        }

        public function getCilindrata(){
            return $this->cilindrata;
        }

        public function getAnno(){
            return $this->anno;
        }

        public function getPosti(){
            return $this->posti;
        }

        public function getCambio(){
            return $this->cambio;
        }

        public function getCarburante(){
            return $this->carburante;
        }

        public function getColoriEsterni(){
            return $this->colori_Esterni;
        }

        public function getUrlImmagine(){
            return $this->url_Immagine;
        }

        public function getDescrizione(){
            return $this->descrizione;
        }

        public function getChilometriPercorsi(){
            return $this->chilometri_Percorsi;
        }

        public function getDisponibile(){
            return $this->disponibile;
        }

        public function getDataAggiunta(){
            return $this->data_Aggiunta;
        }
    }
?>