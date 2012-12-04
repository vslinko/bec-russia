<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Rithis\BECRussiaBundle\Entity\BookCategory;
use Rithis\BECRussiaBundle\Entity\Book;

/**
 * @Route("/library")
 */
class LibraryController extends BaseController
{
    /**
     * @Route("/")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function libraryAction()
    {
        $query = $this->getRepository('Media')
            ->createQueryBuilder('m')
            ->where('m.context = :context')
            ->setParameter('context', 'library');

        if ($this->getRequest()->query->has('provider') && 'all' !== $this->getRequest()->query->get('provider')) {
            $provider = $this->getRequest()->query->get('provider');
            $query->andWhere('m.providerName = :provider')
                ->setParameter('provider', 'rithis.becrussia.library.provider.' . $provider);
        } else {
            $provider = 'all';
        }

        $pagination = $this->get('knp_paginator')->paginate(
            $query,
            $this->getRequest()->query->get('page', 1),
            10,
            array('distinct' => false)
        );

        return array('pagination' => $pagination, 'provider' => $provider);
    }

    /**
     * @Route("/{slug}")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function categoryAction(BookCategory $category)
    {
    }

    public function booksActions()
    {
        return array(
            'publications' => $this->get('sonata.media.manager.media')
                ->findBy(array(
                    'context' => 'publication',
                )),
        );
    }
}
