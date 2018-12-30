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
        $this->client = static::createClient();
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
        yield ['GET',   '/api/v1/partners',    Response::HTTP_UNAUTHORIZED]; // 401
    }



    /**
     * @dataProvider provideAuthorized
     */
    public function testAuthorized($method = null, $url = null, $http_code = null, $data = null)
    {
        $this->logIn();
        
        $client = $this->client;
        $client->request($method, $url, [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provideAuthorized()
    {
        yield ['GET',   '/api/v1/partners',    Response::HTTP_OK];      // 200
    }
}
