<?php

namespace App\Entity;

use App\Entity\Partner;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $inDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="out_date", type="datetime")
     */
    private $outDate;
    
    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=255)
     */
    private $info;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="decimal", scale=2)
     */
    private $price;


    /**
     * Get idSubscription
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get Indate
     *
     * @return \DateTime
     */
    public function getInDate(): ?\DateTime
    {
        return $this->inDate;
    }

    /**
     * Set Indate
     *
     * @param \DateTime $inDate
     *
     * @return Subscription
     */
    public function setInDate(\DateTime $inDate): self
    {
        $this->inDate = $inDate;

        return $this;
    }

    /**
     * Get Outdate
     *
     * @return \DateTime
     */
    public function getOutDate(): ?\DateTime
    {
        return $this->outDate;
    }

    /**
     * Set Outdate
     *
     * @param \DateTime $outDate
     *
     * @return Subscription
     */
    public function setOutDate(\DateTime $outDate): self
    {
        $this->outDate = $outDate;

        return $this;
    }

    /**
     * Get Info
     *
     * @return string
     */
    public function getInfo(): ?string
    {
        return $this->info;
    }

    /**
     * Set Info
     *
     * @param string $info
     *
     * @return Subscription
     */
    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get Price
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set Price
     *
     * @param float $price
     *
     * @return Subscription
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get Partner
     *
     * @return Partner
     */
    public function getPartner(): Partner
    {
        //return null;
        return $this->partner;
    }

    /**
     * Set Parter
     *
     * @param Partner $partner
     *
     * @return Subscription
     */
    public function setPartner(Partner $partner): self
    {
        $this->partner = $partner;

        return $this;
    }
}
