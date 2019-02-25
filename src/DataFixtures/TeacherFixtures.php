<?php

namespace App\DataFixtures;

use App\Entity\Teacher;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TeacherFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $k => $v) {
            $teacher = new Teacher();
            $teacher->setName($v['name']);
            $teacher->setImage($v['image']);
            $teacher->setDescription($v['description']);

            $this->addReference($v['name'], $teacher);

            $manager->persist($teacher);
            $manager->flush();
        }
    }

    /**
     * @return iterable
     */
    private function getData() : iterable
    {
        yield [
            'name' => 'Teacher 1',
            'image' => 'teacher.png',
            'description' => 'Descripción'
        ];
        yield [
            'name' => 'Teacher 2',
            'image' => 'teacher.png',
            'description' => 'Descripción'
        ];
    }
}
