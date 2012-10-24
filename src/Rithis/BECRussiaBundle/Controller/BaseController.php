<?php

namespace Rithis\BECRussiaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    protected function getSelectedTown()
    {
        return $this->getRequest()->getSession()->get('town');
    }

    protected function getRepository($entityName)
    {
        return $this->getDoctrine()->getManager()->getRepository(sprintf('RithisBECRussiaBundle:%s', $entityName));
    }
}
