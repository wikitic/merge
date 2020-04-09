<?php

namespace App\Tests\Entity;

use App\Entity\Category;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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

      $this->validator = static::$kernel->getContainer()->get('validator');
  }

  protected function tearDown()
  {
      $this->em->rollback();
  }

  public function test_validators()
  {
    $category = new Category();

    $this->assertNull($category->getId());

    $violations = $this->validator->validate($category);
    $this->assertEquals(7, count($violations));
    $this->assertEquals('title.not_blank', $violations[0]->getMessageTemplate());

    $category->setTitle('Nuevo título');
    $violations = $this->validator->validate($category);
    $this->assertEquals(6, count($violations));
    $this->assertEquals('alias.not_blank', $violations[0]->getMessageTemplate());

    $category->setAlias('categoria-1');
    $violations = $this->validator->validate($category);
    $this->assertEquals(6, count($violations));
    $this->assertEquals('alias.unique', $violations[0]->getMessageTemplate());

    $category->setAlias('categoria-nueva');
    $violations = $this->validator->validate($category);
    $this->assertEquals(5, count($violations));
    $this->assertEquals('description.not_blank', $violations[0]->getMessageTemplate());

    $category->setDescription('Nueva descripción');
    $violations = $this->validator->validate($category);
    $this->assertEquals(4, count($violations));
    $this->assertEquals('metatitle.not_blank', $violations[0]->getMessageTemplate());

    $category->setMetatitle('Nueva metatitle');
    $violations = $this->validator->validate($category);
    $this->assertEquals(3, count($violations));
    $this->assertEquals('metadesc.not_blank', $violations[0]->getMessageTemplate());

    $category->setMetadesc('Nueva metadesc');
    $violations = $this->validator->validate($category);
    $this->assertEquals(2, count($violations));
    $this->assertEquals('metakey.not_blank', $violations[0]->getMessageTemplate());

    $category->setMetakey('Nueva metakey');
    $violations = $this->validator->validate($category);
    $this->assertEquals(1, count($violations));
    $this->assertEquals('metaimage.not_blank', $violations[0]->getMessageTemplate());

    $category->setMetaimage('Nueva metaimage');
    $violations = $this->validator->validate($category);
    $this->assertEquals(0, count($violations));

    $this->assertNull($category->getActive());
    $this->assertNull($category->getOrdering());

    $this->assertNotNull($category->getSalt());
    $this->assertNotNull($category->getCdate());
    $this->assertNotNull($category->getMdate());
  }

  /*
  public function test_ordering()
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
  */

}
