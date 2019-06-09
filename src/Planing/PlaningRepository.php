<?php


namespace Planing;


class  PlaningRepository
{
    private $connection;
    public function __construct(\PDO $connection)
    {
        $this->connection=$connection;
    }
    public function add(Planing $planing)
    {
        $prep=$this->connection->prepare('INSERT INTO planing (film,datejour,debutheure,finheure,dediesalle) VALUES (:film,:datejour,:debutheure,:finheure,:dediesalle)');
        $prep->bindValue(':film',$planing->getFilm(),\PDO::PARAM_INT);
        $prep->bindValue(':datejour',$planing->getDatejour());
        $prep->bindValue(':debutheure',$planing->getDebutheure());
        $prep->bindValue(':finheure',$planing->getFinheure());
        $prep->bindValue(':dediesalle',$planing->getDediesalle());
        return $prep->execute();
    }
    public function delete($planing)
    {
        return ($this->connection->query('delete from planing where nplaning='.$planing));


    }
    public function update(Planing $planing)
    {
        $prep=$this->connection->prepare('UPDATE planing SET film=:film,datejour=:datejour,debutheure=:debutheure,finheure=:finheure where nplaning=:nplaning');
        $prep->bindValue(':nplaning',$planing->getNplaning(),\PDO::PARAM_INT);
        $prep->bindValue(':film',$planing->getFilm(),\PDO::PARAM_INT);
        $prep->bindValue(':datejour',$planing->getDatejour());
        $prep->bindValue(':debutheure',$planing->getDebutheure());
        $prep->bindValue(':finheure',$planing->getFinheure());
        $prep->execute();
    }
    //voir planing selon date;
    //voir planing selon film
    public function showPlaningOfDate($date)
    {
        $req = $this->connection->query('select nplaning,film,datejour,debutheure,finheure from planing where dediesalle=0 and datejour=\'' . $date.'\'');
        if ($req)
        {
            $pl = $req->fetch(\PDO::FETCH_ASSOC);
            $plan = new planing();
            $plan->setDatejour($pl['datejour']);
            $plan->setDebutheure($pl['debutheure']);
            $plan->setFilm($pl['film']);
            $plan->setFinheure($pl['finheure']);
            $plan->setNplaning($pl['nplaning']);
            return $plan;
        }
        else return false;

    }
    public function showPlaningOfWeek($date,$date_f)
    {
        $planings=[];
        $req = $this->connection->query('select nplaning,film,datejour,debutheure,finheure from planing where dediesalle=0 and datejour between\'' . $date.'\' and \''.$date_f.'\'');
        if ($req)
        {
            while($pl = $req->fetch(\PDO::FETCH_ASSOC))
            {

            $plan = new planing();
            $plan->setDatejour($pl['datejour']);
            $plan->setDebutheure($pl['debutheure']);
            $plan->setFilm($pl['film']);
            $plan->setFinheure($pl['finheure']);
            $plan->setNplaning($pl['nplaning']);
            $planings[]=$plan;
            }
            return $planings;
        }
        else return false;
    }
    public function showPlaningOfFilm($film)
    {
        $planings=[];
        $req=$this->connection->query('select nplaning,film,datejour,debutheure,finheure from planing where film='.$film);
        while($pl=$req->fetch(\PDO::FETCH_ASSOC))
        {
            $plan=new planing();
            $plan->setDatejour($pl['datejour']);
            $plan->setDebutheure($pl['debutheure']);
            $plan->setFilm($pl['film']);
            $plan->setFinheure($pl['finheure']);
            $plan->setNplaning($pl['nplaning']);
            $planings[]=$plan;
        }
        return $planings;
    }

    public function showPlaningById($id)
    {
        $req=$this->connection->query('select nplaning,film,datejour,debutheure,finheure from planing where nplaning='.$id);
        $pl=$req->fetch(\PDO::FETCH_ASSOC);
            $plan=new planing();
            $plan->setDatejour($pl['datejour']);
            $plan->setDebutheure($pl['debutheure']);
            $plan->setFilm($pl['film']);
            $plan->setFinheure($pl['finheure']);
            $plan->setNplaning($pl['nplaning']);
        return $plan;
    }

    public function showAllPlaning()
    {
        $planings=[];
        $req=$this->connection->query('select nplaning,film,datejour,debutheure,finheure from planing');
        while($pl=$req->fetch(\PDO::FETCH_ASSOC))
        {
            $plan=new planing();
            $plan->setDatejour($pl['datejour']);
            $plan->setDebutheure($pl['debutheure']);
            $plan->setFilm($pl['film']);
            $plan->setFinheure($pl['finheure']);
            $plan->setNplaning($pl['nplaning']);
            $planings[]=$plan;
        }
        return $planings;
    }
    public function showAllPlaningSalle($date)
    {
        $planings=[];
        $req=$this->connection->query('select nplaning,film,datejour,debutheure,finheure from planing where datejour>\''.$date.'\' and dediesalle!=0');
        if($req) {
            while ($pl = $req->fetch(\PDO::FETCH_ASSOC)) {
                $plan = new planing();
                $plan->setDatejour($pl['datejour']);
                $plan->setDebutheure($pl['debutheure']);
                $plan->setFilm($pl['film']);
                $plan->setFinheure($pl['finheure']);
                $plan->setNplaning($pl['nplaning']);
                $planings[] = $plan;
            }
            return $planings;
        }else return false;
    }
}