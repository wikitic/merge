<?php

namespace App\Repository;

use App\Entity\Subscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Subscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subscription[]    findAll()
 * @method Subscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Subscription::class);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function requestValidate(array $data = null, string $method = 'POST'): bool
    {
        if ($method === 'POST') {
            if (!isset($data['info']) || !isset($data['price'])
                || !isset($data['inDate']) || !isset($data['outDate'])) {
                return false;
            }
        }

        foreach ((array)$data as $key => $value) {
            switch ($key) {
                case 'info':
                    if (empty($value)) {
                        return false;
                    }
                    break;
                case 'price':
                    if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
                        return false;
                    }
                    break;
                case 'inDate':
                case 'outDate':
                    if (empty($value)) {
                        return false;
                    }
                    break;
            }
        }
        
        return true;
    }
}
