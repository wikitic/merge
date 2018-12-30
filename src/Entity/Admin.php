<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use function Safe\password_hash;

/**
 * Admin
 *
 * @ORM\Table(name="admins")
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 */
class Admin implements UserInterface
{
    const ROLE_SUPER_ADMIN = 999;

    /**
     * @var int
     *
     * @ORM\Column(name="id_admin", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

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
    private $role = 999;



    /**
     * Get idAdmin
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Admin
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Admin
     */
    public function setPassword(string $password): self
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

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
     * @return Admin
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
     * @return void
     */
    public function eraseCredentials(): void
    {
    }

    /**
     * Set role
     *
     * @param int $role
     *
     * @return Admin
     */
    public function setRole(int $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * Get Roles
     *
     * @return array
     */
    public function getRoles()
    {
        switch ($this->role) {
            case self::ROLE_SUPER_ADMIN:
                return array('ROLE_SUPER_ADMIN');
        }
    }
}
