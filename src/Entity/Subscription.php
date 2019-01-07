<?php

namespace App\Entity;

use App\Entity\Partner;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Subscription
 *
 * @ORM\Table(name="subscriptions")
 * @ORM\Entity(repositoryClass="App\Repository\SubscriptionRepository")
 */
class Subscription
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_subscription", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Partner
     *
     * @ORM\ManyToOne(targetEntity="Partner", inversedBy="subscriptions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_partner", referencedColumnName="id_partner", nullable=false)
     * })
     */
    private $partner;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="in_date", type="datetime")
     * @Assert\NotNull(message="La fecha es requerida")
     * @Assert\DateTime(message="La fecha es inválida")
     */
    private $inDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="out_date", type="datetime")
     * @Assert\NotNull(message="La fecha es requerida")
     * @Assert\DateTime(message="La fecha es inválida")
     */
    private $outDate;
    
    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=255)
     * @Assert\NotBlank(message="La info es requerida")
     */
    private $info;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="decimal", scale=2)
     * @Assert\NotBlank(message="El precio es requerido")
     */
    private $price;



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
     * Get partner
     *
     * @return Partner
     */
    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    /**
     * Set parter
     *
     * @param Partner $partner
     *
     * @return Subscription
     */
    public function setPartner(?Partner $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * Get indate
     *
     * @return \DateTime
     */
    public function getInDate(): ?\DateTime
    {
        return $this->inDate;
    }

    /**
     * Set indate
     *
     * @param \DateTime $inDate
     *
     * @return Subscription
     */
    public function setInDate(?\DateTime $inDate): self
    {
        $this->inDate = $inDate;

        return $this;
    }

    /**
     * Get outdate
     *
     * @return \DateTime
     */
    public function getOutDate(): ?\DateTime
    {
        return $this->outDate;
    }

    /**
     * Set outdate
     *
     * @param \DateTime $outDate
     *
     * @return Subscription
     */
    public function setOutDate(?\DateTime $outDate): self
    {
        $this->outDate = $outDate;

        return $this;
    }

    /**
     * Get info
     *
     * @return string
     */
    public function getInfo(): ?string
    {
        return $this->info;
    }

    /**
     * Set info
     *
     * @param string $info
     *
     * @return Subscription
     */
    public function setInfo(?string $info): self
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Subscription
     */
    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
