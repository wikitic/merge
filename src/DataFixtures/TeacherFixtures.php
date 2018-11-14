<?php

namespace App\DataFixtures;

use App\Entity\Teacher;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TeacherFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $k=>$v) {
            $teacher = new Teacher();
            $teacher->setEmail($v['email']);
            $teacher->setPassword($v['password']);
            $teacher->setName($v['name']);
            $teacher->setImage($v['image']);
            $teacher->setDescription($v['description']);
            $teacher->setSocial($v['social']);
            $teacher->setRole($v['role']);
            $teacher->setActive($v['active']);

            $this->addReference($v['email'], $teacher);

            $manager->persist($teacher);
            $manager->flush();
        }
    }
    private function getData()
    {
        yield [
            'email' => 'admin@admin.es',
            'password' => 'pa$$w0rd',
            'name' => 'Super Admin',
            'image' => 'teacher.png',
            'description' => 'Descripción',
            'social' => json_encode([]),
            'role' => Teacher::ROLE_SUPER_ADMIN,
            'active' => true
        ];
        yield [
            'email' => 'teacher@teacher.es',
            'password' => 'pa$$w0rd',
            'name' => 'User',
            'image' => 'teacher.png',
            'description' => 'Descripción',
            'social' => json_encode([]),
            'role' => Teacher::ROLE_TEACHER,
            'active' => true
        ];
    }

}