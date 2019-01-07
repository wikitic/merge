<?php

namespace App\Tests\Controller\api\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SubscriptionControllerTest extends WebTestCase
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

    private function logIn()
    {
        $client = $this->client;
        $json = json_encode(['username'=>'admin','password'=>'pa$$w0rd']);
        $client->request('POST', '/api/v1/login', [], [], ['CONTENT_TYPE' => 'application/json'], $json);
        
        return $client;
    }



    /**
     * @dataProvider provideUnauthorized
     */
    public function testUnauthorized($method = null, $url = null, $http_code = null, $data = null)
    {
        $client = $this->client;
        $client->request($method, $url, [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provideUnauthorized()
    {
        yield ['GET',   '/api/v1/subscriptions',     Response::HTTP_UNAUTHORIZED]; // 401
    }






    /**
     * @dataProvider provideAuthorizedPost
     */
    public function testAuthorizedPost($http_code = null, $data = null)
    {
        $this->logIn();
        
        $client = $this->client;
        $client->request('POST', '/api/v1/partners/1/subscriptions', [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provideAuthorizedPost()
    {
        $OK = Response::HTTP_OK;                    // 200
        $BAD_REQUEST = Response::HTTP_BAD_REQUEST;  // 400

        yield [$OK, json_encode(['info'=>'Text','price'=>'0','inDate'=>'2018-01-01 00:00:00', 'outDate'=>'2019-01-01 00:00:00'])];
        yield [$OK, json_encode(['info'=>'Text','price'=>'1','inDate'=>'2018-01-01 00:00:00', 'outDate'=>'2019-01-01 00:00:00'])];
        yield [$OK, json_encode(['info'=>'Text','price'=>'1.1','inDate'=>'2018-01-01 00:00:00', 'outDate'=>'2019-01-01 00:00:00'])];

        yield [$BAD_REQUEST, json_encode([])];
        yield [$BAD_REQUEST, json_encode(['info'=>'','price'=>'0','inDate'=>'2018-01-01 00:00:00', 'outDate'=>'2019-01-01 00:00:00'])];
        yield [$BAD_REQUEST, json_encode(['info'=>'Text','price'=>'','inDate'=>'2018-01-01 00:00:00', 'outDate'=>'2019-01-01 00:00:00'])];
        yield [$BAD_REQUEST, json_encode(['info'=>'Text','price'=>'1','inDate'=>'', 'outDate'=>'2019-01-01 00:00:00'])];
        yield [$BAD_REQUEST, json_encode(['info'=>'Text','price'=>'1','inDate'=>'2018-01-01 00:00:00', 'outDate'=>''])];
    }


    /**
     * @dataProvider provideAuthorizedPatch
     */
    public function testAuthorizedPatch($http_code = null, $data = null)
    {
        $this->logIn();
        
        $client = $this->client;
        $client->request('PATCH', '/api/v1/partners/1/subscriptions/1', [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provideAuthorizedPatch()
    {
        $OK = Response::HTTP_OK;                    // 200
        $BAD_REQUEST = Response::HTTP_BAD_REQUEST;  // 400

        yield [$OK, json_encode([])];
        yield [$OK, json_encode(['info'=>'nuevo'])];
        yield [$OK, json_encode(['price'=>'1'])];
        yield [$OK, json_encode(['inDate'=>'2020-01-01 00:00:00'])];
        yield [$OK, json_encode(['outDate'=>'2020-01-01 00:00:00'])];

        yield [$BAD_REQUEST, json_encode(['info'=>''])];
        yield [$BAD_REQUEST, json_encode(['price'=>''])];
        yield [$BAD_REQUEST, json_encode(['price'=>'BAD'])];
        yield [$BAD_REQUEST, json_encode(['inDate'=>''])];
        yield [$BAD_REQUEST, json_encode(['inDate'=>'BAD_DATE'])];
        yield [$BAD_REQUEST, json_encode(['outDate'=>''])];
        yield [$BAD_REQUEST, json_encode(['outDate'=>'BAD_DATE'])];
    }


    /**
     * @dataProvider provideAuthorizedDelete
     */
    public function testAuthorizedDelete($url = null, $http_code = null)
    {
        $this->logIn();
        
        $client = $this->client;
        $client->request('DELETE', $url);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provideAuthorizedDelete()
    {
        $OK = Response::HTTP_OK;                    // 200
        $BAD_REQUEST = Response::HTTP_BAD_REQUEST;  // 400

        yield ['/api/v1/partners/1/subscriptions/0',    $BAD_REQUEST];
        yield ['/api/v1/partners/0/subscriptions/1',    $BAD_REQUEST];
        yield ['/api/v1/partners/1/subscriptions/6',    $BAD_REQUEST];

        yield ['/api/v1/partners/1/subscriptions/1',    $OK];

    }
}
