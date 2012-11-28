<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

use Rithis\BECRussiaBundle\Entity\TestResult;

class EducationCourseAdmin extends Admin
{
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper->addIdentifier('title');
        $mapper->add('towns');
    }

    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper->add('title');
        $mapper->add('type', 'sonata_type_model');
        $mapper->add('annotation');
        $mapper->add('description', null, array('attr' => array('class' => 'tinymce')));
        $mapper->add('reason');
        $mapper->add('schedule');
        $mapper->add('image', 'sonata_type_model', array(), array('link_parameters' => array('context' => 'education_course')));
        $mapper->add('website', null, array('required' => false));
        $mapper->add('schools');
        $mapper->add('languageLevel', 'choice', array('choices' => array(
            TestResult::TYPE_BEGINNER => TestResult::TYPE_BEGINNER,
            TestResult::TYPE_ELEMENTARY => TestResult::TYPE_ELEMENTARY,
            TestResult::TYPE_PRE_INTERMEDIATE => TestResult::TYPE_PRE_INTERMEDIATE,
            TestResult::TYPE_INTERMEDIATE => TestResult::TYPE_INTERMEDIATE,
            TestResult::TYPE_UPPER_INTERMEDIATE => TestResult::TYPE_UPPER_INTERMEDIATE,
            TestResult::TYPE_ADVANCED => TestResult::TYPE_ADVANCED,
        )));
    }
}
