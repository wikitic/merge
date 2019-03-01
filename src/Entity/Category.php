<?php

namespace App\Entity;

use App\Entity\CommonTrait;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @UniqueEntity(fields={"alias"}, message="category.alias.unique")
 * @ORM\HasLifecycleCallbacks()
 */
class Category
{
    use CommonTrait;

    /**
     * @var int
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
     * @ORM\Column(name="alias", type="string", length=100, unique=true)
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
     * @Assert\NotBlank(message="category.metatitle.not_blank")
     */
    private $metatitle;

    /**
     * @var string
     *
     * @ORM\Column(name="metadesc", type="string", length=255)
     * @Assert\NotBlank(message="category.metadesc.not_blank")
     */
    private $metadesc;

    /**
     * @var string
     *
     * @ORM\Column(name="metakey", type="string", length=255)
     * @Assert\NotBlank(message="category.metakey.not_blank")
     */
    private $metakey;

    /**
     * @var string
     *
     * @ORM\Column(name="metaimage", type="string", length=255)
     * @Assert\NotBlank(message="category.metaimage.not_blank")
     */
    private $metaimage;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="integer")
     * @Assert\NotBlank(message="category.active.not_blank")
     */
    private $active;

    /**
     * @var int
     *
     * @ORM\Column(name="ordering", type="integer")
     */
    private $ordering;


    
    public function __construct()
    {
        //$this->active   = 0;
        //$this->ordering = 0;
        $this->cdate    = new \DateTime();
        $this->mdate    = new \DateTime();
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
     * Get alias
     *
     * @return string
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * Set alias
     *
     * @param string $alias
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
     * Get ordering
     *
     * @return int
     */
    public function getOrdering(): ?int
    {
        return $this->ordering;
    }

    /**
     * Set ordering
     *
     * @param int $ordering
     *
     * @return Category
     */
    public function setOrdering(int $ordering): self
    {
        $this->ordering = $ordering;

        return $this;
    }
}
