<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Rithis\BECRussiaBundle\Entity\Vacancy;

/**
 * @Route("/vacancies")
 */
class VacancyController extends BaseController
{
    /**
     * @Route("/")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function allAction()
    {
        return array(
            'vacancies' => $this->getRepository('Vacancy')->findForAllPageBlock($this->getSelectedTown()),
        );
    }

    /**
     * @Route("/{slug}")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function getAction(Vacancy $vacancy)
    {
    }
}
