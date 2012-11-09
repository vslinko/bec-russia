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
        $mapper->with('Main');
        $mapper->add('title');
        $mapper->add('address');
        $mapper->add('image', 'sonata_type_model', array(), array('link_parameters' => array('context' => 'school')));
        $mapper->add('town', 'sonata_type_model');
        $mapper->add('phones', 'sonata_type_collection', array('by_reference' => false), array(
            'edit' => 'inline',
            'inline' => 'table'
        ));

        $mapper->with('Shedule');
        $mapper->add('schedule', 'file');

        $mapper->with('About Page', array('collapsed' => true));
        $mapper->add('about', null, array('attr' => array('class' => 'tinymce')));

        $mapper->with('Discounts Page', array('collapsed' => true));
        $mapper->add('discounts', null, array('attr' => array('class' => 'tinymce')));
    }
}
