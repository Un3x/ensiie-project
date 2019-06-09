<?php
    namespace Film;
    class FilmRepository
    {
        private $connection;
        public function __construct(\PDO $connection)
        {
            $this->connection=$connection;
        }
        public function add(Film $film)
        {
            $prep=$this->connection->prepare('insert into film (titre,duree,description,datesortie) values (:titre,:duree,:description,:datesortie)');
            $prep->bindValue(':titre',$film->getTitre());
            $prep->bindValue(':duree',$film->getDuree(),\PDO::PARAM_INT);
            $prep->bindValue(':description',$film->getDescription());
            $prep->bindValue(':datesortie',$film->getDatesortie());
            return $prep->execute();

        }
        public function delete($film)
        {
            $nb=$this->connection->query('delete from film where idfilm='.$film);
            return $nb;
        }
        public function update(Film $film)
        {
            $prep=$this->connection->prepare('update film set tite=:titre,duree=:duree,description=:description,datesortie=:datesortie where idfilm=:idfilm');
            $prep->bindValue(':idfilm',$film->getIdfilm(),PDO::PARAM_INT);
            $prep->bindValue(':titre',$film->getTitre());
            $prep->bindValue(':duree',$film->getDuree(),PDO::PARAM_INT);
            $prep->bindValue(':description',$film->getDescription());
            $prep->bindValue(':datesortie',$film->getDatesortie());
            $prep->execute();
        }
        public function showFilm($film)
        {
            $id = (int) $film;
            $nb=$this->connection->query("select idfilm,titre,duree,description,datesortie from film where idfilm=".$id);
            if($nb==true) {
                $res = $nb->fetch(\PDO::FETCH_ASSOC);
                return $res;
            }else
            {
                return false;

            }
        }
        public function showFilms($film)
        {
            $id = (int) $film;
            $unite=new Film();
            $nb=$this->connection->query("select idfilm,titre,duree,description,datesortie from film where idfilm=".$id);
            if($nb==true) {
                $res = $nb->fetch(\PDO::FETCH_ASSOC);
                //if($res)
                //{
                    $unite->setIdfilm($res['idfilm']);
                    $unite->setTitre($res['titre']);
                    $unite->setDuree($res['duree']);
                    $unite->setDescription($res['description']);
                    $unite->setDatesortie($res['datesortie']);
                    return $unite;
                //}
                //else return false;
            }else
            {
                return false;

            }
        }
        public function showAllfilms()
        {
            $films=[];
            $film=$this->connection->query("select idfilm,titre,duree,description,datesortie from film order by idfilm");
            while($fil=$film->fetch(\PDO::FETCH_ASSOC))
            {
                $unite=new Film();
                $unite->setIdfilm($fil['idfilm']);
                $unite->setTitre($fil['titre']);
                $unite->setDuree($fil['duree']);
                $unite->setDescription($fil['description']);
                $unite->setDatesortie($fil['datesortie']);
                $films[]=$unite;
            }
            return $films;
        }
        public function idFilmByName($film)
        {
            $nb=$this->connection->query("select idfilm,titre,duree,description,datesortie from film where upper(titre)='".strtoupper($film)."'");
            if($nb==true) {
                $res=$nb->fetch(\PDO::FETCH_ASSOC);
                if($res) {
                    return $res['idfilm'];
                }
                else return "fetch ERR";
                //}
                //else return false;
            }else

                echo "Rq ERR";
        }
        /*public function addimage()
        {
            $file_name = "http://fr.web.img3.acsta.net/c_215_290/pictures/19/04/04/09/04/0472053.jpg";

            $img = fopen($file_name, 'r') or die("cannot read image\n");
            $data = \fread($img, \filesize($file_name)                                                                                                                                                                                                                                        );
            $es_data = \pg_escape_bytea($data);
            fclose($img);
            $nb=$this->connection->prepare("INSERT INTO images(id, data) Values(1,:image)");
            $nb->bindValue(':image',$es_data);
            return $nb->execute();

        }*/

    }