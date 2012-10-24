<?php

namespace Rithis\BECRussiaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

class TownController extends Controller
{
    /**
     * @Route("/select_town")
     * @Method("POST")
     */
    public function selectAction()
    {
        $request = $this->getRequest();

        $town = null;

        $townId = $request->request->get('town');
        if ($townId) {
            $town = $this->getTownRepository()->find($townId);
        }

        $request->getSession()->set('town', $town);

        return $this->redirect($request->server->get('HTTP_REFERER', '/'));
    }

    /**
     * @Template
     */
    public function townSelectBlockAction()
    {
        return array(
            'selected_town' => $this->getRequest()->getSession()->get('town'),
            'towns' => $this->getTownRepository()->findForTownSelectBlock(),
        );
    }

    private function getTownRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('RithisBECRussiaBundle:Town');
    }
}
