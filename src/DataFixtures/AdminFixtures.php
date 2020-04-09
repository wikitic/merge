<?php

namespace App\DataFixtures;

use App\Entity\Admin;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AdminFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $k => $v) {
            $admin = new Admin();
            $admin->setUsername($v['username']);
            $admin->setPassword($v['password']);
            $admin->setSalt($v['salt']);
            $admin->setRole($v['role']);
            $manager->persist($admin);
        }
    
        $manager->flush();
    }

    /**
     * @return iterable
     */
    private function getData() : iterable
    {
        yield [
                'username' => 'admin',
                'password' => 'pa$$w0rd',
                'salt' => md5(uniqid()),
                'role' => Admin::ROLE_SUPER_ADMIN
            ];
    }
}
