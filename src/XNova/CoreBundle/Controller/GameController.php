<?php

namespace XNova\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\SecurityExtraBundle\Annotation\Secure;
use XNova\CoreBundle\Controller\PlayerController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;

class GameController extends Controller
{
    public $player;
    public $varView;
    public $config;
    
    public function preExecute()
    {
        //Chargement des infos du joueur
        $this->player = new PlayerController($this->container->get('doctrine'), $this->container->get('security.context')->getToken()->getUser()->getId(), $this->container->get('fos_user.user_manager'));
        //Mise à jour des ressources de la planète
        $this->player->planet->updateRessources();
        
        //Si vous avez des variables à faire passer dans la vue, complétez celle là.
        $this->varView = array(
            'metal' => (int)$this->player->planet->metal,
            'diamond' => (int)$this->player->planet->diamond,
            'gold' => (int)$this->player->planet->gold,
            'antimatter' => (int)$this->player->planet->antimatter,
            'energy' => (int)$this->player->planet->energy,
        );
    }
    
    /**
     * Affiche le centre de commandement
     * 
     */
    public function indexAction()
    {
        $this->varView['planetName'] = $this->player->planet->name;
        return $this->render("XNovaCoreBundle::index.html.twig", $this->varView);
    }
}

?>
