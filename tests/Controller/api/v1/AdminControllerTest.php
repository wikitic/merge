<?php

namespace App\Tests\Controller\api\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AdminControllerTest extends WebTestCase
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
        yield ['GET',       '/api/v1/admins',    Response::HTTP_NOT_FOUND];     // 404
        yield ['POST',      '/api/v1/admins',    Response::HTTP_NOT_FOUND];     // 404
        yield ['PUT',       '/api/v1/admins',    Response::HTTP_NOT_FOUND];     // 404
        yield ['PATCH',     '/api/v1/admins',    Response::HTTP_NOT_FOUND];     // 404
        yield ['DELETE',    '/api/v1/admins',    Response::HTTP_NOT_FOUND];     // 404

        yield ['GET',       '/api/v1/admins/0',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405
        yield ['POST',      '/api/v1/admins/0',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405
        yield ['PUT',       '/api/v1/admins/0',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405
        yield ['PATCH',     '/api/v1/admins/0',    Response::HTTP_UNAUTHORIZED];           // 401
        yield ['DELETE',    '/api/v1/admins/0',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405

        yield ['GET',       '/api/v1/admins/1',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405
        yield ['POST',      '/api/v1/admins/1',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405
        yield ['PUT',       '/api/v1/admins/1',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405
        yield ['PATCH',     '/api/v1/admins/1',    Response::HTTP_UNAUTHORIZED];           // 401
        yield ['DELETE',    '/api/v1/admins/1',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405

        yield ['GET',       '/api/v1/admins/BAD',    Response::HTTP_NOT_FOUND];     // 405
        yield ['POST',      '/api/v1/admins/BAD',    Response::HTTP_NOT_FOUND];     // 405
        yield ['PUT',       '/api/v1/admins/BAD',    Response::HTTP_NOT_FOUND];     // 405
        yield ['PATCH',     '/api/v1/admins/BAD',    Response::HTTP_NOT_FOUND];     // 400
        yield ['DELETE',    '/api/v1/admins/BAD',    Response::HTTP_NOT_FOUND];     // 405
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
        yield ['GET',       '/api/v1/admins',    Response::HTTP_NOT_FOUND];     // 404
        yield ['POST',      '/api/v1/admins',    Response::HTTP_NOT_FOUND];     // 404
        yield ['PUT',       '/api/v1/admins',    Response::HTTP_NOT_FOUND];     // 404
        yield ['PATCH',     '/api/v1/admins',    Response::HTTP_NOT_FOUND];     // 404
        yield ['DELETE',    '/api/v1/admins',    Response::HTTP_NOT_FOUND];     // 404

        yield ['GET',       '/api/v1/admins/0',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405
        yield ['POST',      '/api/v1/admins/0',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405
        yield ['PUT',       '/api/v1/admins/0',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405
        yield ['PATCH',     '/api/v1/admins/0',    Response::HTTP_BAD_REQUEST];            // 400
        yield ['DELETE',    '/api/v1/admins/0',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405

        yield ['GET',       '/api/v1/admins/1',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405
        yield ['POST',      '/api/v1/admins/1',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405
        yield ['PUT',       '/api/v1/admins/1',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405
        yield ['PATCH',     '/api/v1/admins/1',    Response::HTTP_OK];                     // 200
        yield ['DELETE',    '/api/v1/admins/1',    Response::HTTP_METHOD_NOT_ALLOWED];     // 405

        yield ['GET',       '/api/v1/admins/BAD',    Response::HTTP_NOT_FOUND];     // 405
        yield ['POST',      '/api/v1/admins/BAD',    Response::HTTP_NOT_FOUND];     // 405
        yield ['PUT',       '/api/v1/admins/BAD',    Response::HTTP_NOT_FOUND];     // 405
        yield ['PATCH',     '/api/v1/admins/BAD',    Response::HTTP_NOT_FOUND];     // 400
        yield ['DELETE',    '/api/v1/admins/BAD',    Response::HTTP_NOT_FOUND];     // 405
    }
}
