<?php

namespace App\Repository;

use App\Entity\Language;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

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
     * @return string
     */
    public function serialize(?Language $language): string
    {
        if ($language === null) {
            return '';
        }
        
        // Evitar "A circular reference has been detected when serializing the object of class"
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(['language', 'lessons']);
        $serializer = new Serializer([new DateTimeNormalizer(), $normalizer], [new JsonEncoder()]);
        // Evitar ...

        $language = $serializer->normalize(
            $language,
            null
        );
        
        return $serializer->serialize($language, 'json');
    }
}
