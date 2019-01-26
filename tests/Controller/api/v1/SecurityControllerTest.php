<?php

namespace App\Tests\Controller\api\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{
    /**
     * @dataProvider provideAuthentication
     */
    public function testAuthentication($method = null, $url = null, $http_code = null, $data = null)
    {
        $client = static::createClient();
        $client->request($method, $url, [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provideAuthentication()
    {
        $HTTP_METHOD_NOT_ALLOWED = Response::HTTP_METHOD_NOT_ALLOWED; // 405
        $HTTP_BAD_REQUEST = Response::HTTP_BAD_REQUEST;  // 400
        $HTTP_UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;  // 401
        $HTTP_OK = Response::HTTP_OK;  // 200
        $HTTP_FOUND = Response::HTTP_FOUND;  // 302

        yield ['GET', '/api/v1/login', $HTTP_METHOD_NOT_ALLOWED];
        
        yield ['POST','/api/v1/login', $HTTP_BAD_REQUEST];
        yield ['POST','/api/v1/login', $HTTP_BAD_REQUEST, json_encode([])]; 
        yield ['POST','/api/v1/login', $HTTP_BAD_REQUEST, json_encode(['email'=>'BAD'])];
        yield ['POST','/api/v1/login', $HTTP_BAD_REQUEST, json_encode(['password'=>'BAD'])];
        yield ['POST','/api/v1/login', $HTTP_UNAUTHORIZED,json_encode(['email'=>'BAD','password'=>'BAD'])];
        yield ['POST','/api/v1/login', $HTTP_OK, json_encode(['email'=>'email1@email.com','password'=>'AAAAAA'])];
        
        yield ['GET', '/api/v1/logout',$HTTP_FOUND];
    }


    public function testAuthenticationResponse()
    {
        $data = json_encode(['email'=>'email1@email.com','password'=>'AAAAAA']);

        $client = static::createClient();
        $client->request('POST', '/api/v1/login', [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $content = $response->getContent();

        $data = json_decode($content, true);

        $this->assertEquals(count($data), 7); //code,name,surname,email,fullName,roles,subscriptions
        $this->assertEquals(count($data['subscriptions']), 5);
        $this->assertEquals(count($data['subscriptions'][0]), 4); //inDate,outDate,info,price
        $this->assertEquals($data['code'], 'AAAAAA');
        $this->assertEquals($data['email'], 'email1@email.com');
    }
}
