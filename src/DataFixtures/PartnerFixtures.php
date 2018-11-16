<?php

namespace App\DataFixtures;

use App\Entity\Partner;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PartnerFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $k=>$v) {
            $partner = new Partner();
            $partner->setCode($v['code']);
            $partner->setName($v['name']);
            $partner->setSurname($v['surname']);
            $partner->setEmail($v['email']);
            $partner->setPassword($v['password']);
            $partner->setActive($v['active']);
            $partner->setRole($v['role']);
            $partner->setCDate($v['cdate']);
    
            $this->addReference($v['code'], $partner);

            $manager->persist($partner);
        }
    
        $manager->flush();
    }
    private function getData()
    {
        yield [
                'code' => 'AAAAAA', 'name' => 'Name 1', 'surname' => 'Surname 1','email' => 'email1@email.com',
                'password' => 'AAAAAA',
                'active' => 1, 'role' => Partner::ROLE_PREMIUM, 
                'cdate' => new \DateTime('2015-01-01')
            ];
        yield [
                'code' => 'BBBBBB', 'name' => 'Name 2', 'surname' => 'Surname 2','email' => 'email2@email.com',
                'password' => 'BBBBBB',
                'active' => 1, 'role' => Partner::ROLE_PREMIUM, 
                'cdate' => new \DateTime('2015-01-01')
            ];
        yield [
                'code' => 'CCCCCC', 'name' => 'Name 3', 'surname' => 'Surname 3','email' => 'email3@email.com',
                'password' => 'CCCCCC',
                'active' => 1, 'role' => Partner::ROLE_USER, 
                'cdate' => new \DateTime('2015-01-01')
            ];
        yield [
                'code' => 'DDDDDD', 'name' => 'Name 4', 'surname' => 'Surname 4','email' => 'email4@email.com',
                'password' => 'DDDDDD',
                'active' => 0, 'role' => Partner::ROLE_PREMIUM, 
                'cdate' => new \DateTime('2015-01-01')
            ];
    }
}