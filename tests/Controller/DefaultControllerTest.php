<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
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
        return [
            ['/',       Response::HTTP_OK],
            ['/BAD',    Response::HTTP_NOT_FOUND],
        ];
    }
}