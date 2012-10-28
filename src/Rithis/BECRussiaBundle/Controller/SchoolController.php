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
        $this->saveLastSchool($school);
    }

    /**
     * @Route("/{slug}/teachers/")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function teachersAction(School $school)
    {
        $this->saveLastSchool($school);
    }

    /**
     * @Route("/{slug}/discounts")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function discountsAction(School $school)
    {
        $this->saveLastSchool($school);
    }

    /**
     * @Route("/{slug}/contacts")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function contactsAction(School $school)
    {
        $this->saveLastSchool($school);
    }

    /**
     * @Route("/{slug}/news/")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function newsAction(School $school)
    {
        $this->saveLastSchool($school);

        $query = $this->getRepository('News')->createSchoolNewsQueryBuilder($school);

        $pagination = $this->get('knp_paginator')->paginate(
            $query,
            $this->getRequest()->query->get('page', 1),
            10
        );

        return array('school' => $school, 'pagination' => $pagination);
    }
}
