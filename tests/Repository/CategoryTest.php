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



    public function test_getLastOrdering()
    {
        $categories     = $this->er->findAll();
        $last_ordering  = $this->er->getLastOrdering();

        $this->assertEquals(count($categories), $last_ordering);
    }

    public function test_getNextOrdering()
    {
        $categories     = $this->er->findAll();
        $next_ordering  = $this->er->getNextOrdering();

        $this->assertEquals(count($categories) + 1, $next_ordering);
    }
}
