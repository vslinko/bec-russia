<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

class SchoolCommentAdmin extends Admin
{
    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper->add('authorName');
        $mapper->add('authorEmail');
        $mapper->add('text');
        $mapper->add('moderated');
    }
}
