<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

class TestQuestionAdmin extends Admin
{
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper->addIdentifier('question');
    }

    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper->add('question');
        $mapper->add('answers', 'sonata_type_collection', array('by_reference' => false), array(
            'edit' => 'inline',
            'inline' => 'table'
        ));
    }
}
