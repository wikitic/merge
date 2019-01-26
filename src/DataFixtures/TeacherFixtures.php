<?php

namespace App\DataFixtures;

use App\Entity\Teacher;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class TeacherFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['default'];
    }
    
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $k => $v) {
            $teacher = new Teacher();
            $teacher->setEmail($v['email']);
            $teacher->setName($v['name']);
            $teacher->setPassword($v['password']);
            $teacher->setActive($v['active']);
            $manager->persist($teacher);
        }
    
        $manager->flush();
    }

    /**
     * @return iterable
     */
    private function getData() : iterable
    {
        yield [
            'email' => 'admin@admin.es', 'name' => 'admin', 'password' => 'pa$$w0rd', 'active' => 1
            ];
        yield [
            'email' => 'uno@profesor.es', 'name' => 'Profesor 1', 'password' => '', 'active' => 0
            ];
        yield [
            'email' => 'dos@profesor.es', 'name' => 'Profesor 2', 'password' => '', 'active' => 0
            ];
    }
}
