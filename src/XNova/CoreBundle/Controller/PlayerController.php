<?php

namespace XNova\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\SecurityExtraBundle\Annotation\Secure;
use XNova\UserBundle\Entity\User;
use XNova\CoreBundle\Entity\Player;

class PlayerController
{
    private $doctrine;
    private $userManager;
    
    public $id;
    public $idUser;
    public $idCurrentPlanet;
    public $planet;
    public $tech;
    
    /**
     * Constructeur
     * 
     * @param type $doctrine Contient le service doctrine pour permettre les requêtes à la bdd : $this->container->get('doctrine')
     * @param int $idUser Identifiant d'un utilisateur, contenu dans la table User
     * @param mixed $userManager Service permettant de faire des requêtes bdd à la table user : $this->container->get('fos_user.user_manager')
     */
    public function __construct($doctrine, $idUser, $userManager)
    {
        $this->doctrine = $doctrine;
        $this->idUser = $idUser;
        $this->userManager = $userManager;
        $this->id = $this->getId();
        
        $find = $this->doctrine->getEntityManager()->getRepository('XNovaCoreBundle:Player')->find($this->id);
        if(is_object($find))
            $this->idCurrentPlanet = $find->getIdCurrentPlanet();
        else
            $this->idCurrentPlanet = null;
        
        $this->planet = new PlanetController($doctrine, $this->idUser, $this->idCurrentPlanet);
    }
    
    /**
     * Permet de créer une nouveau joueur.
     * Peut être utilisé directement si la variable $this->id est null (en gros y'a pas de player associé à l'user)
     * 
     */
    public function newPlayer()
    {
        $user = $this->userManager->findUserBy(array("id" => $this->idUser));
        if(is_object($user))
        {
            $Player = new Player;
            $Player->setIdUser($this->idUser);
            $Player->setIdCurrentPlanet(0);
            $em = $this->doctrine->getEntityManager();
            $em->persist($Player);
            $em->flush();
            
            //Récupération de l'id
            $this->id = $this->getId();
            
            //Création de la planète tant qu'a faire ^^
            $idPlanet = $this->planet->newPlanet();
            $this->planet = new PlanetController($this->doctrine, $this->idUser, $idPlanet);
            $this->planet->tech->newTechnology();
            
        } 
    }
    
    /**
     * Retourne l'id Player d'un User
     * 
     */
    private function getId()
    {
        $repo = $this->doctrine->getEntityManager()->getRepository('XNovaCoreBundle:Player');
        $player = $repo->findBy(array("idUser" => $this->idUser));
        if(!empty($player))
            return $player[0]->id;
    }
    
}
?>
