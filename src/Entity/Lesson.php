<?php

namespace App\Entity;

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
    const ACCESS_USER       = 1;
    const ACCESS_PREMIUM    = 2;

    /**
     * @var int
     *
     * @ORM\Column(name="id_lesson", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Course
     *
     * @ORM\ManyToOne(targetEntity="Course")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_course", referencedColumnName="id_course", nullable=false)
     * })
     */
    private $course;

    /**
     * @var Teacher
     *
     * @ORM\ManyToOne(targetEntity="Teacher")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_teacher", referencedColumnName="id_teacher", nullable=false)
     * })
     */
    private $teacher;

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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @var string
     *
     * @ORM\Column(name="files", type="string", nullable=true)
     */
    private $files;
    
    /**
     * @var int
     *
     * @ORM\Column(name="score", type="integer")
     */
    private $score;

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
        $this->active   = 0;
        $this->access   = self::ACCESS_USER;
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
     * @return Lesson
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
     * @return Lesson
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
     * @return Lesson
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

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
     * Get files
     *
     * @return string
     */
    public function getFiles(): ?string
    {
        return $this->files;
    }

    /**
     * Set files
     *
     * @param string $files
     *
     * @return Lesson
     */
    public function setFiles(string $files): self
    {
        $this->files = $files;

        return $this;
    }

    /**
     * Get score
     *
     * @return int
     */
    public function getScore(): ?int
    {
        return $this->score;
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
     * @return Lesson
     */
    public function setActive(int $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get access
     *
     * @return int
     */
    public function getAccess(): ?int
    {
        return $this->access;
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
     * @return Lesson
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
     * @return Lesson
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
     * @return Lesson
     */
    public function setMdate(\DateTime $mdate): self
    {
        $this->mdate = $mdate;

        return $this;
    }

    /**
     * Get course
     *
     * @return Course
     */
    public function getCourse(): ?Course
    {
        return $this->course;
    }

    /**
     * Set course
     *
     * @param Course $course
     *
     * @return Lesson
     */
    public function setCourse(Course $course): self
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return Teacher
     */
    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    /**
     * Set teacher
     *
     * @param Teacher $teacher
     *
     * @return Lesson
     */
    public function setTeacher(Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }
}
