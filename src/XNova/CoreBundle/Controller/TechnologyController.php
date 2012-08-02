<?php
namespace XNova\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\SecurityExtraBundle\Annotation\Secure;
use XNova\CoreBundle\Entity\Technology;
use XNova\CoreBundle\Entity\Config;
use XNova\CoreBundle\Controller\GameController;

class TechnologyController
{
    public $id;
    public $idPlayer;
    public $idPlanet;
    public $energy;
    
    private $doctrine;
    
    /**
     * Constructeur
     * 
     * @param type $doctrine Contient le service doctrine pour permettre les requêtes à la bdd : $this->container->get('doctrine')
     * @param int $idPlayer id du joueur
     * @param int $idPlanet id de la planète
     */
    public function __construct($doctrine, $idPlayer, $idPlanet)
    {
        $this->idPlayer = $idPlayer;
        $this->idPlanet = $idPlanet;
        $this->doctrine = $doctrine;
        
        $this->id = $this->getId();
        
        //Récupère les ressources de la planète
        $find = $this->doctrine->getEntityManager()->getRepository('XNovaCoreBundle:Technology')->find($this->id);
        if(is_object($find))
        {
            $this->energy = $find->getEnergy();
        }
    }
    
    /**
     * Permet d'obtenir l'id dans la table Technology de la bdd
     * 
     * @return int $id id dans la table Technology de la bdd
     */
    private function getId()
    {
        $repo = $this->doctrine->getEntityManager()->getRepository('XNovaCoreBundle:Technology');
        $tech = $repo->findBy(array("idPlayer" => $this->idPlayer, "idPlanet" => $this->idPlanet));
        if(!empty($tech))
            return $tech[0]->id;
    }
    
    /**
     * Permet de créer une nouvelle entrée dans la bdd 
     */
    public function newTechnology()
    {
        $tech = new Technology();
        $tech->setIdPlayer($this->idPlayer);
        $tech->setIdPlanet($this->idPlanet);
        $em = $this->doctrine->getEntityManager();
        $em->persist($tech);
        $em->flush();
    }
            
    
}

?>
