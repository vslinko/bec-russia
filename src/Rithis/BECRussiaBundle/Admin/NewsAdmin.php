<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

class NewsAdmin extends Admin
{
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper->addIdentifier('title');
        $mapper->add('school');
    }

    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper->add('title');
        $mapper->add('annotation');
        $mapper->add('description');
        $mapper->add('school', null, array('required' => false));
    }
}
