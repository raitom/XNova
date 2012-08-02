<?php

namespace XNova\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XNova\CoreBundle\Entity\Player
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="XNova\CoreBundle\Entity\PlayerRepository")
 */
class Player
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
     * @var integer $idUser
     *
     * @ORM\Column(name="idUser", type="integer")
     * @ORM\ManyToOne(targetEntity="XNova\UserBundle\Entity\User", cascade={"remove"} )
     * @ORM\OneToOne(targetEntity="XNova\CoreBundle\Entity\Technology", cascade={"remove"})
     */
    public $idUser;

    /**
     * @var integer $idCurrentPlanet
     *
     * @ORM\Column(name="idCurrentPlanet", type="integer")
     */
    public $idCurrentPlanet;


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
     * Set idUser
     *
     * @param integer $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idCurrentPlanet
     *
     * @param integer $idCurrentPlanet
     */
    public function setIdCurrentPlanet($idCurrentPlanet)
    {
        $this->idCurrentPlanet = $idCurrentPlanet;
    }

    /**
     * Get idCurrentPlanet
     *
     * @return integer 
     */
    public function getIdCurrentPlanet()
    {
        return $this->idCurrentPlanet;
    }
}