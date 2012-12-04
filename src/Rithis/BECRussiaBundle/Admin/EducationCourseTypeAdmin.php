<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

class EducationCourseTypeAdmin extends Admin
{
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper->addIdentifier('title');
    }

    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper->add('title');
        $mapper->add('note');
        $mapper->add('image', 'sonata_type_model', array(), array('link_parameters' => array('context' => 'ed_course_type')));
        $mapper->add('position');
    }
}
