<?php
namespace XNova\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\SecurityExtraBundle\Annotation\Secure;
use XNova\CoreBundle\Entity\Planet;
use XNova\CoreBundle\Entity\Config;
use XNova\CoreBundle\Controller\GameController;

class PlanetController
{
    public $id;
    public $idPlayer;
    
    public $tech;
    
    public $name;
    public $metal;
    public $diamond;
    public $gold;
    public $antimatter;
    public $energy;
    public $metalFactory;
    public $diamondFactory;
    public $goldFactory;
    public $antimatterFactory;
    public $lastUpdate;
    public $solarPowerPlant;
    public $antimatterPowerPlant;
    public $shipyard;
    public $naniteFactory;
    public $robotFactory;
    
    private $doctrine;
    
    /**
     * Constructeur
     * 
     * @param type $doctrine Contient le service doctrine pour permettre les requêtes à la bdd : $this->container->get('doctrine')
     * @param int $idPlayer Id du joueur
     * @param int $idPlanet Paramètre optionnel. Peut contenir l'id de la planète à utiliser. Si le paramètre est vide alors la valeur par défaut est la planète courante du joueur
     */
    public function __construct($doctrine, $idPlayer, $idPlanet)
    {
        $this->idPlayer = $idPlayer;
        $this->doctrine = $doctrine;
        
        if(is_null($idPlanet))
            $this->id = $this->getId();
        else
        {
            $this->id = $idPlanet;
            $this->tech = new TechnologyController($doctrine, $this->idPlayer, $this->id);
            
            //Récupère les ressources de la planète
            $find = $this->doctrine->getEntityManager()->getRepository('XNovaCoreBundle:Planet')->find($this->id);
            if(is_object($find))
            {
                $this->name = $find->getName();
                $this->metal = $find->getMetal();
                $this->diamond = $find->getDiamond();
                $this->gold = $find->getGold();
                $this->antimatter = $find->getAntimatter();
                $this->energy = $find->getEnergy();
                $this->metalFactory = $find->getMetalFactory();
                $this->diamondFactory = $find->getDiamondFactory();
                $this->goldFactory = $find->getGoldFactory();
                $this->antimatterFactory = $find->getAntimatterFactory();
                $this->lastUpdate = $find->getLastUpdate();
                $this->antimatterPowerPlant = $find->getAntimatterPowerPlant();
                $this->solarPowerPlant = $find->getSolarPowerPlant();
                $this->shipyard = $find->getShipyard();
                $this->naniteFactory = $find->getNaniteFactory();
                $this->robotFactory = $find->getRobotFactory();
            }
        }
            
    }
    
    /**
     * Retourne l'id de la planète
     * 
     * @return int $id id 
     */
    private function getId()
    {
        $repo = $this->doctrine->getEntityManager()->getRepository('XNovaCoreBundle:Planet');
        $planet = $repo->findBy(array("idPlayer" => $this->idPlayer));
        if(!empty($planet))
            return $planet[0]->id;
    }
    
    /**
     * Crée une nouvelle planète et retourne son id
     * 
     * @return int $id id de la nouvelle planète
     */
    public function newPlanet()
    {
        $config = $this->doctrine->getEntityManager()->getRepository('XNovaCoreBundle:Config');
        
        $coords =  $this->getPositionToCreateNewPlanet();
        
        $planet = new Planet;
        
        $planet->setIdPlayer($this->idPlayer);
        $planet->setPlanet($coords[0]);
        $planet->setGalaxy($coords[2]);
        $planet->setSystem($coords[1]);
        $planet->setMetal($config->getValueByParameter('METAL')->getValue());
        $planet->setDiamond($config->getValueByParameter('DIAMOND')->getValue());
        $planet->setAntimatter($config->getValueByParameter('ANTIMATTER')->getValue());
        $planet->setGold($config->getValueByParameter('GOLD')->getValue());
        $planet->setLastUpdate( time() );
        
        $em = $this->doctrine->getEntityManager();
        $em->persist($planet);
        $em->flush();
        
        //Renvois de l'id
        $this->id = $this->getId();
        
        //Affectation automatique de cette planète à l'utilisateur
        $player = $this->doctrine->getEntityManager()->getRepository('XNovaCoreBundle:Player');
        $player->updateIdCurrentPlanet($this->idPlayer, $this->id);
        
        return $this->id;
    }
    
    /**
     *  Retourne un array contenant une position libre pour une nouvelle planète
     * 
     * @return int $coords[0] Position de la planète
     * @return int $coords[1] Système
     * @return int $coords[2] Galaxie
     */
    private function getPositionToCreateNewPlanet() //Nom à ralonge++
    {
        $config = $this->doctrine->getEntityManager()->getRepository('XNovaCoreBundle:Config');
        $planet = $this->doctrine->getEntityManager()->getRepository('XNovaCoreBundle:Planet');
        
        $lastPosition = $config->getValueByParameter('LAST_PLANET')->getValue();
        $lastSystem = $config->getValueByParameter('LAST_SYSTEM')->getValue();
        $lastGalaxy = $config->getValueByParameter('LAST_GALAXY')->getValue();

        $positionFound = FALSE;
        do
        {
            $nbrePlanets = $planet->planetsInSystem($lastSystem, $lastGalaxy);
            if($nbrePlanets >= 5)
            {
                $lastSystem += 1;
                if($lastSystem > 250)
                {
                    $lastSystem = 1;
                    $lastGalaxy += 1;
                }
            }
            else
            {
                $free = FALSE;
                do
                {
                   $position = rand(2, 12);
                   $free = $planet->freePlanet($position, $lastSystem, $lastGalaxy);
                }while($free == FALSE);
                
                $coords[0] = $position;
                $coords[1] = $lastSystem;
                $coords[2] = $lastGalaxy;
                
                $positionFound = TRUE;
            }
       }while($positionFound == FALSE);
       
      $config->setValueByParameter("LAST_PLANET", $coords[0]);
      $config->setValueByParameter("LAST_SYSTEM", $coords[1]);
      $config->setValueByParameter("LAST_GALAXY", $coords[2]);
       
       return $coords;
         
    }
    
    /**
     * Retourne un array nommé $data contenant la quantité de ressources produites chaque heure
     * 
     * @return array $data  array contenant la quantité de ressources produites chaque heure
     */
    private function getProductionByHour()
    {
        $config = $this->doctrine->getEntityManager()->getRepository('XNovaCoreBundle:Config');
        $speed = $config->getValueByParameter('PRODUCTION_SPEED')->getValue();
        $energyFactor = $config->getValueByParameter('ENERGY_FACTOR')->getValue();
        
        //Metal
        $metal = (30*$this->metalFactory*pow(1.1, $this->metalFactory)*$speed);
        
        //Diamond
        $diamond =  (20*$this->diamondFactory*pow(1.1, $this->diamondFactory)*$speed);
        
        //Gold
        $gold = (10*$this->goldFactory*pow(1.1, $this->goldFactory)*$speed);
        
        //Antimatter
        $antimatter = (8*$this->antimatterFactory*pow(1.1, $this->antimatterFactory)*$speed*pow(1.05+($this->tech->energy*0.01), $this->tech->energy));
        
        //Energy
        $solarEnergy = 30*$this->solarPowerPlant*  pow(1.1, $this->solarPowerPlant)*$speed;
        $antimatterEnergy = 30*$this->antimatterPowerPlant*pow(1.1, $this->antimatterPowerPlant)*$speed*  pow(1.05+($this->tech->energy*0.01), $this->antimatterPowerPlant);
        
        $metalFactory = 10*$this->metalFactory*pow(1.1, $this->metalFactory)*$energyFactor;
        $diamondFactory = 10*$this->diamondFactory*pow(1.1, $this->diamondFactory)*$energyFactor;
        $goldFactory = 20*$this->goldFactory*pow(1.1, $this->goldFactory)*$energyFactor;
        $antimatterFactory = 20*$this->antimatterFactory*pow(1.1, $this->antimatterFactory)*$energyFactor;
        $energy = ($solarEnergy + $antimatterEnergy) - ($metalFactory + $diamondFactory + $goldFactory + $antimatterFactory);
        
        $data = array(
            'metal' => $metal,
            'diamond' => $diamond,
            'gold' => $gold,
            'antimatter' => $antimatter,
            'energy' => $energy
        );
        
        return $data;
    }
    
    /*
     * Fonction permettant de mettre à jour les ressources d'une planète
     */
    public function updateRessources()
    {
        $planet = $this->doctrine->getEntityManager()->getRepository('XNovaCoreBundle:Planet');
        
        $time = time()-$this->lastUpdate;
        $productionByHour = $this->getProductionByHour();
        if($productionByHour['energy'] <= 0)
        {
            $newMetal = $this->metal + $time*($productionByHour["metal"]/3600) + ($productionByHour['energy']/3600);
            $newGold = $this->gold + $time*($productionByHour["gold"]/3600) + ($productionByHour['energy']/3600);
            $newDiamond = $this->diamond + $time*($productionByHour["diamond"]/3600) + ($productionByHour['energy']/3600);
            $newAntimatter = $this->antimatter + ($time*($productionByHour["antimatter"]/3600)) + ($productionByHour['energy']/3600);
            if($newMetal <= $this->metal)
                $newMetal = $this->metal;
            if($newDiamond <= $this->diamond)
                $newDiamond = $this->diamond;
            if($newGold <= $this->gold)
                $newGold = $this->gold;
            if($newAntimatter <= $this->antimatter)
                $newAntimatter = $this->antimatter;
        }
        else
        {
            $newMetal = $this->metal + $time*($productionByHour["metal"]/3600);
            $newGold = $this->gold + $time*($productionByHour["gold"]/3600);
            $newDiamond = $this->diamond + $time*($productionByHour["diamond"]/3600);
            $newAntimatter = $this->antimatter + $time*($productionByHour["antimatter"]/3600);
        }
        // Ressources de base sans mines : 10métal/h 4diamand/h
        $data = array(
            'metal' => $newMetal + $time*(10/3600),
            'diamond' => $newDiamond +  $time*(4/3600),
            'gold' => $newGold,
            'antimatter' => $newAntimatter,
            'energy' => $productionByHour['energy'],
            'lastUpdate' => time()
        );
        $planet->updateRessources($this->id, $data);
    }
    
}
?>
