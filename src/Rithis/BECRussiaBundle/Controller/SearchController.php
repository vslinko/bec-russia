<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/search")
 */
class SearchController extends BaseController
{
    /**
     * @Route("/")
     * @Method("GET")
     * @Template
     */
    public function getAction()
    {
        if ($this->getRequest()->query->has('query')) {
            $query = $this->getRequest()->query->get('query');

            $finder = $this->get('foq_elastica.finder.website.page');
            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate($finder->createPaginatorAdapter($query));

            return array('query' => $query, 'pagination' => $pagination);
        }

        return array();
    }
}
