<?php

namespace App\Repository;

use App\Entity\Partner;

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
     * @param Partner $partner
     * @return bool
     */
    public function isPostValid(Partner $partner): bool
    {
        if ($partner->getName() == '') {
            return false;
        }
                    
        if ($partner->getSurname() == '') {
            return false;
        }
                    
        if (!filter_var($partner->getEmail(), FILTER_VALIDATE_EMAIL) ||
            $this->findOneBy(['email'=>$partner->getEmail()])) {
            return false;
        }

        return true;
    }

    /**
     * @param Partner $partner
     * @return Partner
     */
    public function postValidate(Partner $partner): ?Partner
    {
        $partner->setCode($this->getUniqueCode());

        if ($partner->getName() == '') {
            return null;
        }
                    
        if ($partner->getSurname() == '') {
            return null;
        }
                    
        if (!filter_var($partner->getEmail(), FILTER_VALIDATE_EMAIL) ||
            $this->findOneBy(['email'=>$partner->getEmail()])) {
            return null;
        }

        return $partner;
    }


    /**
     * @param array $data
     * @return bool
     */
    public function requestValidate(array $data = null): bool
    {
        foreach ((array)$data as $key => $value) {
            switch ($key) {
                case 'name':
                case 'surname':
                    if (empty($value)) {
                        return false;
                    }
                    break;
                case 'email':
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        return false;
                    }
                    break;
            }
        }
        
        return true;
    }
}
