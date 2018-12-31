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
        $client->request($method, $url);

        $response = $client->getResponse();
        //$content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provideUrls()
    {
        yield ['GET',   '/',                Response::HTTP_OK];         // 200
        yield ['GET',   '/ANY-URL-TO-VUE',  Response::HTTP_OK];         // 200

        yield ['GET',   '/api',             Response::HTTP_NOT_FOUND];  // 404
        yield ['GET',   '/api/BAD-URL',     Response::HTTP_NOT_FOUND];  // 404
        yield ['GET',   '/api/v1/',         Response::HTTP_NOT_FOUND];  // 404
        yield ['GET',   '/api/v1/BAD-URL',  Response::HTTP_NOT_FOUND];  // 404
    }
}
