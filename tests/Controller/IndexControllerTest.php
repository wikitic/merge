<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class IndexControllerTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testUrls($method = null, $url = null, $http_code = null)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $response = $client->getResponse();
        //$content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provideUrls()
    {
        $HTTP_OK = Response::HTTP_OK; // 200
        $HTTP_NOT_FOUND = Response::HTTP_NOT_FOUND; //404

        yield ['GET', '/',                $HTTP_OK];
        yield ['GET', '/ANY-URL-TO-VUE',  $HTTP_OK];
        
        yield ['GET', '/api',             $HTTP_NOT_FOUND];
        yield ['GET', '/api/BAD-URL',     $HTTP_NOT_FOUND];
        yield ['GET', '/api/v1/',         $HTTP_NOT_FOUND];
        yield ['GET', '/api/v1/BAD-URL',  $HTTP_NOT_FOUND];
    }
}