<?php

namespace App\Tests\Repository;

use App\Entity\Partner;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PartnerTest extends WebTestCase
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
    
    /**
     * @dataProvider provideRequestValidate
     */
    public function testRequestValidate($method = null, $data = null, $assert = null)
    {
        $bool = $this->er->requestValidate($data, $method);
        $this->assertEquals($assert, $bool);
    }
    public function provideRequestValidate()
    {
        yield ['POST', [], false];
        yield ['POST', [                'surname'=>'surname', 'email'=>'GOOD@EMAIL.com'], false];
        yield ['POST', ['name'=>'name'                      , 'email'=>'GOOD@EMAIL.com'], false];
        yield ['POST', ['name'=>'name', 'surname'=>'surname'                           ], false];
        yield ['POST', ['name'=>'name', 'surname'=>'surname', 'email'=>'BAD_EMAIL'     ], false];
        yield ['POST', ['name'=>''    , 'surname'=>'surname', 'email'=>'GOOD@EMAIL.com'], false];
        yield ['POST', ['name'=>'name', 'surname'=>''       , 'email'=>'GOOD@EMAIL.com'], false];
        yield ['POST', ['name'=>'name', 'surname'=>'surname', 'email'=>''              ], false];
        yield ['POST', ['name'=>'name', 'surname'=>'surname', 'email'=>'GOOD@EMAIL.com'], true];

        yield ['PATCH', [], true];
        yield ['PATCH', ['name'=>''], false];
        yield ['PATCH', ['name'=>'name'], true];
        yield ['PATCH', ['surname'=>''], false];
        yield ['PATCH', ['surname'=>'surname'], true];
        yield ['PATCH', ['email'=>''], false];
        yield ['PATCH', ['email'=>'BAD_EMAIL'], false];
        yield ['PATCH', ['email'=>'GOOD@EMAIL.com'], true];
    }
}
