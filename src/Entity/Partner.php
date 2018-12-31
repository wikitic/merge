<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var int
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
        */
        
        $this->setPassword($this->code);
        
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
     * Get code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
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
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
     * Get surname
     *
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
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
     * Get email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
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
     * @return Partner
     */
    public function setPassword(string $password): self
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

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
     * @return Partner
     */
    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

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
     * Set role
     *
     * @param int $role
     *
     * @return Partner
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
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * Set active
     *
     * @param int $active
     *
     * @return Partner
     */
    public function setActive(int $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get cdate
     *
     * @return string
     */
    public function getCdate(): string
    {
        return $this->cdate->format(\DateTime::ISO8601);
    }

    /**
     * Set cdate
     *
     * @param \DateTime $cdate
     *
     * @return Partner
     */
    public function setCdate(\DateTime $cdate): self
    {
        $this->cdate = $cdate;

        return $this;
    }

    /**
     * Get mdate
     *
     * @return string
     */
    public function getMdate(): string
    {
        return $this->mdate->format(\DateTime::ISO8601);
    }

    /**
     * Set mdate
     *
     * @param \DateTime $mdate
     *
     * @return Partner
     */
    public function setMdate(\DateTime $mdate): self
    {
        $this->mdate = $mdate;

        return $this;
    }

    /**
     * Get subscriptions
     *
     * @return Collection|Subscription[]
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    /**
     * Add subscription
     *
     * @param Subscription $subscription
     *
     * @return Partner
     */
    public function addSubscription(Subscription $subscription): self
    {
        if (!$this->subscriptions->contains($subscription)) {
            $this->subscriptions[] = $subscription;
            $subscription->setPartner($this);
        }

        return $this;
    }

    /**
     * Remove subscription
     *
     * @param Subscription $subscription
     *
     * @return Partner
     */
    public function removeSubscription(Subscription $subscription): self
    {
        if ($this->subscriptions->contains($subscription)) {
            $this->subscriptions->removeElement($subscription);
            // set the owning side to null (unless already changed)
            if ($subscription->getPartner() === $this) {
                //$subscription->setPartner(null);
            }
        }

        return $this;
    }


    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname(): string
    {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * Get numsubscriptions
     *
     * @return int
     */
    public function getNumSubscriptions(): int
    {
        return count($this->subscriptions);
    }
}
