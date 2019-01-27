<?php

namespace App\Entity;

use App\Entity\Module;
use App\Entity\Teacher;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * Lesson
 *
 * @ORM\Table(name="lessons")
 * @ORM\Entity(repositoryClass="App\Repository\LessonRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Lesson
{

    /**
     * @var int
     *
     * @ORM\Column(name="id_lesson", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Module
     *
     * @ORM\ManyToOne(targetEntity="Module")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_module", referencedColumnName="id_module", nullable=false)
     * })
     * @Assert\NotNull(message="lesson.module.not_null")
     */
    private $module;

    /**
     * @var Teacher
     *
     * @ORM\ManyToOne(targetEntity="Teacher")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_teacher", referencedColumnName="id_teacher", nullable=true)
     * })
     */
    private $teacher;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(message="lesson.title.not_blank")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     * @Assert\NotBlank(message="lesson.alias.not_blank")
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank(message="lesson.description.not_blank")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="score", type="integer")
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="_in", type="text", nullable=true)
     */
    private $in;
    
    /**
     * @var string
     *
     * @ORM\Column(name="_out", type="text", nullable=true)
     */
    private $out;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="toolbox", type="text", nullable=true)
     */
    private $toolbox;

    /**
     * @var string
     *
     * @ORM\Column(name="startCode", type="text", nullable=true)
     */
    private $startCode;

    /**
     * @var int
     *
     * @ORM\Column(name="maxCode", type="integer", nullable=true)
     */
    private $maxCode;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="integer")
     */
    private $active;

    /**
     * @var int
     *
     * @ORM\Column(name="access", type="integer")
     */
    private $access;

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
        $this->score    = 0;
        $this->type     = 0;
        $this->salt     = md5(uniqid());
        $this->active   = 0;
        $this->access   = 0;
        $this->ordering = 0;
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
     * Set title
     *
     * @param string $title
     *
     * @return Lesson
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Lesson
     */
    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Lesson
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set video
     *
     * @param string $video
     *
     * @return Lesson
     */
    public function setVideo(string $video): self
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string
     */
    public function getVideo(): ?string
    {
        return $this->video;
    }

    /**
     * Set type
     *
     * @param int $type
     *
     * @return Lesson
     */
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * Set score
     *
     * @param int $score
     *
     * @return Lesson
     */
    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * Set in
     *
     * @param string $in
     *
     * @return Lesson
     */
    public function setIn(string $in): self
    {
        $this->in = $in;

        return $this;
    }

    /**
     * Get in
     *
     * @return string
     */
    public function getIn(): ?string
    {
        return $this->in;
    }

    /**
     * Set out
     *
     * @param string $out
     *
     * @return Lesson
     */
    public function setOut(string $out): self
    {
        $this->out = $out;

        return $this;
    }

    /**
     * Get out
     *
     * @return string
     */
    public function getOut(): ?string
    {
        return $this->out;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return Lesson
     */
    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }

    /**
     * Set toolbox
     *
     * @param string $toolbox
     *
     * @return Lesson
     */
    public function setToolbox(string $toolbox): self
    {
        $this->toolbox = $toolbox;

        return $this;
    }

    /**
     * Get toolbox
     *
     * @return string
     */
    public function getToolbox(): ?string
    {
        return $this->toolbox;
    }

    /**
     * Set startCode
     *
     * @param string $startCode
     *
     * @return Lesson
     */
    public function setStartCode(string $startCode): self
    {
        $this->startCode = $startCode;

        return $this;
    }

    /**
     * Get startCode
     *
     * @return string
     */
    public function getStartCode(): ?string
    {
        return $this->startCode;
    }

    /**
     * Set maxCode
     *
     * @param int $maxCode
     *
     * @return Lesson
     */
    public function setMaxCode(int $maxCode): self
    {
        $this->maxCode = $maxCode;

        return $this;
    }

    /**
     * Get maxCode
     *
     * @return int
     */
    public function getMaxCode(): int
    {
        return $this->maxCode;
    }

    /**
     * Set active
     *
     * @param int $active
     *
     * @return Lesson
     */
    public function setActive(int $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * Set access
     *
     * @param int $access
     *
     * @return Lesson
     */
    public function setAccess(int $access): self
    {
        $this->access = $access;

        return $this;
    }

    /**
     * Get access
     *
     * @return int
     */
    public function getAccess(): int
    {
        return $this->access;
    }

    /**
     * Set ordering
     *
     * @param int $ordering
     *
     * @return Lesson
     */
    public function setOrdering(int $ordering): self
    {
        $this->ordering = $ordering;

        return $this;
    }

    /**
     * Get ordering
     *
     * @return int
     */
    public function getOrdering(): int
    {
        return $this->ordering;
    }

    /**
     * Set cdate
     *
     * @param \DateTime $cdate
     *
     * @return Lesson
     */
    public function setCdate(\DateTime $cdate): self
    {
        $this->cdate = $cdate;

        return $this;
    }

    /**
     * Get cdate
     *
     * @return \DateTime
     */
    public function getCdate(): \DateTime
    {
        return $this->cdate;
    }

    /**
     * Set mdate
     *
     * @param \DateTime $mdate
     *
     * @return Lesson
     */
    public function setMdate(\DateTime $mdate): self
    {
        $this->mdate = $mdate;

        return $this;
    }

    /**
     * Get mdate
     *
     * @return \DateTime
     */
    public function getMdate(): \DateTime
    {
        return $this->mdate;
    }

    /**
     * Set module
     *
     * @param Module $module
     *
     * @return Lesson
     */
    public function setModule(Module $module): self
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return Module
     */
    public function getModule(): Module
    {
        return $this->module;
    }

    /**
     * Set teacher
     *
     * @param Teacher $teacher
     *
     * @return Lesson
     */
    public function setTeacher(?Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return Teacher
     */
    public function getTeacher(): Teacher
    {
        return $this->teacher;
    }
}
