<?php

namespace XNova\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SiteController extends Controller
{
    public function indexAction()
    {
        return $this->render("XNovaSiteBundle::index.html.twig");
    }
}

?>