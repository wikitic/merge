<?php

namespace App\Tests\Controller\api\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class PartnerControllerTest extends WebTestCase
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
        yield ['GET',   '/api/v1/partners',     Response::HTTP_UNAUTHORIZED]; // 401
    }



    /**
     * @dataProvider provideAuthorizedGet
     */
    public function testAuthorizedGet($url = null, $http_code = null)
    {
        $this->logIn();
        
        $client = $this->client;
        $client->request('GET', $url);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provideAuthorizedGet()
    {
        yield ['/api/v1/partners',      Response::HTTP_OK];             // 200
        yield ['/api/v1/partners/0',    Response::HTTP_BAD_REQUEST];    // 400
        yield ['/api/v1/partners/1',    Response::HTTP_OK];             // 200
    }


    /**
     * @dataProvider provideAuthorizedPost
     */
    public function testAuthorizedPost($http_code = null, $data = null)
    {
        $this->logIn();
        
        $client = $this->client;
        $client->request('POST', '/api/v1/partners', [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provideAuthorizedPost()
    {
        $OK = Response::HTTP_OK;                    // 200
        $BAD_REQUEST = Response::HTTP_BAD_REQUEST;  // 400

        yield [$BAD_REQUEST, json_encode([])];
        yield [$BAD_REQUEST, json_encode([               'surname'=>'surname','email'=>'IS_BAD_EMAIL_COM','active'=>'1','role'=>'1'])];
        yield [$BAD_REQUEST, json_encode(['name'=>'name'                     ,'email'=>'IS_BAD_EMAIL_COM','active'=>'1','role'=>'1'])];
        yield [$BAD_REQUEST, json_encode(['name'=>'name','surname'=>'surname'                            ,'active'=>'1','role'=>'1'])];
        yield [$BAD_REQUEST, json_encode(['name'=>'name','surname'=>'surname','email'=>'IS_BAD_EMAIL_COM'              ,'role'=>'1'])];
        yield [$BAD_REQUEST, json_encode(['name'=>'name','surname'=>'surname','email'=>'IS_BAD_EMAIL_COM','active'=>'1'            ])];
        yield [$BAD_REQUEST, json_encode(['name'=>'name','surname'=>'surname','email'=>'email1@email.com','active'=>'1','role'=>'1'])];
        yield [$OK,          json_encode(['name'=>'name','surname'=>'surname','email'=>'GOOOOD@EMAIL.com','active'=>'1','role'=>'1'])];
    }



    /**
     * @dataProvider provideAuthorizedPatch
     */
    public function testAuthorizedPatch($url = null, $http_code = null, $data = null)
    {
        $this->logIn();
        
        $client = $this->client;
        $client->request('PATCH', $url, [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provideAuthorizedPatch()
    {
        yield ['/api/v1/partners/0', Response::HTTP_BAD_REQUEST, json_encode([])]; // 400
        yield ['/api/v1/partners/1', Response::HTTP_OK, json_encode([])]; // 200
        yield ['/api/v1/partners/1', Response::HTTP_OK, json_encode(['name'=>'nuevo'])]; // 200
        yield ['/api/v1/partners/1', Response::HTTP_OK, json_encode(['surname'=>'nuevo'])]; // 200
        yield ['/api/v1/partners/1', Response::HTTP_OK, json_encode(['email'=>'good@email.com'])]; // 200
        yield ['/api/v1/partners/1', Response::HTTP_OK, json_encode(['email'=>'email1@email.com'])]; // 200
        yield ['/api/v1/partners/1', Response::HTTP_BAD_REQUEST, json_encode(['email'=>'BAD_EMAIL'])]; // 400
        yield ['/api/v1/partners/1', Response::HTTP_BAD_REQUEST, json_encode(['email'=>'email2@email.com'])]; // 400
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
        yield ['/api/v1/partners',      Response::HTTP_BAD_REQUEST];        // 406
        yield ['/api/v1/partners/0',    Response::HTTP_BAD_REQUEST];        // 406
        yield ['/api/v1/partners/1',    Response::HTTP_NOT_ACCEPTABLE];     // 406
        yield ['/api/v1/partners/4',    Response::HTTP_OK];                 // 200
    }
}
