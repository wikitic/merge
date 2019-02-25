<?php

namespace App\Tests\Controller\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CategoryTest extends WebTestCase
{
    private $client = null;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * @dataProvider provide_GET_url
     */
    public function test_GET_url($method = null, $url = null, $http_code = null, $data = null)
    {
        $client = $this->client;
        $client->request($method, $url, [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provide_GET_url()
    {
        $HTTP_OK = Response::HTTP_OK;                                 // 200
        $HTTP_FOUND = Response::HTTP_FOUND;                           // 302
        $HTTP_METHOD_NOT_ALLOWED = Response::HTTP_METHOD_NOT_ALLOWED; // 405
        $HTTP_BAD_REQUEST = Response::HTTP_BAD_REQUEST;               // 400
        $HTTP_UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;             // 401

        yield ['GET', '/v1/categories',  $HTTP_OK];
        
        yield ['GET', '/v1/categories/categoria-1',  $HTTP_OK];
        yield ['GET', '/v1/categories/categoria-2',  $HTTP_FOUND]; // disabled
        yield ['GET', '/v1/categories/BAD-ALIAS',  $HTTP_FOUND];
    }
}
