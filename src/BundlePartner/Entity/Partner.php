<?php

namespace App\BundlePartner\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Partner
 *
 * @ORM\Table(name="partners")
 * @ORM\Entity(repositoryClass="App\BundlePartner\Repository\PartnerRepository")
 */
class Partner implements AdvancedUserInterface
{
    const ROLE_USER=0;
    const ROLE_PREMIUM=1;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_partner", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=6)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
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
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var int
     *
     * @ORM\Column(name="role", type="integer")
     */
    private $role=1;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="integer")
     */
    private $active=1;

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





    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Partner
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Partner
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return Partner
     */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Partner
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Partner
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

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
     * Set salt
     *
     * @param string $salt
     *
     * @return Partner
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
     * Get Roles
     *
     * @return array
     */
    public function getRoles(): array
    {
        switch ($this->role) {
            case self::ROLE_USER:
                return array('ROLE_USER');
            case self::ROLE_PREMIUM:
                return array('ROLE_PREMIUM');
        }
    }

    /**
     * Set role
     *
     * @param integer $role
     *
     * @return Partner
     */
    public function setRole(int $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return integer
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return Partner
     */
    public function setActive(int $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * Set cdate
     *
     * @param \DateTime $cdate
     *
     * @return Partner
     */
    public function setCdate(?\DateTime $cdate): self
    {
        $this->cdate = $cdate;

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
     * Set mdate
     *
     * @param \DateTime $mdate
     *
     * @return Partner
     */
    public function setMdate(?\DateTime $mdate): self
    {
        $this->mdate = $mdate;

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



    /************************************/
    /*     implements UserInterface     */
    /************************************/

    /**
     * eraseCredentials
     */
    public function eraseCredentials()
    {
    }

    /**
     * Get Username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getEmail();
    }



    /************************************/
    /* implements AdvancedUserInterface */
    /************************************/
    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->active;
    }




    /**
     * Get FullName
     *
     * @return string
     */
    public function getFullName(): string
    {
        return $this->name.' '.$this->surname;
    }
}
