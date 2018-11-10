<?php

namespace App\Tests\Entity;

use App\Entity\Category;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CategoryTest extends WebTestCase
{
    private $client;
    private $em;
    private $er;

    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->client = $this->createClient(['environment' => 'test']);
        $this->client->disableReboot();

        $this->em = $this->client->getContainer()->get('doctrine.orm.entity_manager');
        $this->em->beginTransaction();

        $this->er = $this->em->getRepository(Category::class);
    }

    protected function tearDown()
    {
        $this->em->rollback();
    }


    public function test_addCategory()
    {
        $next_ordering  = $this->er->getNextOrdering();

        $category = new Category();
        $category->setTitle('Nueva categoría');
        $category->setAlias('nueva-categoria');
        $category->setDescription('Description');

        $category->setMetatitle('Metatitle');
        $category->setMetadesc('Metadesc');
        $category->setMetakey('Metakey');
        $category->setMetaimage('Metaimage');

        //$category->setOrdering(0);
        //$category->setActive(1);
        //$category->setCdate(\new Datetime());
        //$category->setMdate(\new Datetime());

        $this->em->persist($category);
        $this->em->flush();

        $this->assertEquals($next_ordering, $category->getOrdering());
    }
}
