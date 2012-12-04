<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\MediaBundle\Provider\Pool;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\MediaBundle\Admin\GalleryAdmin;

class SchoolGalleryAdmin extends Admin
{
    protected $pool;

    public function __construct($code, $class, $baseControllerName, Pool $pool, $translator)
    {
        parent::__construct($code, $class, $baseControllerName);

        $this->pool = $pool;
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('enabled', null, array('required' => false))
            ->add('name')
            ->add('description')
        ;

        if (!$this->getSubject() || !$this->getSubject()->getId()) {
            $choices = array();
            foreach ($this->pool->getProviderNamesByContext($this->getContext()) as $provider) {
                $choices[$provider] = $this->translator->trans($provider, array(), 'rithis_bec_russia_library');
            }
        
            $formMapper->add('provider', 'choice', array(
                'choices' => $choices,
            ));
        }
        
        $formMapper->add('galleryHasMedias', 'sonata_type_collection', array('by_reference' => false), array(
            'edit' => 'inline',
            'inline' => 'table',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($gallery)
    {
        $parameters = $this->getPersistentParameters();

        $gallery->setContext($parameters['context']);

        // fix weird bug with setter object not being call
        $gallery->setGalleryHasMedias($gallery->getGalleryHasMedias());
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($gallery)
    {
        // fix weird bug with setter object not being call
        $gallery->setGalleryHasMedias($gallery->getGalleryHasMedias());
    }

    /**
     * {@inheritdoc}
     */
    public function getPersistentParameters()
    {
        if (!$this->hasRequest()) {
            return array();
        }

        $formats = array_keys($this->pool->getFormatNamesByContext($this->getContext()));
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
            'format' => count($formats) > 0 ? array_shift($formats) : 'default',
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
            $gallery->setDefaultFormat($this->getPersistentParameter('format'));

            if ($this->getRequest()->get('school_id')) {
                $school = $this->getModelManager()
                    ->find(
                        'Rithis\BECRussiaBundle\Entity\School',
                        $this->getRequest()->get('school_id')
                    );

                $gallery->setSchool($school);
            }
        }

        return $gallery;
    }
    
    public function getContext()
    {
        return 'school_gallery';
    }

}