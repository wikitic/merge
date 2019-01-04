<?php

namespace App\Repository;

use App\Entity\Partner;
use App\Entity\Subscription;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use function Safe\substr;

/**
 * @method Partner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partner[]    findAll()
 * @method Partner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Partner::class);
    }

    /**
     * @return string
     */
    public function getUniqueCode(): string
    {
        do {
            $code = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 6)), 0, 6);
            $exist = $this->findOneBy(['code'=>$code]);
        } while ($exist!==null);

        return $code;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function isPostValid(array $data = null): bool
    {
        if (!isset($data['name']) || !isset($data['surname']) || !isset($data['email'])) {
            return false;
        }

        foreach ($data as $key => $value) {
            switch ($key) {
                case 'name':
                case 'surname':
                    if (empty($value)) {
                        return false;
                    }
                    break;
                case 'email':
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL) || $this->findOneBy(['email'=>$data['email']])) {
                        return false;
                    }
                    break;
            }
        }

        return true;
    }
}
