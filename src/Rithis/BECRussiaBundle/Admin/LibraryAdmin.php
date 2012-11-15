<?php

namespace Rithis\BECRussiaBundle\Admin;

use Sonata\MediaBundle\Admin\ORM\MediaAdmin as Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class LibraryAdmin extends Admin
{
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

    public function getContext()
    {
        return 'library';
    }
}