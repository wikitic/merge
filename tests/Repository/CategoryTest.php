<?php

namespace App\Tests\Repository;

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



    public function test_getLastPosition()
    {
        $categories     = $this->er->findAll();
        $last_position  = $this->er->getLastPosition();

        $this->assertEquals(count($categories), $last_position);
    }

    public function test_getNextPosition()
    {
        $categories     = $this->er->findAll();
        $next_position  = $this->er->getNextPosition();

        $this->assertEquals(count($categories) + 1, $next_position);
    }
}
