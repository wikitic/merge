<?php

namespace App\BundlePartner\DataFixtures;

use App\BundlePartner\Entity\Partner;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PartnerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $k => $v) {
            $partner = new Partner();
            $partner->setCode($v['code']);
            $partner->setName($v['name']);
            $partner->setSurname($v['surname']);
            $partner->setEmail($v['email']);
            $partner->setActive($v['active']);
            $partner->setRole($v['role']);
            $partner->setCDate($v['cdate']);
    
            $this->addReference($v['code'], $partner);
            $manager->persist($partner);
        }
    
        $manager->flush();
    }

    /**
     * @return iterable
     */
    private function getData() : iterable
    {
        yield [
            'code' => 'AAAAAA', 'name' => 'Name 1', 'surname' => 'Surname 1','email' => 'email1@email.com',
            'active' => 1, 'role' => Partner::ROLE_PREMIUM,
            'cdate' => new \DateTime('2015-01-01')
            ];
        yield [
            'code' => 'BBBBBB', 'name' => 'Name 2', 'surname' => 'Surname 2','email' => 'email2@email.com',
            'active' => 1, 'role' => Partner::ROLE_PREMIUM,
            'cdate' => new \DateTime('2016-01-01')
            ];
        yield [
            'code' => 'CCCCCC', 'name' => 'Name 3', 'surname' => 'Surname 3','email' => 'email3@email.com',
            'active' => 1, 'role' => Partner::ROLE_USER,
            'cdate' => new \DateTime('2017-01-01')
            ];
        yield [
            'code' => 'DDDDDD', 'name' => 'Name 4', 'surname' => 'Surname 4','email' => 'email4@email.com',
            'active' => 1, 'role' => Partner::ROLE_PREMIUM,
            'cdate' => new \DateTime('2018-01-01')
            ];
        yield [
            'code' => 'EEEEEE', 'name' => 'Name 5', 'surname' => 'Surname 5','email' => 'email5@email.com',
            'active' => 0, 'role' => Partner::ROLE_PREMIUM,
            'cdate' => new \DateTime('2019-01-01')
            ];
    }
}
