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
        yield ['/admin',                  Response::HTTP_FOUND];  // 302
        yield ['/admin/login',            Response::HTTP_OK];     // 200
        yield ['/admin/dashboard',        Response::HTTP_FOUND];  // 302
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
        yield ['/admin',                    Response::HTTP_MOVED_PERMANENTLY];  // 301
        yield ['/admin/login',              Response::HTTP_FOUND];              // 302
        yield ['/admin/logout',             Response::HTTP_FOUND];              // 302
        yield ['/admin/dashboard',          Response::HTTP_OK];                 // 200
    }
}