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
     * @ORM\ManyToOne(targetEntity="Partner", inversedBy="subscriptions")
     * @ORM\JoinColumn(name="id_partner", referencedColumnName="id_partner", nullable=false)
     */
    private $partner;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInDate(): ?\DateTimeInterface
    {
        return $this->inDate;
    }

    public function setInDate(\DateTimeInterface $inDate): self
    {
        $this->inDate = $inDate;

        return $this;
    }

    public function getOutDate(): ?\DateTimeInterface
    {
        return $this->outDate;
    }

    public function setOutDate(\DateTimeInterface $outDate): self
    {
        $this->outDate = $outDate;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    public function setPartner(?Partner $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    function __toString() {
        if(!$this->getId())
            return '';

        return $this->getInDate()->format('d-m-Y').' - '.$this->getOutDate()->format('d-m-Y').'  >  '.$this->getInfo();
    }

    
}