<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use function Safe\password_hash;

/**
 * Teacher
 *
 * @ORM\Table(name="teachers")
 * @ORM\Entity(repositoryClass="App\Repository\TeacherRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"email"}, message="teacher.email.unique")
 */
class Teacher implements UserInterface
{
    const ROLE_TEACHER  = 0;
    const ROLE_ADMIN    = 999;

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
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     * @Assert\NotBlank(message="teacher.email.not_blank")
     * @Assert\Email(message="teacher.email.email")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message="teacher.name.not_blank")
     *
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="social", type="text", nullable=true)
     */
    private $social;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var int
     *
     * @ORM\Column(name="role", type="integer")
     */
    private $role;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="integer")
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cdate", type="datetime", nullable=true)
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
        $this->password = '';
        $this->salt     = md5(uniqid());
        $this->role     = self::ROLE_TEACHER;
        $this->active   = 0;
        $this->cdate    = new \DateTime();
        $this->mdate    = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
        if (!$this->password) {
            $this->setPassword($this->email);
        }
        
        $this->cdate    = new \DateTime();
        $this->mdate    = new \DateTime();
    }
    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate(): void
    {
        $this->salt     = md5(uniqid());
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
     * Get username
     *
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->email;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Teacher
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Teacher
     */
    public function setPassword(string $password): self
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        return $this;
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
    public function setImage(?string $image): self
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
    public function setDescription(?string $description): self
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
    public function setSocial(?string $social): self
    {
        $this->social = $social;

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
     * Set salt
     *
     * @param string $salt
     *
     * @return Teacher
     */
    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get Roles
     *
     * @return array
     */
    public function getRoles()
    {
        switch ($this->role) {
            case self::ROLE_TEACHER:
                return ['ROLE_TEACHER'];
            case self::ROLE_ADMIN:
                return ['ROLE_ADMIN'];
        }
    }

    /**
     * Get role
     *
     * @return int
     */
    public function getRole(): ?int
    {
        return $this->role;
    }

    /**
     * Set role
     *
     * @param int $role
     *
     * @return Teacher
     */
    public function setRole(int $role): self
    {
        $this->role = $role;

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
     * @return Teacher
     */
    public function setActive(int $active): self
    {
        $this->active = $active;

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

    /**
     * @return void
     */
    public function eraseCredentials(): void
    {
    }
}
