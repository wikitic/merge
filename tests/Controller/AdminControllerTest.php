<?php

namespace App\Tests\Controller;

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
        $session = $this->client->getContainer()->get('session');

        $firewallName = 'BackOffice';
        $firewallContext = 'BackOffice';

        $token = new UsernamePasswordToken('admin', null, $firewallName, ['ROLE_SUPER_ADMIN']);
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }



    /**
     * @dataProvider provide_NON_authenticated
     */
    public function test_NON_authenticated($url = null, $http_code = null)
    {
        $client = $this->client;
        $client->request('GET', $url);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provide_NON_authenticated()
    {
        yield ['/',                 Response::HTTP_OK];      // 200
        /*
        yield ['/login',            Response::HTTP_OK];         // 200
        yield ['/dashboard',        Response::HTTP_FOUND];      // 302
        yield ['/BAD-URL',          Response::HTTP_NOT_FOUND];  // 400
        */
    }


    /**
     * @dataProvider provide_GET_url
     */
    public function test_GET_url($url = null, $http_code = null)
    {
        $this->logIn();

        $client = $this->client;
        $client->request('GET', $url);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provide_GET_url()
    {
        yield ['/',                           Response::HTTP_OK];  // 200
        /*
        yield ['/login',                      Response::HTTP_OK];                 // 200
        yield ['/logout',                     Response::HTTP_FOUND];              // 302
        yield ['/dashboard',                  Response::HTTP_OK];                 // 200

        yield ['/app/admin/list',             Response::HTTP_OK];                 // 200
        yield ['/app/admin/create',           Response::HTTP_NOT_FOUND];          // 404
        yield ['/app/admin/1/show',           Response::HTTP_NOT_FOUND];          // 404
        yield ['/app/admin/1/delete',         Response::HTTP_NOT_FOUND];          // 404
        yield ['/app/admin/1/edit',           Response::HTTP_OK];                 // 200

        yield ['/app/partner/list',           Response::HTTP_OK];                 // 200
        yield ['/app/partner/create',         Response::HTTP_OK];                 // 200
        yield ['/app/partner/1/show',         Response::HTTP_OK];                 // 200
        yield ['/app/partner/1/edit',         Response::HTTP_OK];                 // 200
        yield ['/app/partner/1/delete',       Response::HTTP_OK];                 // 200

        yield ['/app/subscription/list',      Response::HTTP_OK];                 // 200
        yield ['/app/subscription/create',    Response::HTTP_OK];                 // 200
        yield ['/app/subscription/1/show',    Response::HTTP_OK];                 // 200
        yield ['/app/subscription/1/edit',    Response::HTTP_OK];                 // 200
        yield ['/app/subscription/1/delete',  Response::HTTP_OK];                 // 200
        */
    }
}