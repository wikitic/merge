<?php

namespace App\Tests\Controller\api\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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
        yield ['GET',   '/api/v1/login',    Response::HTTP_METHOD_NOT_ALLOWED                                                               ];  // 405
        
        yield ['POST',  '/api/v1/login',    Response::HTTP_BAD_REQUEST                                                                      ];  // 400
        yield ['POST',  '/api/v1/login',    Response::HTTP_BAD_REQUEST,         json_encode([])                                             ];  // 400
        yield ['POST',  '/api/v1/login',    Response::HTTP_BAD_REQUEST,         json_encode(['username'=>'BAD'])                            ];  // 400
        yield ['POST',  '/api/v1/login',    Response::HTTP_BAD_REQUEST,         json_encode([                  'password'=>'BAD'])          ];  // 400
        yield ['POST',  '/api/v1/login',    Response::HTTP_UNAUTHORIZED,        json_encode(['username'=>'BAD','password'=>'BAD'])          ];  // 401

        yield ['POST',  '/api/v1/login',    Response::HTTP_OK,                  json_encode(['username'=>'admin','password'=>'pa$$w0rd'])   ];  // 200

        yield ['POST',  '/api/v1/logout',   Response::HTTP_FOUND                                                                            ];  // 302
    }
}
