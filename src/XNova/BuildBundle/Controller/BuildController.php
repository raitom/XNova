<?php
namespace XNova\BuildBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use XNova\CoreBundle\Controller\GameController;
use Symfony\Component\Config\FileLocator;

class BuildController extends GameController
{
    /**
     * Affiche la page permettant de construire les bâtiments
     * 
     * @param string $action building,defense,ship ou tech
     */
    public function defaultAction($action)
    {
        $items = $this->loadXML($action);
        $config = $this->container->get('doctrine')->getEntityManager()->getRepository('XNovaCoreBundle:Config');
        $speed = $config->getValueByParameter('BUILDING_SPEED')->getValue();
        foreach($items as $subItems)
        {
            $subItems->time = $this->getTime($subItems, $action, $speed) / 60;
            $cost = $this->getBuildingCost($subItems);
            $subItems->ressources->metal = $cost['metal'];
            $subItems->ressources->diamond = $cost['diamond'];
            $subItems->ressources->gold = $cost['gold'];
            $subItems->ressources->antimatter = $cost['antimatter'];
        }
        $this->varView['items'] = $items;
        
        switch($action)
        {
            case "building":
                return $this->render("XNovaBuildBundle::building.html.twig", $this->varView);
                break;
        }
    }
    
    public function buildAction($action, $id)
    {
        
    }
        
    /**
     * Charge un fichier XML
     * 
     * @param string $action 4 choix possible : building, defense, tech et ship 
     */
    private function loadXML($action)
    {
        switch ($action)
        {
            case "building":
                return new \SimpleXMLElement(file_get_contents(__DIR__.'./../XML/building.xml'));
                break;
            
            case "defense":
                return new \SimpleXMLElement(file_get_contents(__DIR__.'./../XML/defense.xml'));
                break;
            
            case "tech":
                return new \SimpleXMLElement(file_get_contents(__DIR__.'./../XML/tech.xml'));
                break;
            
            case "ship":
                return new \SimpleXMLElement(file_get_contents(__DIR__.'./../XML/ship.xml'));
                break;
        }
    }
    
    private function getTime($item, $action, $speed)
    {
        if($speed == NULL)
        {
            $config = $this->container->get('doctrine')->getEntityManager()->getRepository('XNovaCoreBundle:Config');
            $speed = $config->getValueByParameter('BUILDING_SPEED')->getValue();
        }
        
        switch($action)
        {
            case "building":
                
                $cost = $this->getBuildingCost($item);
                return (($cost['metal']+$cost['diamond']) / $speed) * (2/(1+ $this->player->planet->robotFactory)) * pow(0.5, $this->player->planet->naniteFactory) * 60 * 60;
                break;
        }
    }
    
    /**
     * Récupère le coût de construction d'un bâtiment dans un array
     * 
     * @param SimpleXMLElement $item Un bâtiment du fichier BuildBundle/XML/building.xml
     * @return array Coût de construction d'un bâtiment
     */
    private function getBuildingCost($item)
    {
        $bddName = $item->bddName;
        $factor = $item->factor * $this->player->planet->$bddName;
        
        if($factor == 0)
            $factor = 1;
        
        return array(
            'metal' => $item->ressources->metal * $factor,
            'diamond' => $item->ressources->diamond * $factor,
            'gold' => $item->ressources->gold * $factor,
            'antimatter' => $item->ressources->antimatter  * $factor
        );
    }
}
?>
