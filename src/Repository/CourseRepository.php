<?php

namespace App\Repository;

use App\Entity\Course;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Course|null find($id, $lockMode = null, $lockVersion = null)
 * @method Course|null findOneBy(array $criteria, array $orderBy = null)
 * @method Course[]    findAll()
 * @method Course[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Course::class);
    }

    /**
      * @return Course[] Returns an array of Course objects
      */
    public function findBySearch($search = null)
    {
        $query = $this->createQueryBuilder('c');

        $search = explode(' ', trim($search));
        foreach ($search as $v) {
            $query->orWhere('c.title like :search')->setParameter('search', '%' . trim($v) . '%');
            $query->orWhere('c.introtext like :search')->setParameter('search', '%' . trim($v) . '%');
            $query->orWhere('c.metakey like :search')->setParameter('search', '%' . trim($v) . '%');
        }
        $query->andWhere('c.active = 1');
        $query->orderBy('c.mdate', 'DESC');

        return $query->getQuery()->getResult();
    }

}
