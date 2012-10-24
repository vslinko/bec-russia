<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Rithis\BECRussiaBundle\Entity\News;

/**
 * @Route("/news")
 */
class NewsController extends BaseController
{
    /**
     * @Route("/")
     * @Method("GET")
     * @Template
     * @Cache(expires="+1 Hour")
     */
    public function allAction()
    {
        $query = $this->getRepository('News')->createSortedQueryBuilder($this->getSelectedTown());

        $pagination = $this->get('knp_paginator')->paginate(
            $query,
            $this->getRequest()->query->get('page', 1),
            10
        );

        return array('pagination' => $pagination);
    }

    /**
     * @Route("/{slug}")
     * @Method("GET")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function getAction(News $news)
    {
    }

    /**
     * @Template
     * @Cache(expires="+1 Hour")
     */
    public function centreNewsBlockAction()
    {
        return array(
            'news' => $this->getRepository('News')->findForCentreNewsBlock(),
        );
    }

    /**
     * @Template
     * @Cache(expires="+1 Hour")
     */
    public function schoolsNewsBlockAction()
    {
        return array(
            'news' => $this->getRepository('News')->findForSchoolsNewsBlock($this->getSelectedTown()),
        );
    }
}
