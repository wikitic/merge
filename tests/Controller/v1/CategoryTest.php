<?php

namespace App\Tests\Controller\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CategoryTest extends WebTestCase
{
    private $client = null;

    protected function setUp()
    {
        $this->client = $this->createClient(['environment' => 'test']);
        $this->client->disableReboot();
        $this->em = $this->client->getContainer()->get('doctrine.orm.entity_manager');
        $this->em->beginTransaction();
    }

    protected function tearDown()
    {
        $this->em->rollback();
    }

    /**
     * @dataProvider provide_GET_url
     */
    public function test_GET_url($url = null, $http_code = null, $data = null)
    {
        $client = $this->client;
        $client->request('GET', $url, [], [], ['CONTENT_TYPE' => 'application/json'], $data);

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

        yield ['/v1/categories',  $HTTP_OK];
        
        yield ['/v1/categories/categoria-1', $HTTP_OK];
        yield ['/v1/categories/categoria-2', $HTTP_FOUND]; // disabled
        yield ['/v1/categories/BAD-ALIAS',   $HTTP_FOUND];
    }



    /**
     * @dataProvider provide_POST_url
     */
    public function test_POST_url($url = null, $http_code = null, $data = null)
    {
        $client = $this->client;
        $client->request('POST', $url, [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provide_POST_url()
    {
        $HTTP_OK = Response::HTTP_OK;                                 // 200
        $HTTP_FOUND = Response::HTTP_FOUND;                           // 302
        $HTTP_METHOD_NOT_ALLOWED = Response::HTTP_METHOD_NOT_ALLOWED; // 405
        $HTTP_BAD_REQUEST = Response::HTTP_BAD_REQUEST;               // 400
        $HTTP_UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;             // 401

        $category = [
            'title' => 'title',
            'alias' => 'categoria-1', // Exist
            'alias' => 'alias',
            'description' => 'description',
            'metatitle' => 'metatitle',
            'metadesc' => 'metadesc',
            'metakey' => 'metakey',
            'metaimage' => 'metaimage',
            'active' => '0'
        ];

        foreach ($category as $k => $v) {
            $aux = $category;
            unset($aux[$k]);
            yield ['/v1/categories',  $HTTP_BAD_REQUEST, json_encode($aux)];
        }

        yield ['/v1/categories',  $HTTP_BAD_REQUEST, json_encode([])];
        yield ['/v1/categories',  $HTTP_OK, json_encode($category)];
    }
}
