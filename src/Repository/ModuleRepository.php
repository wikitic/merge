<?php

namespace App\Repository;

use App\Entity\Module;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

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
     * @return string
     */
    public function serialize(?Module $module): string
    {
        if ($module === null) {
            return '';
        }
        
        // Evitar "A circular reference has been detected when serializing the object of class"
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(['module', 'modules', 'teacher']);
        $serializer = new Serializer([new DateTimeNormalizer(), $normalizer], [new JsonEncoder()]);
        // Evitar ...

        $module = $serializer->normalize(
            $module,
            null
        );
        
        return $serializer->serialize($module, 'json');
    }
}
