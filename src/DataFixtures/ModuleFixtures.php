<?php

namespace App\DataFixtures;

use App\Entity\Language;
use App\Entity\Module;

use App\DataFixtures\LanguageFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ModuleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $k => $v) {
            $module = new Module();
            $module->setLanguage($v['language']);
            $module->setTitle($v['title']);
            $module->setAlias($v['alias']);
            $module->setIntrotext($v['introtext']);
            $module->setImageintro($v['image_intro']);
            $module->setLevel($v['level']);
            $module->setOrdering($v['ordering']);
    
            $this->addReference($v['language']->getAlias().'-'.$v['alias'], $module);
            $manager->persist($module);
        }
    
        $manager->flush();
    }
    /**
     * @return iterable
     */
    private function getData() : iterable
    {
        yield [
            'language' => $this->getReference('language-1'),
            'title' => 'Module 1', 'alias' => 'module-1', 'introtext' => 'Short description',
            'image_intro' => 'image.png', 'level' => 'level',
            'ordering' => '1'
            ];
        yield [
            'language' => $this->getReference('language-1'),
            'title' => 'Module 2', 'alias' => 'module-2', 'introtext' => 'Short description',
            'image_intro' => 'image.png', 'level' => 'level',
            'ordering' => '2'
            ];
        yield [
            'language' => $this->getReference('language-1'),
            'title' => 'Module 3', 'alias' => 'module-3', 'introtext' => 'Short description',
            'image_intro' => 'image.png', 'level' => 'level',
            'ordering' => '3'
            ];

        yield [
            'language' => $this->getReference('language-2'),
            'title' => 'Module 1', 'alias' => 'module-1', 'introtext' => 'Short description',
            'image_intro' => 'image.png', 'level' => 'level',
            'ordering' => '1'
            ];
        yield [
            'language' => $this->getReference('language-2'),
            'title' => 'Module 2', 'alias' => 'module-2', 'introtext' => 'Short description',
            'image_intro' => 'image.png', 'level' => 'level',
            'ordering' => '2'
            ];

        yield [
            'language' => $this->getReference('language-3'),
            'title' => 'Module 1', 'alias' => 'module-1', 'introtext' => 'Short description',
            'image_intro' => 'image.png', 'level' => 'level',
            'ordering' => '1'
            ];
    }

    /**
     * @return mixed[]
     */
    public function getDependencies(): array
    {
        return [
            LanguageFixtures::class,
        ];
    }
}
