<?php
namespace Film;

    class  Film
    {
        //
        private $idfilm;
        //
        private $titre;
        //
        private $duree;
        //
        private $description;
        //
        private $datesortie;
        //
        public function hydrate(array $donnees)
        {
            foreach ($donnees as $key => $value)
            {
                // On récupère le nom du setter correspondant à l'attribut.
                $method = 'set'.ucfirst($key);

                // Si le setter correspondant existe.
                if (method_exists($this, $method)) {
                    // On appelle le setter.
                    $this->$method($value);
                }
            }
        }

        /**
         * @return mixed
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * @return mixed
         */
        public function getDuree()
        {
            return $this->duree;
        }

        /**
         * @return mixed
         */
        public function getTitre()
        {
            return $this->titre;
        }

        /**
         * @return mixed
         */
        public function getDatesortie()
        {
            return $this->datesortie;
        }

        /**
         * @return mixed
         */
        public function getIdfilm()
        {
            return $this->idfilm;
        }

        /**
         * @param mixed $Titre
         */
        public function setTitre($Titre)
        {
            $this->titre = $Titre;
        }

        /**
         * @param mixed $description
         */
        public function setDescription($description)
        {
            $this->description = $description;
        }

        /**
         * @param mixed $duree
         */
        public function setDuree($duree)
        {
            $this->duree = $duree;
        }

        /**
         * @param mixed $datesortie
         */
        public function setDatesortie($datesortie)
        {
            $this->datesortie = $datesortie;
        }

        /**
         * @param mixed $idfilm
         */
        public function setIdfilm($idfilm)
        {
            $this->idfilm = $idfilm;
        }
          }