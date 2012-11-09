<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TownController extends BaseController
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
            $town = $this->getRepository('Town')->find($townId);
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
            'selected_town' => $this->getSelectedTown(),
            'towns' => $this->getRepository('Town')->findForTownSelectBlock(),
        );
    }

    /**
     * @Template
     */
    public function townPhonesBlockAction()
    {
        $town = $this->getSelectedTown();

        if ($town) {
            $phones = $this->getRepository('Phone')->findVisibleInTown($town);
        } else {
            $phones = $this->getRepository('Phone')->findGlobal();
        }

        return array(
            'phones' => $phones,
        );
    }
}
