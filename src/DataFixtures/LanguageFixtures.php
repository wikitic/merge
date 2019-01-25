<?php

namespace App\DataFixtures;

use App\Entity\Language;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $k => $v) {
            $language = new Language();
            $language->setTitle($v['title']);
            $language->setAlias($v['alias']);
            $language->setDescription($v['description']);
            $language->setOrdering($v['ordering']);
    
            $this->addReference($v['alias'], $language);
            $manager->persist($language);
        }
    
        $manager->flush();
    }
    /**
     * @return iterable
     */
    private function getData() : iterable
    {
        yield [
            'title' => 'Language 1', 'alias' => 'language-1', 'description' => 'Long description',
            'ordering' => '1'
            ];
        yield [
            'title' => 'Language 2', 'alias' => 'language-2', 'description' => 'Long description',
            'ordering' => '2'
            ];
        yield [
            'title' => 'Language 3', 'alias' => 'language-3', 'description' => 'Long description',
            'ordering' => '3'
            ];
    }
}
