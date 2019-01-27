<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use App\Entity\Language;
use App\Entity\Module;
use App\Entity\Lesson;

use App\DataFixtures\TeacherFixtures;
use App\DataFixtures\ModuleFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class LessonFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array
    {
        return ['default'];
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $k => $v) {
            $lesson = new Lesson();
            $lesson->setModule($v['module']);
            $lesson->setTeacher($v['teacher']);
            $lesson->setTitle($v['title']);
            $lesson->setAlias($v['alias']);
            $lesson->setDescription($v['description']);
            $lesson->setOrdering($v['ordering']);
    
            $manager->persist($lesson);
        }
    
        $manager->flush();
    }
    /**
     * @return iterable
     */
    private function getData() : iterable
    {
        yield [
            'module' => $this->getReference('language-1/module-1'),
            'teacher' => $this->getReference('uno@profesor.es'),
            'title' => 'Module 1', 'alias' => 'module-1', 'description' => 'Long description',
            'ordering' => '1'
            ];
        yield [
            'module' => $this->getReference('language-1/module-1'),
            'teacher' => $this->getReference('uno@profesor.es'),
            'title' => 'Module 1', 'alias' => 'module-1', 'description' => 'Long description',
            'ordering' => '2'
            ];
        yield [
            'module' => $this->getReference('language-1/module-1'),
            'teacher' => $this->getReference('uno@profesor.es'),
            'title' => 'Module 1', 'alias' => 'module-1', 'description' => 'Long description',
            'ordering' => '3'
            ];
        yield [
            'module' => $this->getReference('language-1/module-1'),
            'teacher' => $this->getReference('uno@profesor.es'),
            'title' => 'Module 1', 'alias' => 'module-1', 'description' => 'Long description',
            'ordering' => '4'
            ];
            
        yield [
            'module' => $this->getReference('language-1/module-2'),
            'teacher' => $this->getReference('uno@profesor.es'),
            'title' => 'Module 1', 'alias' => 'module-1', 'description' => 'Long description',
            'ordering' => '1'
            ];
        yield [
            'module' => $this->getReference('language-1/module-2'),
            'teacher' => $this->getReference('uno@profesor.es'),
            'title' => 'Module 1', 'alias' => 'module-1', 'description' => 'Long description',
            'ordering' => '2'
            ];
    }

    /**
     * @return mixed[]
     */
    public function getDependencies(): array
    {
        return [
            TeacherFixtures::class,
            ModuleFixtures::class,
        ];
    }
}
