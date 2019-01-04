<?php

namespace App\Tests\Repository;

use App\Entity\Partner;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PartnerTest extends WebTestCase
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
        $this->er = $this->em->getRepository(Partner::class);
    }

    protected function tearDown()
    {
        $this->em->rollback();
    }

    public function testGetUniqueCode()
    {
        $code = $this->er->getUniqueCode();

        $this->assertEquals(6, strlen($code));
    }
}
