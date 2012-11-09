<?php

namespace Rithis\BECRussiaBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\AbstractType;

class SchoolCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('authorName', null, array('label' => 'Ваше имя'));
        $builder->add('authorEmail', null, array('label' => 'E-mail для связи'));
        $builder->add('text', null, array('label' => 'Текст отзыва'));
        $builder->add('captcha', 'captcha');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rithis\\BECRussiaBundle\\Entity\\SchoolComment',
        ));
    }

    public function getName()
    {
        return 'school_comment';
    }
}
