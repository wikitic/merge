<?php

namespace App\Entity;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Course
 *
 * @ORM\Table(name="courses")
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 * @UniqueEntity(fields={"alias"}, message="alias.unique")
 * @ORM\HasLifecycleCallbacks()
 */
class Course
{

    /**
     * @var int
     *
     * @ORM\Column(name="id_course", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Category
     *
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
     * @Assert\NotBlank(message="title.not_blank")
     * @Groups({"api_list", "api_view"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=100, unique=true)
     * @Assert\NotBlank(message="alias.not_blank")
     * @Groups({"api_list", "api_view"})
     */
    private $alias;
    
    /**
     * @var string
     *
     * @ORM\Column(name="introtext", type="string", length=255)
     * @Assert\NotBlank(message="introtext.not_blank")
     * @Groups({"api_list", "api_view"})
     */
    private $introtext;

    /**
     * @var string
     *
     * @ORM\Column(name="image_intro", type="string", length=255)
     * @Assert\NotBlank(message="image_intro.not_blank")
     * @Groups({"api_list", "api_view"})
     */
    private $image_intro;

    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=255)
     * @Assert\NotBlank(message="level.not_blank")
     * @Groups({"api_list", "api_view"})
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="metatitle", type="string", length=255)
     * @Assert\NotBlank(message="metatitle.not_blank")
     * @Groups({"api_view"})
     */
    private $metatitle;

    /**
     * @var string
     *
     * @ORM\Column(name="metadesc", type="string", length=255)
     * @Assert\NotBlank(message="metadesc.not_blank")
     * @Groups({"api_view"})
     */
    private $metadesc;

    /**
     * @var string
     *
     * @ORM\Column(name="metakey", type="string", length=255)
     * @Assert\NotBlank(message="metakey.not_blank")
     * @Groups({"api_view"})
     */
    private $metakey;

    /**
     * @var string
     *
     * @ORM\Column(name="metaimage", type="string", length=255)
     * @Assert\NotBlank(message="metaimage.not_blank")
     * @Groups({"api_view"})
     */
    private $metaimage;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="integer")
     * @Assert\Type(type="integer", message="active.integer")
     */
    private $active;

    /**
     * @var int
     *
     * @ORM\Column(name="ordering", type="integer")
     * @Assert\Type(type="integer", message="ordering.integer")
     */
    private $ordering;

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
        $this->active   = 0;
        $this->cdate    = new \DateTime();
        $this->mdate    = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->cdate    = new \DateTime();
        $this->mdate    = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
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
     * @return Course
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
     * @return Course
     */
    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get introtext
     *
     * @return string
     */
    public function getIntrotext(): ?string
    {
        return $this->introtext;
    }

    /**
     * Set introtext
     *
     * @param string $introtext
     *
     * @return Course
     */
    public function setIntrotext(string $introtext): self
    {
        $this->introtext = $introtext;

        return $this;
    }

    /**
     * Get imageintro
     *
     * @return string
     */
    public function getImageIntro(): ?string
    {
        return $this->image_intro;
    }

    /**
     * Set imageintro
     *
     * @param string $image_intro
     *
     * @return Course
     */
    public function setImageIntro(string $image_intro): self
    {
        $this->image_intro = $image_intro;

        return $this;
    }

    /**
     * Get level
     *
     * @return string
     */
    public function getLevel(): ?string
    {
        return $this->level;
    }

    /**
     * Set level
     *
     * @param string $level
     *
     * @return Course
     */
    public function setLevel(string $level): self
    {
        $this->level = $level;

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
     * @return Course
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
     * @return Course
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
     * @return Course
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
     * @return Course
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
     * @return Course
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
     * @return Course
     */
    public function setOrdering(int $ordering): self
    {
        $this->ordering = $ordering;

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
     * @return Course
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
     * @return Course
     */
    public function setMdate(\DateTime $mdate): self
    {
        $this->mdate = $mdate;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * Set category
     *
     * @param Category $category
     *
     * @return Course
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
