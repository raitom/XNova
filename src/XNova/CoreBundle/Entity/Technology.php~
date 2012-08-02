<?php

namespace XNova\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XNova\CoreBundle\Entity\Technology
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="XNova\CoreBundle\Entity\TechnologyRepository")
 */
class Technology
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
     * @ORM\Column(name="idPlayer", type="integer")
     */
    private $idPlayer;

    /**
     * @var integer $idPlanet
     *
     * @ORM\Column(name="idPlanet", type="integer")
     */
    private $idPlanet;

    /**
     * @var integer $energy
     *
     * @ORM\Column(name="energy", type="integer", nullable=true)
     */
    private $energy = 0;


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
     * @param integer $idPlayer
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
     * Set idPlanet
     *
     * @param integer $idPlanet
     */
    public function setIdPlanet($idPlanet)
    {
        $this->idPlanet = $idPlanet;
    }

    /**
     * Get idPlanet
     *
     * @return integer 
     */
    public function getIdPlanet()
    {
        return $this->idPlanet;
    }

    /**
     * Set energy
     *
     * @param integer $energy
     */
    public function setEnergy($energy)
    {
        $this->energy = $energy;
    }

    /**
     * Get energy
     *
     * @return integer 
     */
    public function getEnergy()
    {
        return $this->energy;
    }
}