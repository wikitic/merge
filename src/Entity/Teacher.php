<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * Teacher
 *
 * @ORM\Table(name="teachers")
 * @ORM\Entity(repositoryClass="App\Repository\TeacherRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Teacher
{

    /**
     * @var int
     *
     * @ORM\Column(name="id_teacher", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message="teacher.name.not_blank")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     * @Assert\NotBlank(message="teacher.image.not_blank")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank(message="teacher.description.not_blank")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="social", type="string", nullable=true)
     */
    private $social;
    
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
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Teacher
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Teacher
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

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
     * @return Teacher
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get social
     *
     * @return string
     */
    public function getSocial(): ?string
    {
        return $this->social;
    }

    /**
     * Set social
     *
     * @param string $social
     *
     * @return Teacher
     */
    public function setSocial(string $social): self
    {
        $this->social = $social;

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
     * @return Teacher
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
     * @return Teacher
     */
    public function setMdate(\DateTime $mdate): self
    {
        $this->mdate = $mdate;

        return $this;
    }
}
