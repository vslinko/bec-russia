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
        $mapper->add('image', 'sonata_type_model', array(), array('link_parameters' => array('context' => 'teacher')));
        $mapper->add('description', null, array('attr' => array('class' => 'tinymce')));
        $mapper->add('school', 'sonata_type_model');
    }
}
