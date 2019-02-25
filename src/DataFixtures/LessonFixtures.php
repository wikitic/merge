<?php

namespace App\DataFixtures;

use App\Entity\Lesson;
use App\DataFixtures\CourseFixtures;
use App\DataFixtures\TeacherFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LessonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $k => $v) {
            $lesson = new Lesson();
            $lesson->setCourse($v['course']);
            $lesson->setTeacher($v['teacher']);
            $lesson->setTitle($v['title']);
            $lesson->setAlias($v['alias']);
            $lesson->setDescription($v['description']);
            $lesson->setVideo($v['video']);
            $lesson->setFiles($v['files']);
            $lesson->setScore($v['score']);
            $lesson->setActive($v['active']);
            $lesson->setAccess($v['access']);

            $manager->persist($lesson);
            $manager->flush();
        }
    }
    private function getData()
    {
        yield [
            'course' => $this->getReference('curso-1-1'),
            'teacher' => $this->getReference('teacher@teacher.es'),
            'title' => 'Lección 1 1 1',
            'alias' => 'leccion-1-1-1',
            'description' => 'Descripción 1',
            'video' => '',
            'files' => '',
            'score' => 1,
            'active' => true,
            'access' => Lesson::ACCESS_USER
        ];
        yield [
            'course' => $this->getReference('curso-1-1'),
            'teacher' => $this->getReference('teacher@teacher.es'),
            'title' => 'Lección 1 1 2',
            'alias' => 'leccion-1-1-2',
            'description' => 'Descripción 1',
            'video' => '',
            'files' => '',
            'score' => 1,
            'active' => true,
            'access' => Lesson::ACCESS_USER
        ];
        yield [
            'course' => $this->getReference('curso-1-1'),
            'teacher' => $this->getReference('teacher@teacher.es'),
            'title' => 'Lección 1 1 3',
            'alias' => 'leccion-1-1-3',
            'description' => 'Descripción 1',
            'video' => '',
            'files' => '',
            'score' => 1,
            'active' => false,
            'access' => Lesson::ACCESS_USER
        ];
        yield [
            'course' => $this->getReference('curso-1-1'),
            'teacher' => $this->getReference('teacher@teacher.es'),
            'title' => 'Lección 1 1 4',
            'alias' => 'leccion-1-1-4',
            'description' => 'Descripción 1',
            'video' => '',
            'files' => '',
            'score' => 2,
            'active' => true,
            'access' => Lesson::ACCESS_PREMIUM
        ];
        yield [
            'course' => $this->getReference('curso-1-2'),
            'teacher' => $this->getReference('teacher@teacher.es'),
            'title' => 'Lección 1 2 1',
            'alias' => 'leccion-1-2-1',
            'description' => 'Descripción 1',
            'video' => '',
            'files' => '',
            'score' => 0,
            'active' => true,
            'access' => Lesson::ACCESS_USER
        ];
        yield [
            'course' => $this->getReference('curso-1-2'),
            'teacher' => $this->getReference('teacher@teacher.es'),
            'title' => 'Lección 1 2 2',
            'alias' => 'leccion-1-2-2',
            'description' => 'Descripción 1',
            'video' => '',
            'files' => '',
            'score' => 0,
            'active' => true,
            'access' => Lesson::ACCESS_USER
        ];
        yield [
            'course' => $this->getReference('curso-1-2'),
            'teacher' => $this->getReference('teacher@teacher.es'),
            'title' => 'Lección 1 2 3',
            'alias' => 'leccion-1-2-3',
            'description' => 'Descripción 1',
            'video' => '',
            'files' => '',
            'score' => 0,
            'active' => true,
            'access' => Lesson::ACCESS_USER
        ];
        yield [
            'course' => $this->getReference('curso-1-2'),
            'teacher' => $this->getReference('teacher@teacher.es'),
            'title' => 'Lección 1 2 4',
            'alias' => 'leccion-1-2-4',
            'description' => 'Descripción 1',
            'video' => '',
            'files' => '',
            'score' => 0,
            'active' => true,
            'access' => Lesson::ACCESS_USER
        ];
        yield [
            'course' => $this->getReference('curso-1-2'),
            'teacher' => $this->getReference('teacher@teacher.es'),
            'title' => 'Lección 1 2 5',
            'alias' => 'leccion-1-2-5',
            'description' => 'Descripción 1',
            'video' => '',
            'files' => '',
            'score' => 0,
            'active' => true,
            'access' => Lesson::ACCESS_PREMIUM
        ];
    }

    public function getDependencies(): array
    {
        return [
            CourseFixtures::class,
            TeacherFixtures::class,
        ];
    }
}
