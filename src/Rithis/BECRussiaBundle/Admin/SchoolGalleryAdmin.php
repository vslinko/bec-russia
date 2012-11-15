<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\MediaBundle\Provider\Pool;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\MediaBundle\Admin\GalleryAdmin;

class SchoolGalleryAdmin extends GalleryAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formats = array();
        foreach((array)$this->pool->getFormatNamesByContext($this->getContext()) as $name => $options) {
            $formats[$name] = $name;
        }
        
        $formMapper
            ->add('context', 'hidden', array('data' => $this->getContext()))
            ->add('enabled', null, array('required' => false))
            ->add('name')
            ->add('description')
            ->add('defaultFormat', 'choice', array('choices' => $formats))
            ->add('galleryHasMedias', 'sonata_type_collection', array(
                'by_reference' => false
            ), array(
                'edit' => 'inline',
                'inline' => 'table',
                'sortable'  => 'position',
                'link_parameters' => array('context' => $this->getContext(), 'provider' => $this->getPersistentParameter('provider'))
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($gallery)
    {
        $parameters = $this->getPersistentParameters();

        $gallery->setContext($parameters['context']);
        $gallery->setProvider($parameters['provider']);
    }

    /**
     * {@inheritdoc}
     */
    public function getPersistentParameters()
    {
        if (!$this->hasRequest()) {
            return array();
        }

        $providers = $this->pool->getProvidersByContext($this->getContext());
        $provider  = $this->getRequest()->get('provider');

        // if the context has only one provider, set it into the request
        // so the intermediate provider selection is skipped
        if (count($providers) > 0 && null === $provider) {
            $provider = array_shift($providers)->getName();
            $this->getRequest()->query->set('provider', $provider);
        }

        return array(
            'provider' => $provider,
            'context'  => $this->getContext(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $gallery = parent::getNewInstance();

        if ($this->hasRequest()) {
            $gallery->setContext($this->getPersistentParameter('context'));
            $gallery->setProvider($this->getPersistentParameter('provider'));
        }

        return $gallery;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('enabled')
        ;

        $providers = array();

        $providerNames = (array)$this->pool->getProviderNamesByContext($this->getPersistentParameter('context', $this->getContext()));
        foreach ($providerNames as $name) {
            $providers[$name] = $name;
        }

        $datagridMapper->add('provider', 'doctrine_orm_choice', array(
            'field_options'=> array(
                'choices' => $providers,
                'required' => false,
                'multiple' => false,
                'expanded' => false,
            ),
            'field_type'=> 'choice',
        ));
    }

    public function getContext()
    {
        return 'school_gallery';
    }

    public function getPool()
    {
        return $this->pool;
    }
}