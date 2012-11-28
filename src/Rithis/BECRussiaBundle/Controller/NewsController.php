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
        $filter = $this->getRequest()->query->get('filter');
        $query = $this->getRepository('News')->createSortedQueryBuilder($this->getSelectedTown());

        if ($filter == 'centre') {
            $query->andWhere('n.school IS NULL');
        } else if ($filter == 'schools') {
            $query->andWhere('n.school IS NOT NULL');
        }

        $pagination = $this->get('knp_paginator')->paginate(
            $query,
            $this->getRequest()->query->get('page', 1),
            10
        );

        return array('pagination' => $pagination, 'filter' => $filter);
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
