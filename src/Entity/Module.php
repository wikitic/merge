<?php

namespace App\Entity;

use App\Entity\Language;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * Module
 *
 * @ORM\Table(name="modules")
 * @ORM\Entity(repositoryClass="App\Repository\ModuleRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Module
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_module", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="subscriptions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_language", referencedColumnName="id_language", nullable=false)
     * })
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(message="module.title.not_blank")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     * @Assert\NotBlank(message="module.alias.not_blank")
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="introtext", type="string", length=255)
     * @Assert\NotBlank(message="module.introtext.not_blank")
     */
    private $introtext;

    /**
     * @var string
     *
     * @ORM\Column(name="image_intro", type="string", length=255)
     * @Assert\NotBlank(message="module.image_intro.not_blank")
     */
    private $image_intro;

    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=255)
     * @Assert\NotBlank(message="module.level.not_blank")
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="metatitle", type="string", length=255, nullable=true)
     */
    private $metatitle;

    /**
     * @var string
     *
     * @ORM\Column(name="metadesc", type="string", length=255, nullable=true)
     */
    private $metadesc;

    /**
     * @var string
     *
     * @ORM\Column(name="metakey", type="string", length=255, nullable=true)
     */
    private $metakey;

    /**
     * @var string
     *
     * @ORM\Column(name="metaimage", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="ordering", type="integer")
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
        $this->ordering = 0;
        $this->active   = 0;
        $this->cdate    = new \DateTime();
        $this->mdate    = new \DateTime();
    }

    /**
     * @ORM\PrePersist
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
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * @return Module
     */
    public function setMdate(\DateTime $mdate): self
    {
        $this->mdate = $mdate;

        return $this;
    }


    /**
     * Get language
     *
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }

    /**
     * Set language
     *
     * @param Language $language
     *
     * @return Module
     */
    public function setLanguage(Language $language): self
    {
        $this->language = $language;

        return $this;
    }



    /**
     * get Image
     *
     * @return string
     */
    public function getImage(): ?string
    {
        $alias_language = $this->language->getAlias();
        $alias_module = $this->getAlias();
        $image_intro = $this->getImageIntro();

        return '/images/'.$alias_language.'/'.$alias_module.'/'.$image_intro;
    }
}
