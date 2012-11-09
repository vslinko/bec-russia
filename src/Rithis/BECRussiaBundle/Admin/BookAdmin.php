<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

class BookAdmin extends Admin
{
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper->addIdentifier('name');
        $mapper->addIdentifier('category');
    }

    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper->add('name');
        $mapper->add('description');
        $mapper->add('category', 'sonata_type_model');
        $mapper->add('file', 'sonata_type_model', array('by_reference' => true), array(
            'link_parameters' => array(
                'context'           => 'book',
                'provider'          => 'sonata.media.provider.file',
            )
        ));
    }
}
