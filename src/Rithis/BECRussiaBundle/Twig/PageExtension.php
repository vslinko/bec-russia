<?php

namespace Rithis\BECRussiaBundle\Twig;

use Doctrine\ORM\EntityManager;

class PageExtension extends \Twig_Extension
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return array(
            'page' => new \Twig_Function_Method($this, 'page'),
        );
    }

    public function page($secretKey)
    {
        return $this->em->getRepository('RithisBECRussiaBundle:Page')->findOneBy(array('secretKey' => $secretKey));
    }

    public function getName()
    {
        return 'rithis-page';
    }
}
