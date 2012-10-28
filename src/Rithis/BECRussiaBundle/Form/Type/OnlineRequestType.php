<?php

namespace Rithis\BECRussiaBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\AbstractType;

use Rithis\BECRussiaBundle\Form\ChoiceList\LanguageLevelChoiceList;

class OnlineRequestType extends AbstractType
{
    private $languageLevels;

    public function __construct(LanguageLevelChoiceList $languageLevels)
    {
        $this->languageLevels = $languageLevels;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, array('label' => 'Ваше имя'));
        $builder->add('school', null, array('label' => 'Школа'));
        $builder->add('age', 'choice', array('label' => 'Возраст', 'choices' => array(
            'children' => 'от 4 до 13 лет',
            'teenager' => 'от 14 до 17 лет',
            'adult' => 'от 18 лет',
        )));
        $builder->add('educationCourse', null, array('label' => 'Образовательная программа'));
        $builder->add('languageLevel', 'choice', array('label' => 'Уровень знания английского языка', 'choice_list' => $this->languageLevels));
        $builder->add('note', null, array('label' => 'Текст заявки'));
        $builder->add('email', null, array('label' => 'E-mail для связи'));
        $builder->add('phone', null, array('label' => 'Телефон для связи'));
        $builder->add('captcha', 'captcha');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rithis\\BECRussiaBundle\\Entity\\OnlineRequest',
        ));
    }

    public function getName()
    {
        return 'online_request';
    }
}
