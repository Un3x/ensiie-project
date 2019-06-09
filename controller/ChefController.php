<?php
namespace ChefController;
require_once('../view/planningView.php');
require_once('../view/filmView.php');
require_once('../view/allFonctionForm.php');
require_once ('../view/reservationView.php');
require_once('../view/ClientCompteView.php');
//require('../src/ConnectionBdd.php');
require_once('../src/Compte/CompteRepository.php');
//require_once('../src/Compte/Compte.php');
use Compte\Compte;
use Compte\CompteRepository;
use Admin\AdminRepository;
use Film\FilmRepository;
use mysql_xdevapi\Exception;

class ChefController
{
    public function connexion($compte)
    {
        if(isset($_POST['mdp']))
        {
            /*$ajout=new Compte();
            $ajout->setNomcompte("Radouanos");
            $ajout->setEmail("kowd@gmail.com");
            $ajout->setMotpasse("red");*/

            $ndc=$_POST['ndc'];
            $mdp=$_POST['mdp'];
            $sonCOmpte=$compte->getCompte($ndc,$mdp);
            if($sonCOmpte)
            {
                session_start();
                    $_SESSION['ncompte'] = $sonCOmpte->getNcompte();
                    $_SESSION['nomcompte'] = $sonCOmpte->getNomcompte();
                    $_SESSION['motpasse'] = $sonCOmpte->getMotpasse();
                    $_SESSION['email'] = $sonCOmpte->getEmail();
                echo '<script language="Javascript"> document.location.replace("../profilclient");</script>';
            }
        }
        else return vue_connexion();
    }


    //public function Inscription($client);
    public function deconnexion()
    {
        session_destroy();
        $_SESSION = array();
        unset($_SESSION);
        echo '<script language="Javascript"> document.location.replace("../accueil");</script>';
    }
    public function adminPerso()
    {
       /* session_start ();
        if (isset($_SESSION['nomcompte']) && isset($_SESSION['motpasse'])) echo "RAK GHADI MLIH"; */
       if(isset($_SESSION['nomcompte'])) {
           echo "Je suis " . $_SESSION['nomcompte'] . "et je suis l'admin Merci";
           echo '<a href="/deconnexion">se déconnecter </a>';
       }
       else if (isset($_SESSION['ncompte']))
       {
           echo "Je suis " . $_SESSION['nom'] . "et je suis un client Merci";
           echo '<a href="/deconnexion">se déconnecter </a>';
       }
       echo "Â FINIR CHEF";
    }
    /***********************/
    public function addAdmin($admin,$compte_objet,$compte,$admin_objet)
    {
        if(isset($_POST['nomcompte']))
        {
            $ndc=$_POST['nomcompte'];
            $mdp=$_POST['motpasse'];
            $mdp2=$_POST['motpasse'];//motpasse2
            $mail = $_POST['email'];
            $nom=$_POST['nom'];
            $prenom=$_POST['prenom'];
            $ddn=$_POST['datenaissance'];
            $adresse = $_POST['adresse'];
            $cp= $_POST['cp'];
            $pays= $_POST['pays'];

            $compte_objet->setNomcompte($ndc);
            $compte_objet->setMotpasse($mdp);
            $compte_objet->setEmail($mail);

            $admin_objet->setAdresse($adresse);
            $admin_objet->setCp($cp);
            $admin_objet->setNom($nom);
            $admin_objet->setPays($pays);
            $admin_objet->setPrenom($prenom);
            $admin_objet->setDatenaissance($ddn);
            if($mdp==$mdp2)
            {
                $add_compte = $compte->add($compte_objet);
                $v=$compte->getCompte($ndc,$mdp);


                $admin_objet->setNcompte($v->getNcompte());
                if($add_compte)
                {
                    $admion=$admin->add($admin_objet);
                    if($admion) {
                        return "<div class=\"alert alert-success\">
                            <strong>Nouveau admin ".$nom." !</strong>
                            </div>";
                    }else
                    {
                        $compte->delete($v->getNcompte());
                    }
                }
                else echo "-".$compte_objet->getNomcompte()."-".$compte_objet->getEmail();
            }
            else return "<div class=\"alert alert-danger\">
  <strong>Erreur ! </strong> vous avez tapé deux mot de passe différents
</div>";;
        }
        else
        {
            return addAdmin_vue();
        }
    }
    public function allAdmin($admin,$v)
    {
        $admins=$admin->allAdmin(); //la liste des admins
        $max = sizeof($admins);
        if($admins && $max>1)
        {

            return affiche_admcli($admins,$v);
        }
        else return "<div class=\"alert alert-danger\">
  <strong> Vous êtes le seul administrateur  </strong>  
</div>";
    }
    /**********************/

    /*---*/
    public function addFilmCategorie()
    {

    }
    public function deleteFilmCategorie()
    {

    }
    public function showFilmsOfCategorie()
    {

    }
    public function updateFilmsOfCategorie()
    {

    }
    public function  updateCategorieOfFilm()
    {

    }


    /****/

    public function addCategorie()
    {

    }
    public function showCategories()
    {

    }
    public function deleteCategorie()
    {

    }
    public function updateCategorie()
    {

    }
    public function getCategorie(){

    }


    /*******************/
    public function addCategoriesPlace()
    {

    }
    public function deleteCategoriePlace()
    {

    }
    public function updatePrixCategorie()
    {

    }
    public function getCategoriePlace()
    {

    }
    public function allCategories()
    {

    }



    /************************/
    public function profilClients()
    {
        echo '<h1> BONJOUR '.$_SESSION['nom'];
        profilClient();
    }
    public function allClients($client,$v)
    {
        $all= $client->allClient();
        if($all)
        {
            return affiche_admcli($all,$v);
        } else return "<div class=\"alert alert-danger\">
  <strong>Vous n'avez pas des clients</strong>  
</div>";

    }
    public function deleteClients($compte,$client,$conn,$valeur)
    {
        $conn->beginTransaction();
        $cliento=$client->delete($valeur);
        if($cliento)
        {
            $compto=$compte->delete($valeur);
            if($compto)
            {
                $conn->commit();
                return "<div class=\"alert alert-success\">
                            <strong>Client suprimmé ! </strong>
                            </div>";

            }else
            {
                $conn->rollBack();
                return "<div class=\"alert alert-danger\">
  <strong> Veuillez vérifier que le compte existe dans la table des comptes</strong>  
</div>";
            }
        } else
        return "<div class=\"alert alert-danger\">
  <strong> Veuillez vérifier que le client existe dans la table des clients</strong>  
</div>";

           /* try {
                $conn->beginTransaction();*/

                /*$conn->commit();
            } catch (Exception $e) {
                $conn->rollBack();
                return "Failed: " . $e->getMessage();
            }*/

    }
    /*********************/
    public function addFauteuil($categories,$fauteuil,$f_objet)
    {
        $all=$categories->allCategories();
        if(isset($_POST['nfauteuil']))
        {
            $f_objet->setNfauteuil($_POST['nfauteuil']);
            $f_objet->setCatplace($_POST['catplace']);

            $fauteuil=$fauteuil->add($f_objet);
            if($fauteuil)
            {
                return "<div class=\"alert alert-success\">
                            <strong>Fauteuil ajouté ! </strong>
                            </div>";
            }else
            {
                return "<div class=\"alert alert-danger\">
  <strong>Erreur ! </strong>  Verifiez vérifier que le numéro du fauteuil et supérieur à 20
</div>";
            }
        }
        else
        {
                return addFauteuil($all);
        }
    }
    public function deleteFauteuil()
    {

    }
    public function allFauteuils()
    {

    }
    public function allFauteuilsOf()
    {

    }
    /*************************/
    public function addFilm($film,$objet)
    {
        if(isset($_POST['name'])){
            $objet->setTitre($_POST['name']);
            $objet->setDescription($_POST['description']);
            $objet->setDuree($_POST['duree']);
            $objet->setDatesortie($_POST['date']);
            $filmo=$film->add($objet);
        if($filmo)
        {
            return "<div class=\"alert alert-success\">
                            <strong>Film ajouté ! </strong>
                            </div>";
        }
        else return "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong>  Verifiez les informations de ce film
</div>";
        }
        else return addfilmView();
    }
    public function deleteFilm($film,$id)
    {
        $filmo=$film->delete($id);
        if($filmo)
        {
            return "<div class=\"alert alert-success\">
                            <strong>Film suprimmé ! </strong>
                            </div>";
        }
        else return "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong>  Verifiez que le numéro de film existe dans la table des films
</div>";
    }
    public function updateFilm()
    {

    }


    /****************************/
    public function addPlaning($planing,$objet)
    {
        if(isset($_POST['trip-start']))
        {
            $n_film=$_POST['num_film'];
            $trip=$_POST['trip-start'];
            $deb=$_POST['appt'];
            $fin=$_POST['appt2'];
            $objet->setFilm($n_film);
            $objet->setDatejour($trip);
            $objet->setDebutheure($deb);
            $objet->setFinheure($fin);
            if($_POST['type']=='salle')
            {
                $objet->setDediesalle(1);
            }else
            $objet->setDediesalle(0);
            if($nombre=$planing->add($objet)) {
                return "<div class=\"alert alert-success\">
                            <strong>$nombre nouveau Planning !</strong>
                            </div>";
            }
            else return "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong>  Verifiez que votre numéro de film n'éxiste pas dans un autre planing du même jour
</div>";
        }
        else return FormPlanning(null);
    }
    public function deletePlaning($planing,$id)
    {
        /*if(isset($_POST['deletit']))
        {*/
            //$num=$_POST['deletit'];
            $plan=$planing->delete($id);
            if($plan)
            {
                return "<div class=\"alert alert-success\">
                            <strong>Planning suprimmé ! </strong>
                            </div>";
            }
            else return "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong>  Vérifiez que vous avez tapez un planing qui existe dans la table
</div>";
        /*}
        else return FormDeletePlanning();*/
    }
    public function updatePlaning($planing,$objet)
    {
       if(isset($_GET['n_film']))
       {
           $n_film=$_GET['n_film'];
           $a_modifier=$planing->showPlaningOfFilm($n_film);
           if($a_modifier!=false)
           {

               if(isset($_POST['appt']))
               {
                   $n_planing=$planing->showPlaningOfFilm($_POST['num_film']);
                    if($n_planing) {
                        $objet->setFilm($_POST['num_film']);
                        $objet->setDatejour($_POST['start']);
                        $objet->setDebutheure($_POST['appt']);
                        $objet->setFinheure($_POST['appt2']);
                        $objet->setNplaning($n_planing[0]->getNplaning());
                        $planing->update($objet);
                    }
                    else return  "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong>  Ce film n'a pas de planing
</div>";

               } return FormPlanning($a_modifier);
           }
           else return FormPlanning(null);
       }
       else return FormUpdatePlanning();

    }
    public function affichePlaning($planing)
    {
        $a_modifier=$planing->showAllPlaning();
        if($a_modifier)
        {
            return affiche_table($a_modifier);
        }
        else echo "dik a_modifier rah massalakch";
    }
    //public function showPlaningOfFilm()
    /***********************/
    public function addResertionPlace()
    {

    }
    public function removeReservationPlace($reservation,$nreservation)
    {
        $plan=$reservation->remove($nreservation);
        if($plan)
        {
            return "<div class=\"alert alert-success\">
                            <strong>Reservation suprimmé ! </strong>
                            </div>";
        }
        else return "<div class=\"alert alert-danger\">
  <strong>Erreur ! </strong>  Vérifiez que vous avez tapez une réservation (PLACE) qui existe dans la table
</div>";
    }
    public function updateReservationPlace()
    {
    }
    public function allReservationOfClient()
    {

    }
    public function allReservationOfDate()
    {

    }
    public function allReservationofPlaning()
    {

    }
    public function allReservationPlace($rplace,$v)
    {
        $reserver=$rplace->allReservation();
        if($reserver)
        {
            return voirReserv($reserver,$v);
        }
        else return "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong> Table des reservations des places est vide !
</div>";
    }
    /*****************************/
    public function addReservationSalle()
    {

    }
    public function deleteReservationSalle($reservationSalle,$numero)
    {
        $plan=$reservationSalle->remove($numero);
        if($plan)
        {
            return "<div class=\"alert alert-success\">
                            <strong>Reservation Salle suprimmé ! </strong>
                            </div>";
        }
        else return "<div class=\"alert alert-danger\">
  <strong>Erreur ! </strong>  Vérifiez que vous avez tapez une réservation (SALLE) qui existe dans la table
</div>";
    }
    public function updateReservationSalle()
    {

    }
    public function allReservationSalleOfCLient()
    {

    }
    public function allReservationSalleOfPlaning()
    {

    }
    public function allReservationSalleOfDate()
    {

    }
    public function allReservationSalle($rsalle,$v)
    {
        $reserver=$rsalle->allReservation();
        if($reserver)
        {
            return voirReservSalle($reserver,$v);
        }
        else return "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong> Table des reservations des salles est vide !
</div>";
    }
    /********************************/
    public function addTypeEvenement($event,$event_objet)
    {
        if(isset($_POST['tevent']))
        {
            $event_objet->setType($_POST['tevent']);
            $event_objet->setPrixheure($_POST['pheure']);
            $entre=$event->add($event_objet);
            if($entre)
            {
                return "<div class=\"alert alert-success\">
                            <strong>nouveau Type Evenement ! </strong>
                            </div>";
            }
            else return "<div class=\"alert alert-danger\">
  <strong>Erreur ! </strong>  Réssayez 
</div>";

        }
        else return addTypeevent();
    }
    public function deleteTypeEvenement()
    {

    }
    public function updateTypeEvenement()
    {

    }
    public function showAllEvents()
    {

    }

}