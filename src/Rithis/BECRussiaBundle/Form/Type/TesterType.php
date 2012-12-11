<?php

namespace Rithis\BECRussiaBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\AbstractType;

class TesterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('age', null, array('label' => 'Ваш возраст'));
        $builder->add('firstname', null, array('label' => 'Ваше Имя'));
        $builder->add('lastname', null, array('label' => 'Ваша Фамилия'));
        $builder->add('phone', null, array('label' => 'Ваш телефон'));
        $builder->add('email', null, array('label' => 'Ваш email'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rithis\\BECRussiaBundle\\Entity\\Tester',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'tester';
    }
}
