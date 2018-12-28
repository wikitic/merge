<?php

namespace App\Service;

use App\Entity\Partner;

use Doctrine\ORM\EntityManagerInterface;

final class PartnerService
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * PartnerService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return object[]
     */
    public function getAll(): array
    {
        return $this->em->getRepository(Partner::class)->findBy([]);
    }
}