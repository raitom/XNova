<?php

namespace XNova\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PlayerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlayerRepository extends EntityRepository
{
    /**
     * Met à jour l'id de la planète sur laquelle se trouve actuellement le joueur
     * 
     * @param type $id id du joueur
     * @param type $value id de la planète
     */
    public function updateIdCurrentPlanet($id, $value)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->update($this->_entityName, 'p')
            ->set('p.idCurrentPlanet', $value)
            ->where('p.id = :id')
                ->setParameter('id', $id);
        $qb->getQuery()->execute();       
    }
}