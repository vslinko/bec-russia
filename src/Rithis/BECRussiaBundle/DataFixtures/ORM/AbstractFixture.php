<?php

namespace Rithis\BECRussiaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture as BaseAbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Symfony\Component\DependencyInjection\ContainerAwareInterface,
    Symfony\Component\DependencyInjection\ContainerInterface;

use Rithis\BECRussiaBundle\Entity\School,
    Rithis\BECRussiaBundle\Entity\Phone,
    Rithis\BECRussiaBundle\Entity\Media;

abstract class AbstractFixture extends BaseAbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    protected function addPhones(School $school, array $phoneNumbers)
    {
        foreach ($phoneNumbers as $phoneNumber => $visibleForTown) {
            $phone = new Phone();
            $phone->setNumber($phoneNumber);
            $phone->setVisibleForTown($visibleForTown);
            $school->addPhone($phone);
        }
    }

    protected function getMedia($fileName, $context, $providerName = 'sonata.media.provider.image')
    {
        return $this->saveMedia($this->getFilePath($fileName), $fileName, $context, $providerName);
    }

    protected function getRemoteMedia($url, $context, $providerName = 'sonata.media.provider.image')
    {
        $filePath = tempnam(sys_get_temp_dir(), 'bec-russia');
        file_put_contents($filePath, file_get_contents($url));

        $media = $this->saveMedia($filePath, basename($url), $context, $providerName);

        unlink($filePath);

        return $media;
    }

    protected function getContent($fileName)
    {
        return file_get_contents($this->getFilePath($fileName));
    }

    private function saveMedia($filePath, $fileName, $context, $providerName)
    {
        $media = new Media();
        $media->setName($fileName);
        $media->setBinaryContent($filePath);

        $this->container->get('sonata.media.manager.media')->save($media, $context, $providerName);

        return $media;
    }

    private function getFilePath($fileName)
    {
        return __DIR__ . '/../../Resources/fixtures-data/' . $fileName;
    }
}
