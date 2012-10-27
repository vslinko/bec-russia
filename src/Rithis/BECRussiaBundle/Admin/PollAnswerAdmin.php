<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

class PollAnswerAdmin extends Admin
{
    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper->add('answer');
    }
}
