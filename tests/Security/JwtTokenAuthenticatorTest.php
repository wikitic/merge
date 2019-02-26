<?php

namespace App\Tests\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class JwtTokenAuthenticatorTest extends WebTestCase
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

    protected function createAuthenticatedClient($user = [])
    {
        $token = self::$kernel->getContainer()
            ->get('lexik_jwt_authentication.encoder')
            ->encode($user);


        $client = $this->client;
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $token));

        return $client;
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
        $HTTP_UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;             // 401

        yield ['GET',   '/v1/categories',  $HTTP_OK];
        yield ['POST',  '/v1/categories',  $HTTP_UNAUTHORIZED, json_encode([])];
    }


    /**
     * @dataProvider provide_GET_url_aut
     */
    public function test_GET_url_aut($method = null, $url = null, $http_code = null, $data = null)
    {
        $user = [
            'username' => 'admin',
            'aud' => 'admin'
        ];

        $client = $this->createAuthenticatedClient($user);
        $client->request($method, $url, [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provide_GET_url_aut()
    {
        $HTTP_OK = Response::HTTP_OK;                                 // 200
        $HTTP_BAD_REQUEST = Response::HTTP_BAD_REQUEST;               // 400
        $HTTP_UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;             // 401

        $category = [
            'title' => 'title',
            'alias' => 'alias',
            'description' => 'description',
            'metatitle' => 'metatitle',
            'metadesc' => 'metadesc',
            'metakey' => 'metakey',
            'metaimage' => 'metaimage',
            'active' => '0'
        ];

        yield ['GET',   '/v1/categories',  $HTTP_OK];
        yield ['POST',  '/v1/categories',  $HTTP_BAD_REQUEST, json_encode([])];
        yield ['POST',  '/v1/categories',  $HTTP_OK, json_encode($category)];
    }

}
