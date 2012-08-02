<?php

namespace XNova\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XNova\CoreBundle\Entity\Planet
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="XNova\CoreBundle\Entity\PlanetRepository")
 */
class Planet
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var integer $idPlayer
     *
     * @ORM\ManyToOne(targetEntity="XNova\CoreBundle\Entity\Player")
     * @ORM\Column(name="idPlayer", type="integer")
     */
    private $idPlayer;

    /**
     * @var integer $planet
     *
     * @ORM\Column(name="planet", type="integer")
     */
    private $planet;

    /**
     * @var integer $system
     *
     * @ORM\Column(name="system", type="integer")
     */
    private $system;

    /**
     * @var integer $galaxy
     *
     * @ORM\Column(name="galaxy", type="integer")
     */
    private $galaxy;

    /**
     * @var text $name
     *
     * @ORM\Column(name="name", type="text", nullable=true)
     */
    private $name;

    /**
     * @var integer $lastUpdate
     *
     * @ORM\Column(name="lastUpdate", type="integer", nullable=true)
     */
    private $lastUpdate;

    /**
     * @var bigint $metal
     *
     * @ORM\Column(name="metal", type="float")
     */
    private $metal;

    /**
     * @var bigint $diamond
     *
     * @ORM\Column(name="diamond", type="float")
     */
    private $diamond;

    /**
     * @var bigint $gold
     *
     * @ORM\Column(name="gold", type="float")
     */
    private $gold;

    /**
     * @var bigint $antimatter
     *
     * @ORM\Column(name="antimatter", type="float")
     */
    private $antimatter;

    /**
     * @var bigint $energy
     *
     * @ORM\Column(name="energy", type="float", nullable=true)
     */
    private $energy = 0;
    
    /**
     * @var integer $metalFactory
     *
     * @ORM\Column(name="metalFactory", type="integer", nullable=true)
     */
    private $metalFactory = 0;
    
    /**
     * @var integer $diamondFactory
     *
     * @ORM\Column(name="diamondFactory", type="integer", nullable=true)
     */
    private $diamondFactory = 0;
    
    /**
     * @var integer $goldFactory
     *
     * @ORM\Column(name="goldFactory", type="integer", nullable=true)
     */
    private $goldFactory = 0;
    
    /**
     * @var integer $solarPowerPlant
     *
     * @ORM\Column(name="solarPowerPlant", type="integer", nullable=true)
     */
    private $solarPowerPlant = 0;
    
    /**
     * @var integer $antimatterFactory
     *
     * @ORM\Column(name="antimatterFactory", type="integer", nullable=true)
     */
    private $antimatterFactory = 0;
    
     /**
     * @var integer $antimatterPowerPlant
     *
     * @ORM\Column(name="antimatterPowerPlant", type="integer", nullable=true)
     */
    private $antimatterPowerPlant = 0;
    
    /**
     * @var integer $shipyard
     *
     * @ORM\Column(name="shipyard", type="integer", nullable=true)
     */
    private $shipyard = 0;
    
    /**
     * @var integer $robotFactory
     *
     * @ORM\Column(name="robotFactory", type="integer", nullable=true)
     */
    private $robotFactory = 0;
    
    /**
     * @var integer $naniteFactory
     *
     * @ORM\Column(name="naniteFactory", type="integer", nullable=true)
     */
    private $naniteFactory = 0;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idPlayer
     *
     * @param integer $idOwner
     */
    public function setIdPlayer($idPlayer)
    {
        $this->idPlayer = $idPlayer;
    }

    /**
     * Get idPlayer
     *
     * @return integer 
     */
    public function getIdPlayer()
    {
        return $this->idPlayer;
    }

    /**
     * Set planet
     *
     * @param integer $planet
     */
    public function setPlanet($planet)
    {
        $this->planet = $planet;
    }

    /**
     * Get planet
     *
     * @return integer 
     */
    public function getPlanet()
    {
        return $this->planet;
    }

    /**
     * Set system
     *
     * @param integer $system
     */
    public function setSystem($system)
    {
        $this->system = $system;
    }

    /**
     * Get system
     *
     * @return integer 
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * Set galaxy
     *
     * @param integer $galaxy
     */
    public function setGalaxy($galaxy)
    {
        $this->galaxy = $galaxy;
    }

    /**
     * Get galaxy
     *
     * @return integer 
     */
    public function getGalaxy()
    {
        return $this->galaxy;
    }

    /**
     * Set name
     *
     * @param text $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return text 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastUpdate
     *
     * @param integer $lastUpdate
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    }

    /**
     * Get lastUpdate
     *
     * @return integer 
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set metal
     *
     * @param bigint $metal
     */
    public function setMetal($metal)
    {
        $this->metal = $metal;
    }

    /**
     * Get metal
     *
     * @return bigint 
     */
    public function getMetal()
    {
        return $this->metal;
    }

    /**
     * Set diamond
     *
     * @param bigint $diamond
     */
    public function setDiamond($diamond)
    {
        $this->diamond = $diamond;
    }

    /**
     * Get diamond
     *
     * @return bigint 
     */
    public function getDiamond()
    {
        return $this->diamond;
    }

    /**
     * Set gold
     *
     * @param bigint $gold
     */
    public function setGold($gold)
    {
        $this->gold = $gold;
    }

    /**
     * Get gold
     *
     * @return bigint 
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * Set antimatter
     *
     * @param bigint $antimatter
     */
    public function setAntimatter($antimatter)
    {
        $this->antimatter = $antimatter;
    }

    /**
     * Get antimatter
     *
     * @return bigint 
     */
    public function getAntimatter()
    {
        return $this->antimatter;
    }

    /**
     * Set energy
     *
     * @param bigint $energy
     */
    public function setEnergy($energy)
    {
        $this->energy = $energy;
    }

    /**
     * Get energy
     *
     * @return bigint 
     */
    public function getEnergy()
    {
        return $this->energy;
    }

    /**
     * Set metalFactory
     *
     * @param integer $metalFactory
     */
    public function setMetalFactory($metalFactory)
    {
        $this->metalFactory = $metalFactory;
    }

    /**
     * Get metalFactory
     *
     * @return integer 
     */
    public function getMetalFactory()
    {
        return $this->metalFactory;
    }

    /**
     * Set diamondFactory
     *
     * @param integer $diamondFactory
     */
    public function setDiamondFactory($diamondFactory)
    {
        $this->diamondFactory = $diamondFactory;
    }

    /**
     * Get diamondFactory
     *
     * @return integer 
     */
    public function getDiamondFactory()
    {
        return $this->diamondFactory;
    }

    /**
     * Set goldFactory
     *
     * @param integer $goldFactory
     */
    public function setGoldFactory($goldFactory)
    {
        $this->goldFactory = $goldFactory;
    }

    /**
     * Get goldFactory
     *
     * @return integer 
     */
    public function getGoldFactory()
    {
        return $this->goldFactory;
    }

    /**
     * Set antimatterFactory
     *
     * @param integer $antimatterFactory
     */
    public function setAntimatterFactory($antimatterFactory)
    {
        $this->antimatterFactory = $antimatterFactory;
    }

    /**
     * Get antimatterFactory
     *
     * @return integer 
     */
    public function getAntimatterFactory()
    {
        return $this->antimatterFactory;
    }

    /**
     * Set solarPowerPlant
     *
     * @param integer $solarPowerPlant
     */
    public function setSolarPowerPlant($solarPowerPlant)
    {
        $this->solarPowerPlant = $solarPowerPlant;
    }

    /**
     * Get solarPowerPlant
     *
     * @return integer 
     */
    public function getSolarPowerPlant()
    {
        return $this->solarPowerPlant;
    }

    /**
     * Set antimatterPowerPlant
     *
     * @param integer $antimatterPowerPlant
     */
    public function setAntimatterPowerPlant($antimatterPowerPlant)
    {
        $this->antimatterPowerPlant = $antimatterPowerPlant;
    }

    /**
     * Get antimatterPowerPlant
     *
     * @return integer 
     */
    public function getAntimatterPowerPlant()
    {
        return $this->antimatterPowerPlant;
    }

    /**
     * Set shipyard
     *
     * @param integer $shipyard
     */
    public function setShipyard($shipyard)
    {
        $this->shipyard = $shipyard;
    }

    /**
     * Get shipyard
     *
     * @return integer 
     */
    public function getShipyard()
    {
        return $this->shipyard;
    }

    /**
     * Set robotFactory
     *
     * @param integer $robotFactory
     */
    public function setRobotFactory($robotFactory)
    {
        $this->robotFactory = $robotFactory;
    }

    /**
     * Get robotFactory
     *
     * @return integer 
     */
    public function getRobotFactory()
    {
        return $this->robotFactory;
    }

    /**
     * Set naniteFactory
     *
     * @param integer $naniteFactory
     */
    public function setNaniteFactory($naniteFactory)
    {
        $this->naniteFactory = $naniteFactory;
    }

    /**
     * Get naniteFactory
     *
     * @return integer 
     */
    public function getNaniteFactory()
    {
        return $this->naniteFactory;
    }
}