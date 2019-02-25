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
    $old_num = count($this->er->findAll());

    $category = new Category();
    $category->setTitle('Nueva categoría');
    $category->setAlias('nueva-categoria');
    $category->setDescription('Description');
    $category->setMetatitle('Metatitle');
    $category->setMetadesc('Metadesc');
    $category->setMetakey('Metakey');
    $category->setMetaimage('Metaimage');
    $category->setActive(true);
    $category->setOrdering(5);

    $this->em->persist($category);
    $this->em->flush();

    $new_num = count($this->er->findAll());

    $this->assertEquals($old_num +1, $new_num);
  }

}
