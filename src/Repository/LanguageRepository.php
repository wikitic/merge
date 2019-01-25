<?php

namespace App\Repository;

use App\Entity\Language;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Language|null find($id, $lockMode = null, $lockVersion = null)
 * @method Language|null findOneBy(array $criteria, array $orderBy = null)
 * @method Language[]    findAll()
 * @method Language[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LanguageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Language::class);
    }

    /**
     * @return Language
     */
    public function findOneByLastOrdering(): ?Language
    {
        $qb = $this->createQueryBuilder('l')
            ->orderBy('l.ordering', 'DESC')
            ->setMaxResults(1)
            ->getQuery();

        return $qb->setMaxResults(1)->getOneOrNullResult();
    }
    
    /**
     * @return int
     */
    public function getNextOrdering(): int
    {
        $language = $this->findOneByLastOrdering();
        
        return $language !== null ? $language->getOrdering() + 1 : 1;
    }
}
