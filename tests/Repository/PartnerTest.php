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


    public function test_existCode()
    {
        $this->assertEquals(true, $this->er->existCode('AAAAAA'));

        $this->assertEquals(false, $this->er->existCode());
        $this->assertEquals(false, $this->er->existCode('ZZZZZZ'));
    }

    public function test_getUniqueCode()
    {
        $code = $this->er->getUniqueCode();

        $this->assertEquals(6, strlen($code));
    }
}