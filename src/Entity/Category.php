<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_category", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="metatitle", type="string", length=255)
     */
    private $metatitle;

    /**
     * @var string
     *
     * @ORM\Column(name="metadesc", type="string", length=255)
     */
    private $metadesc;

    /**
     * @var string
     *
     * @ORM\Column(name="metakey", type="string", length=255)
     */
    private $metakey;

    /**
     * @var string
     *
     * @ORM\Column(name="metaimage", type="string", length=255)
     */
    private $metaimage;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer")
     */
    private $active;

    /**
     * @var integer
     *
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

	/**
     * @var \DateTime
     * 
     * @ORM\Column(name="cdate", type="datetime")
     */
    private $cdate;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="mdate", type="datetime", nullable=true)
     */
    private $mdate;



    public function __construct()
    {
        $this->active   = false;
        $this->cdate    = new \DateTime();
        $this->mdate    = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function PrePersist()
    {
        $this->cdate    = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->mdate    = new \DateTime();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMetatitle(): ?string
    {
        return $this->metatitle;
    }

    public function setMetatitle(string $metatitle): self
    {
        $this->metatitle = $metatitle;

        return $this;
    }

    public function getMetadesc(): ?string
    {
        return $this->metadesc;
    }

    public function setMetadesc(string $metadesc): self
    {
        $this->metadesc = $metadesc;

        return $this;
    }

    public function getMetakey(): ?string
    {
        return $this->metakey;
    }

    public function setMetakey(string $metakey): self
    {
        $this->metakey = $metakey;

        return $this;
    }

    public function getMetaimage(): ?string
    {
        return $this->metaimage;
    }

    public function setMetaimage(string $metaimage): self
    {
        $this->metaimage = $metaimage;

        return $this;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(int $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getCdate(): ?\DateTimeInterface
    {
        return $this->cdate;
    }

    public function setCdate(\DateTimeInterface $cdate): self
    {
        $this->cdate = $cdate;

        return $this;
    }

    public function getMdate(): ?\DateTimeInterface
    {
        return $this->mdate;
    }

    public function setMdate(\DateTimeInterface $mdate): self
    {
        $this->mdate = $mdate;

        return $this;
    }

}