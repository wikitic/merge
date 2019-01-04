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
     * @param int $numSubscriptions
     * @return Partner[]
     */
    public function findAllGreaterThanSubscriptions(int $numSubscriptions = 0): array
    {
        $qb = $this->createQueryBuilder('p')

            //->addSelect('p.subscriptions')

            //->andWhere('p.id > :id')
            //->setParameter('id', $numSubscriptions)

            //->having('count(p.subscriptions) > 3')
            //->orderBy('p.subscriptions', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @param string $code
     * @return bool
     */
    public function existCode(string $code = ''): bool
    {
        return (bool)$this->findOneBy(['code'=>$code]);
    }

    /**
     * @return string
     */
    public function getUniqueCode(): string
    {
        do {
            $code = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 6)), 0, 6);
        } while ($this->existCode($code));

        return $code;
    }

    /**
     * @param $request
     * @return bool
     */
    public function isPostValid($data): bool
    {
        if(!isset($data['name']) || !isset($data['surname']) || !isset($data['email']))
            return false;

        foreach($data as $key => $value){
            switch($key){
                case 'name':
                case 'surname':
                    if(empty($value))
                        return false;
                    break;
                case 'email':
                    if(!strpos($value, "@") || !strpos($value, ".") || $this->findByEmail(['email'=>$data['email']])) 
                        return false;
                    break;
            }
        }

        return true;
    }

}
