<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Rithis\BECRussiaBundle\Entity\Page;

class PageController extends BaseController
{
    /**
     * @Template
     */
    public function getAction(Page $page)
    {
    }
}
