<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

class PageAdmin extends Admin
{
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper->addIdentifier('title');
        $mapper->add('uri');
        $mapper->add('secretKey');
    }

    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper->add('uri');
        $mapper->add('secretKey');
        $mapper->add('title');
        $mapper->add('content', null, array('attr' => array('class' => 'tinymce')));
    }
}
