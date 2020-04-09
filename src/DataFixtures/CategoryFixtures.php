<?php

namespace App\DataFixtures;

use App\Entity\Category;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $k => $v) {
            $category = new Category();
            $category->setTitle($v['title']);
            $category->setAlias($v['alias']);
            $category->setDescription($v['description']);
            $category->setMetatitle($v['metatitle']);
            $category->setMetadesc($v['metadesc']);
            $category->setMetakey($v['metakey']);
            $category->setMetaimage($v['metaimage']);
            $category->setActive($v['active']);
            $category->setOrdering($v['ordering']);
            
            if (isset($v['salt'])) {
                $category->setSalt($v['salt']);
            }
            // $category->setCdate($v['cdate']);
            // $category->setMdate($v['mdate']);

            $this->addReference($v['alias'], $category);

            $manager->persist($category);
            $manager->flush();
        }
    }

    /**
     * @return iterable
     */
    private function getData() : iterable
    {
        yield [
            'title' => 'Categoría 1',
            'alias' => 'categoria-1',
            'description' => 'Descripción 1',
            'metatitle' => 'Meta título de la categoría',
            'metadesc' => 'Meta descripción de la categoría 1',
            'metakey' => 'meta, palabras, categoría',
            'metaimage' => 'categoria.png',
            'active' => 1,
            'ordering' => 1,
            'salt' => 'GOOD-SALT-1'
        ];
        yield [
            'title' => 'Categoría 2',
            'alias' => 'categoria-2',
            'description' => 'Descripción 2',
            'metatitle' => 'Meta título de la categoría 2',
            'metadesc' => 'Meta descripción de la categoría 2',
            'metakey' => 'meta, palabras, categoría',
            'metaimage' => 'categoria.png',
            'active' => 0,
            'ordering' => 2,
            'salt' => 'GOOD-SALT-2'
        ];
        yield [
            'title' => 'Categoría 3',
            'alias' => 'categoria-3',
            'description' => 'Descripción 3',
            'metatitle' => 'Meta título de la categoría 3',
            'metadesc' => 'Meta descripción de la categoría 3',
            'metakey' => 'meta, palabras, categoría',
            'metaimage' => 'categoria.png',
            'active' => 1,
            'ordering' => 3,
            'salt' => 'GOOD-SALT-3'
        ];
        yield [
            'title' => 'Categoría 4',
            'alias' => 'categoria-4',
            'description' => 'Descripción 4',
            'metatitle' => 'Meta título de la categoría 4',
            'metadesc' => 'Meta descripción de la categoría 4',
            'metakey' => 'meta, palabras, categoría',
            'metaimage' => 'categoria.png',
            'active' => 1,
            'ordering' => 4,
            'salt' => 'GOOD-SALT-4'
        ];
    }
}
