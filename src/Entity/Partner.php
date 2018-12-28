<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use function Safe\password_hash;

/**
 * Partner
 *
 * @ORM\Table(name="partners")
 * @ORM\Entity(repositoryClass="App\Repository\PartnerRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"code"}, message="El código ya existe")
 * @UniqueEntity(fields={"email"}, message="El email ya existe")
 */
class Partner
{
    const ROLE_USER  = 0;
    const ROLE_PREMIUM  = 1;

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
     * @ORM\Column(name="code", type="string", length=6, unique=true)
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
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var integer
     *
     * @ORM\Column(name="role", type="integer")
     */
    private $role;

    /**
     * @var integer
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

    /**
     * @var Subscription[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Subscription", mappedBy="partner", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"inDate" = "DESC"})
     */
    private $subscriptions;

    

    public function __construct()
    {
        $this->code     = '';
        $this->role     = self::ROLE_PREMIUM;
        $this->active   = 1;
        $this->salt     = md5(uniqid());
        $this->cdate    = new \DateTime();
        $this->mdate    = new \DateTime();
        $this->subscriptions = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
        /*
        if (!$this->code) {
            $em = $args->getEntityManager();
            $er = $em->getRepository(get_class($this));
            $this->code = $er->getUniqueCode();
        }

        $this->setPassword($this->code);
        */
        $this->cdate    = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate(): void
    {
        $this->salt     = md5(uniqid());
        $this->mdate    = new \DateTime();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        return $this;
    }

    public function getSalt(): ?string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
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

    public function getCdate(): ?\DateTime
    {
        return $this->cdate;
    }

    public function setCdate(\DateTime $cdate): self
    {
        $this->cdate = $cdate;

        return $this;
    }

    public function getMdate(): ?\DateTime
    {
        return $this->mdate;
    }

    public function setMdate(\DateTime $mdate): self
    {
        $this->mdate = $mdate;

        return $this;
    }

    /**
     * @return Collection|Subscription[]
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    public function addSubscription(Subscription $subscription): self
    {
        if (!$this->subscriptions->contains($subscription)) {
            $this->subscriptions[] = $subscription;
            $subscription->setPartner($this);
        }

        return $this;
    }

    public function removeSubscription(Subscription $subscription): self
    {
        if ($this->subscriptions->contains($subscription)) {
            $this->subscriptions->removeElement($subscription);
            // set the owning side to null (unless already changed)
            if ($subscription->getPartner() === $this) {
                $subscription->setPartner(null);
            }
        }

        return $this;
    }



    public function getNumSubscriptions(): ?int
    {
        return count($this->subscriptions);
    }
}
