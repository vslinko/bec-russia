<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Rithis\BECRussiaBundle\Entity\PageRepository")
 * @ORM\Table("pages")
 */
class Page
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="pages_id_seq")
     */
    protected $id;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $uri;

    /**
     * @ORM\Column("secret_key", nullable=true)
     */
    protected $secretKey;

    /**
     * @ORM\Column
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}
