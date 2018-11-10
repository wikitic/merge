<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultTest extends WebTestCase
{
    private $client = null;

    protected function setUp()
	{
        $this->client = static::createClient();
    }

    /**
     * @dataProvider provide_GET_url
     */
    public function test_GET_url($url = null, $http_code = null)
    {
        $client = $this->client;
        $client->request('GET', $url);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provide_GET_url()
    {
        yield ['/',         Response::HTTP_OK];         // 200
        yield ['/BAD-URL',  Response::HTTP_NOT_FOUND];  // 400
    }
}