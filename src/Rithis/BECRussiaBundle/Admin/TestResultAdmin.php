<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

class TestResultAdmin extends Admin
{
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper->addIdentifier('title');
    }

    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper->add('title');
        $mapper->add('minimalPoints');
        $mapper->add('result', null, array('attr' => array('class' => 'tinymce')));
    }
}
