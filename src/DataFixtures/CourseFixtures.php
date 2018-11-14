<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\DataFixtures\CategoryFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CourseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $k=>$v) {
            $course = new Course();
            $course->setCategory($v['category']);
            $course->setTitle($v['title']);
            $course->setAlias($v['alias']);
            $course->setIntrotext($v['introtext']);
            $course->setImageIntro($v['image_intro']);
            $course->setLevel($v['level']);
            $course->setMetatitle($v['metatitle']);
            $course->setMetadesc($v['metadesc']);
            $course->setMetakey($v['metakey']);
            $course->setMetaimage($v['metaimage']);
            $course->setActive($v['active']);

            $this->addReference($v['alias'], $course);

            $manager->persist($course);
            $manager->flush();
        }
    }
    private function getData()
    {
        yield [
            'category' => $this->getReference('categoria-1'),
            'title' => 'Curso 1 1',
            'alias' => 'curso-1-1',
            'introtext' => 'Descripción 1',
            'image_intro' => 'curso.png',
            'level' => 'Nivel 1',
            'metatitle' => 'Meta título del curso',
            'metadesc' => 'Meta descripción del curso',
            'metakey' => 'meta, palabras, curso',
            'metaimage' => 'curso.png',
            'active' => true
        ];
        yield [
            'category' => $this->getReference('categoria-1'),
            'title' => 'Curso 1 2',
            'alias' => 'curso-1-2',
            'introtext' => 'Descripción 2',
            'image_intro' => 'curso.png',
            'level' => 'Nivel 1',
            'metatitle' => 'Meta título del curso',
            'metadesc' => 'Meta descripción del curso',
            'metakey' => 'meta, palabras, curso',
            'metaimage' => 'curso.png',
            'active' => true
        ];
        yield [
            'category' => $this->getReference('categoria-1'),
            'title' => 'Curso 1 3',
            'alias' => 'curso-1-3',
            'introtext' => 'Descripción 3',
            'image_intro' => 'curso.png',
            'level' => 'Nivel 1',
            'metatitle' => 'Meta título del curso',
            'metadesc' => 'Meta descripción del curso',
            'metakey' => 'meta, palabras, curso',
            'metaimage' => 'curso.png',
            'active' => true
        ];

        yield [
            'category' => $this->getReference('categoria-2'),
            'title' => 'Curso 2 1',
            'alias' => 'curso-2-1',
            'introtext' => 'Descripción 1',
            'image_intro' => 'curso.png',
            'level' => 'Nivel 2',
            'metatitle' => 'Meta título del curso',
            'metadesc' => 'Meta descripción del curso',
            'metakey' => 'meta, palabras, curso',
            'metaimage' => 'curso.png',
            'active' => true
        ];
        yield [
            'category' => $this->getReference('categoria-2'),
            'title' => 'Curso 2 2',
            'alias' => 'curso-2-2',
            'introtext' => 'Descripción 1',
            'image_intro' => 'curso.png',
            'level' => 'Nivel 2',
            'metatitle' => 'Meta título del curso',
            'metadesc' => 'Meta descripción del curso',
            'metakey' => 'meta, palabras, curso',
            'metaimage' => 'curso.png',
            'active' => true
        ];
        yield [
            'category' => $this->getReference('categoria-2'),
            'title' => 'Curso 2 3',
            'alias' => 'curso-2-3',
            'introtext' => 'Descripción 3',
            'image_intro' => 'curso.png',
            'level' => 'Nivel 2',
            'metatitle' => 'Meta título del curso',
            'metadesc' => 'Meta descripción del curso',
            'metakey' => 'meta, palabras, curso',
            'metaimage' => 'curso.png',
            'active' => true
        ];

        yield [
            'category' => $this->getReference('categoria-3'),
            'title' => 'Curso 3 1',
            'alias' => 'curso-3-1',
            'introtext' => 'Descripción 1',
            'image_intro' => 'curso.png',
            'level' => 'Nivel 3',
            'metatitle' => 'Meta título del curso',
            'metadesc' => 'Meta descripción del curso',
            'metakey' => 'meta, palabras, curso',
            'metaimage' => 'curso.png',
            'active' => true
        ];
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}