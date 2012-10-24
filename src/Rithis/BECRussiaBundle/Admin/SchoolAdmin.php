<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

class SchoolAdmin extends Admin
{
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper->addIdentifier('title');
        $mapper->add('town');
    }

    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper->add('title');
        $mapper->add('address');
        $mapper->add('town');
        $mapper->add('phones', 'sonata_type_collection', array('by_reference' => false), array(
            'edit' => 'inline',
            'inline' => 'table'
        ));
    }
}
