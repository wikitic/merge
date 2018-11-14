<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Teacher
 *
 * @ORM\Table(name="teachers")
 * @ORM\Entity(repositoryClass="App\Repository\TeacherRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Teacher implements UserInterface
{
    const ROLE_SUPER_ADMIN  = 999;
    const ROLE_TEACHER      = 1;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="id_admin", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, unique=true)
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
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var array
     *
     * @ORM\Column(name="social", type="json_array", nullable=true)
     */
    private $social = array();

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
        $this->salt     = md5(uniqid());
        $this->role     = self::ROLE_TEACHER;
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
        $this->salt     = md5(uniqid());
        $this->mdate    = new \DateTime();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setUsername($username)
    {
        $this->email = $username;

        return $this;
    }

    public function getUsername()
    {
        return $this->email;
    }

    function eraseCredentials()
    {
    }

    public function setPassword($password)
    {
        //$this->password = $password;
        $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getSocial()
    {
        return $this->social;
    }

    public function setSocial($social): self
    {
        $this->social = $social;

        return $this;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
        
        return $this;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    function getRoles()
    {
        switch ($this->role){
            case self::ROLE_SUPER_ADMIN: return array('ROLE_SUPER_ADMIN');
            case self::ROLE_TEACHER: return array('ROLE_TEACHER');
        }
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;

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