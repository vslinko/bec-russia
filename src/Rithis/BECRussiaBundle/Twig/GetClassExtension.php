<?php

namespace Rithis\BECRussiaBundle\Twig;

use Doctrine\ORM\EntityManager;

class GetClassExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'get_class' => new \Twig_Filter_Function('get_class'),
        );
    }

    public function getName()
    {
        return 'rithis-get-class';
    }
}
