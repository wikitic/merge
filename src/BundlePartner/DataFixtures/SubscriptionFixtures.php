<?php

namespace App\BundlePartner\DataFixtures;

use App\BundlePartner\Entity\Partner;
use App\BundlePartner\Entity\Subscription;

use App\BundlePartner\DataFixtures\PartnerFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class SubscriptionFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array
    {
        return ['partner'];
    }
    
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $k => $v) {
            $subscription = new Subscription();
            $subscription->setPartner($v['partner']);
            $subscription->setInDate($v['indate']);
            $subscription->setOutDate($v['outdate']);
            $subscription->setInfo($v['info']);
            $subscription->setPrice($v['price']);
    
            $manager->persist($subscription);
        }
    
        $manager->flush();
    }

    /**
     * @return iterable
     */
    private function getData() : iterable
    {
        yield [
            'partner' => $this->getReference('AAAAAA'), 'info' => 'Suscripción 1', 'price' => '1.11',
            'indate' => new \DateTime('2015-01-01'), 'outdate' => new \DateTime('2016-01-01')
            ];
        yield [
            'partner' => $this->getReference('AAAAAA'), 'info' => 'Suscripción 2', 'price' => '1.11',
            'indate' => new \DateTime('2016-01-01'), 'outdate' => new \DateTime('2017-01-01')
            ];
        yield [
            'partner' => $this->getReference('AAAAAA'), 'info' => 'Suscripción 3', 'price' => '1.11',
            'indate' => new \DateTime('2017-01-01'), 'outdate' => new \DateTime('2018-01-01')
            ];
        yield [
            'partner' => $this->getReference('AAAAAA'), 'info' => 'Suscripción 4', 'price' => '1.11',
            'indate' => new \DateTime('2018-01-01'), 'outdate' => new \DateTime('2019-01-01')
            ];
        yield [
            'partner' => $this->getReference('AAAAAA'), 'info' => 'Suscripción 5', 'price' => '1.11',
            'indate' => new \DateTime('2019-01-01'), 'outdate' => new \DateTime('2020-01-01')
            ];
        yield [
            'partner' => $this->getReference('BBBBBB'), 'info' => 'Suscripción 1', 'price' => '2.22',
            'indate' => new \DateTime('2016-01-01'), 'outdate' => new \DateTime('2017-01-01')
            ];
    }

    public function getDependencies()
    {
        return [
            PartnerFixtures::class,
        ];
    }
}
