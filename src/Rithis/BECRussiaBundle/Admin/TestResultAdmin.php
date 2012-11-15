<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

use Rithis\BECRussiaBundle\Entity\TestResult;

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
        $mapper->add('type', 'choice', array('choices' => array(
            TestResult::TYPE_BEGINNER => TestResult::TYPE_BEGINNER,
            TestResult::TYPE_ELEMENTARY => TestResult::TYPE_ELEMENTARY,
            TestResult::TYPE_PRE_INTERMEDIATE => TestResult::TYPE_PRE_INTERMEDIATE,
            TestResult::TYPE_INTERMEDIATE => TestResult::TYPE_INTERMEDIATE,
            TestResult::TYPE_UPPER_INTERMEDIATE => TestResult::TYPE_UPPER_INTERMEDIATE,
            TestResult::TYPE_ADVANCED => TestResult::TYPE_ADVANCED,
        )));
    }
}
