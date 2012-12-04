<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\MediaBundle\Admin\ORM\MediaAdmin as MediaAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\MediaBundle\Provider\Pool;
use Sonata\MediaBundle\Form\DataTransformer\ProviderDataTransformer;
use Knp\Menu\ItemInterface as ItemInterface;

class LibraryAdmin extends MediaAdmin
{
    protected $translator;

    public function __construct($code, $class, $baseControllerName, Pool $pool, $translator)
    {
        parent::__construct($code, $class, $baseControllerName, $pool);

        $this->translator = $translator;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('description');
        $formMapper->add('binaryContent', 'file', array('required' => false));
        $formMapper->add('context', 'hidden', array('data' => $this->getContext()));

        if (!$this->getSubject() || !$this->getSubject()->getId()) {
            $choices = array();
            foreach ($this->pool->getProviderNamesByContext($this->getContext()) as $provider) {
                $choices[$provider] = $this->translator->trans($provider, array(), 'rithis_bec_russia_library');
            }
        
            $formMapper->add('providerName', 'choice', array(
                'choices' => $choices,
            ));
        }
        
        $formMapper->getFormBuilder()->appendNormTransformer(new ProviderDataTransformer($this->pool));
    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $media = parent::getNewInstance();

        if ($this->hasRequest()) {
            $media->setContext($this->getPersistentParameter('context'));
            $media->setProviderName($this->getPersistentParameter('provider'));
        }

        return $media;
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

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $alias = $query->getQueryBuilder()->getRootAlias();
        $providers = $this->pool->getProviderNamesByContext($this->getContext());
        $request = $this->request->query;

        $query->getQueryBuilder()
            ->where($alias.'.context = :context')
            ->setParameter('context', $this->getContext());

        if ($request->has('provider') && in_array($request->get('provider'), $providers)) {
            $query->getQueryBuilder()
                ->andWhere($alias.'.providerName = :provider')
                ->setParameter('provider', $request->get('provider'));
        }
        
        return $query;
    }
    
    protected function configureSideMenu(ItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
    }

    public function getContext()
    {
        return 'library';
    }
}