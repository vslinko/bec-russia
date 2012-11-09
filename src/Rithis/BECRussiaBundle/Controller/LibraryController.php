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
    public function categoriesAction()
    {
        return array(
            'categories' => $this->getRepository('BookCategory')->findAll(),
        );
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
