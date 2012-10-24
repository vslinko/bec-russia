<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin;

class PhoneAdmin extends Admin
{
    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper->add('number');
        $mapper->add('visibleForTown', null, array('required' => false));
    }
}
