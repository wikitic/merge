<?php

namespace App\Tests\Repository;

use App\Entity\Partner;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PartnerRepositoryTest extends WebTestCase
{
    private $er;

    protected function setUp()
    {
        $client = $this->createClient(['environment' => 'test']);
        $client->disableReboot();
        $em = $client->getContainer()->get('doctrine.orm.entity_manager');
        $em->beginTransaction();
        $this->er = $em->getRepository(Partner::class);
    }

    public function testGetUniqueCode()
    {
        $code = $this->er->getUniqueCode();

        $this->assertEquals(6, strlen($code));
    }
}
