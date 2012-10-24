<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

class TeacherAdmin extends Admin
{
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper->addIdentifier('name');
        $mapper->add('school');
    }

    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper->add('name');
        $mapper->add('description');
        $mapper->add('school');
    }
}
