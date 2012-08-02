<?php

namespace XNova\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class XNovaUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
   
}

?>
