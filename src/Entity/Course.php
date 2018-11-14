<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Course
 *
 * @ORM\Table(name="courses")
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Course
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_course", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Category
     *
     * @Gedmo\SortableGroup
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_category", referencedColumnName="id_category", nullable=false)
     * })
     */
    private $category;

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
     * @ORM\Column(name="introtext", type="string", length=255)
     */
    private $introtext;

    /**
     * @var string
     *
     * @ORM\Column(name="image_intro", type="string", length=255)
     */
    private $image_intro;

    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=255)
     */
    private $level;

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
     * @ORM\Column(name="mdate", type="datetime")
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

    public function getIntrotext(): ?string
    {
        return $this->introtext;
    }

    public function setIntrotext(string $introtext): self
    {
        $this->introtext = $introtext;

        return $this;
    }

    public function getImageIntro(): ?string
    {
        return $this->image_intro;
    }

    public function setImageIntro(string $image_intro): self
    {
        $this->image_intro = $image_intro;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

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

    public function setMdate(?\DateTimeInterface $mdate): self
    {
        $this->mdate = $mdate;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
    
}