<?php

namespace App\Repository;

use App\Entity\Language;
use App\Entity\Module;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Module|null find($id, $lockMode = null, $lockVersion = null)
 * @method Module|null findOneBy(array $criteria, array $orderBy = null)
 * @method Module[]    findAll()
 * @method Module[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModuleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Module::class);
    }

    /**
     * @param Language $language
     *
     * @return Module
     */
    public function findOneByLastOrdering(Language $language): ?Module
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.language = :language')
            ->setParameter('language', $language)
            ->orderBy('m.ordering', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        //return $qb->setMaxResults(1)->getOneOrNullResult();
    }
    
    /**
     * @param Language $language
     *
     * @return int
     */
    public function getNextOrdering(Language $language): int
    {
        $module = $this->findOneByLastOrdering($language);
        
        return $module !== null ? $module->getOrdering() + 1 : 1;
    }

    // /**
    //  * @return Module[] Returns an array of Module objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Module
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
