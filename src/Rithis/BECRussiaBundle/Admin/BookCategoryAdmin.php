<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

class BookCategoryAdmin extends Admin
{
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper->addIdentifier('name');
        $mapper->addIdentifier('description');
    }

    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper->add('name');
        $mapper->add('description');
        $mapper->add('books', null, array(
            'required' => false,
        ), array());
    }
}
