<?php

namespace Rithis\BECRussiaBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\AbstractType;

use Rithis\BECRussiaBundle\Form\ChoiceList\LanguageLevelChoiceList,
    Rithis\BECRussiaBundle\Form\ChoiceList\ScheduleChoiceList,
    Rithis\BECRussiaBundle\Form\ChoiceList\ReasonChoiceList;

class EducationCourseSearchType extends AbstractType
{
    private $reasons;
    private $schedules;
    private $languageLevels;

    public function __construct(ReasonChoiceList $reasons, ScheduleChoiceList $schedules, LanguageLevelChoiceList $languageLevels)
    {
        $this->reasons = $reasons;
        $this->schedules = $schedules;
        $this->languageLevels = $languageLevels;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('age', 'choice', array('label' => 'Возраст', 'choices' => array(
            'children' => 'от 4 до 13 лет',
            'teenager' => 'от 14 до 17 лет',
            'adult' => 'от 18 лет',
        )));
        $builder->add('town', 'entity', array('label' => 'Город',
            'class' => 'RithisBECRussiaBundle:Town',
        ));
        $builder->add('reason', 'choice', array('label' => 'Для чего вам английский?', 'choice_list' => $this->reasons));
        $builder->add('schedule', 'choice', array('label' => 'Режим обучения', 'choice_list' => $this->schedules));
        $builder->add('languageLevel', 'choice', array('label' => 'Ваш уровень знаний', 'choice_list' => $this->languageLevels));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rithis\\BECRussiaBundle\\Form\\DataClass\\EducationCourseSearch',
        ));
    }

    public function getName()
    {
        return 'education_course_search';
    }
}
