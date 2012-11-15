<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Admin\Admin,
    Doctrine\ORM\EntityRepository;

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
        $mapper->add('schedule', 'file', array('required' => false));

        $mapper->with('Comments', array('collapsed' => true));
        $mapper->add('comments', 'sonata_type_collection', array('by_reference' => false), array(
            'edit' => 'inline',
            'inline' => 'table'
        ));

        $mapper->with('About Page', array('collapsed' => true));
        $mapper->add('about', null, array('attr' => array('class' => 'tinymce')));

        $mapper->with('Discounts Page', array('collapsed' => true));
        $mapper->add('discounts', null, array('attr' => array('class' => 'tinymce')));
        
        $mapper->with('Galleries', array('collapsed' => true));
        $mapper->add('galleries', 'sonata_type_model', array(
            'query' => $this->getModelManager()
                ->getEntityManager('RithisBECRussiaBundle:Gallery')
                ->getRepository('RithisBECRussiaBundle:Gallery')
                ->createQueryBuilder('g')
                ->where('g.context = :context')
                ->setParameter('context', 'school_gallery')
                ->getQuery()
            ,
            'expanded' => true,
            'multiple' => true,
        ));
    }
}
