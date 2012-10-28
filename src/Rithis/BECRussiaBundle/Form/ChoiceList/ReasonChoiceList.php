<?php

namespace Rithis\BECRussiaBundle\Form\ChoiceList;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList,
    Symfony\Component\Form\Extension\Core\ChoiceList\LazyChoiceList,
    Doctrine\ORM\EntityManager;

class ReasonChoiceList extends LazyChoiceList
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    protected function loadChoiceList()
    {
        $reasons = $this->em->getRepository('RithisBECRussiaBundle:EducationCourse')->findReasons();
        return new SimpleChoiceList(array_combine($reasons, $reasons));
    }
}
