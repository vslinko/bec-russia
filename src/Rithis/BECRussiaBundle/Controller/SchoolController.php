<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Rithis\BECRussiaBundle\Entity\School;

/**
 * @Route("/schools")
 */
class SchoolController extends BaseController
{
    /**
     * @Route("/")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function allAction()
    {
        return array(
            'schools' => $this->getRepository('School')->findForAllPageBlock($this->getSelectedTown()),
        );
    }

    /**
     * @Route("/{slug}")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function getAction(School $school)
    {
    }

    /**
     * @Route("/{slug}/teachers/")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function teachersAction(School $school)
    {
    }

    /**
     * @Route("/{slug}/discounts")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function discountsAction(School $school)
    {
    }

    /**
     * @Route("/{slug}/contacts")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function contactsAction(School $school)
    {
    }

    /**
     * @Route("/{slug}/news/")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function newsAction(School $school)
    {
        $query = $this->getRepository('News')->createSchoolNewsQueryBuilder($school);

        $pagination = $this->get('knp_paginator')->paginate(
            $query,
            $this->getRequest()->query->get('page', 1),
            10
        );

        return array('pagination' => $pagination);
    }
}
