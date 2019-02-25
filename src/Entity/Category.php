<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

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
     * @Assert\NotBlank(message="category.title.not_blank")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     * @Assert\NotBlank(message="category.alias.not_blank")
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank(message="category.description.not_blank")
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
     * @var int
     *
     * @ORM\Column(name="active", type="integer")
     */
    private $active;

    /**
     * @var int
     *
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
     * @ORM\Column(name="mdate", type="datetime")
     */
    private $mdate;



    public function __construct()
    {
        $this->active = 0;
        $this->cdate  = new \DateTime();
        $this->mdate  = new \DateTime();
    }
    
    /**
     * @ORM\PrePersist
     *
     * @param LifecycleEventArgs $args
     *
     * @return void
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->cdate    = new \DateTime();
        $this->mdate    = new \DateTime();
    }
    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate(): void
    {
        $this->mdate    = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Category
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Category
     */
    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Category
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get metatitle
     *
     * @return string
     */
    public function getMetatitle(): ?string
    {
        return $this->metatitle;
    }

    /**
     * Set metatitle
     *
     * @param string $metatitle
     *
     * @return Category
     */
    public function setMetatitle(string $metatitle): self
    {
        $this->metatitle = $metatitle;

        return $this;
    }

    /**
     * Get metadesc
     *
     * @return string
     */
    public function getMetadesc(): ?string
    {
        return $this->metadesc;
    }

    /**
     * Set metadesc
     *
     * @param string $metadesc
     *
     * @return Category
     */
    public function setMetadesc(string $metadesc): self
    {
        $this->metadesc = $metadesc;

        return $this;
    }

    /**
     * Get metakey
     *
     * @return string
     */
    public function getMetakey(): ?string
    {
        return $this->metakey;
    }

    /**
     * Set metakey
     *
     * @param string $metakey
     *
     * @return Category
     */
    public function setMetakey(string $metakey): self
    {
        $this->metakey = $metakey;

        return $this;
    }

    /**
     * Get metaimage
     *
     * @return string
     */
    public function getMetaimage(): ?string
    {
        return $this->metaimage;
    }

    /**
     * Set metaimage
     *
     * @param string $metaimage
     *
     * @return Category
     */
    public function setMetaimage(string $metaimage): self
    {
        $this->metaimage = $metaimage;

        return $this;
    }

    /**
     * Get active
     *
     * @return int
     */
    public function getActive(): ?int
    {
        return $this->active;
    }

    /**
     * Set active
     *
     * @param int $active
     *
     * @return Category
     */
    public function setActive(int $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * Set position
     *
     * @param int $position
     *
     * @return Category
     */
    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get cdate
     *
     * @return \DateTime
     */
    public function getCdate(): ?\DateTime
    {
        return $this->cdate;
    }

    /**
     * Set cdate
     *
     * @param \DateTime $cdate
     *
     * @return Category
     */
    public function setCdate(\DateTime $cdate): self
    {
        $this->cdate = $cdate;

        return $this;
    }

    /**
     * Get mdate
     *
     * @return \DateTime
     */
    public function getMdate(): ?\DateTime
    {
        return $this->mdate;
    }

    /**
     * Set mdate
     *
     * @param \DateTime $mdate
     *
     * @return Category
     */
    public function setMdate(\DateTime $mdate): self
    {
        $this->mdate = $mdate;

        return $this;
    }
}
