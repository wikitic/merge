<?php

namespace App\Tests\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response; // https://github.com/symfony/http-foundation/blob/master/Response.php

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

    protected function createAuthenticatedClient()
    {
        $admin = [
            'username' => 'admin',
            'aud' => 'admin'
        ];
        $token = self::$kernel->getContainer()
            ->get('lexik_jwt_authentication.encoder')
            ->encode($admin);

            
        $client = $this->client;
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $token));
        return $client;
    }



    /**
     * @dataProvider provide_non_authenticated
     */
    public function test_non_authenticated(string $method, string $url)
    {
        $client = $this->client;
        $client->request($method, $url);

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());

        $json = json_decode($response->getContent(), true);
        
        $this->assertEquals('Authentication Required', $json['message']);
    }
    public function provide_non_authenticated()
    {
        yield ['GET', '/admin/categories'];
        yield ['GET', '/admin/categories/X'];
        yield ['POST', '/admin/categories'];
        yield ['PATCH', '/admin/categories/X'];
        yield ['PUT', '/admin/categories/X'];
        yield ['DELETE', '/admin/categories/X'];
    }



    /**
     * @dataProvider provide_authenticated
     */
    public function test_authenticated(string $method, string $url, string $http_code)
    {
        $client = $this->createAuthenticatedClient();
        $client->request($method, $url);

        $response = $client->getResponse();
        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provide_authenticated()
    {
        yield ['GET', '/admin/categories', Response::HTTP_OK];
        //yield ['GET', '/admin/categories/X', Response::HTTP_OK];
        //yield ['POST', '/admin/categories', Response::HTTP_OK];
        //yield ['PATCH', '/admin/categories/X', Response::HTTP_OK];
        //yield ['PUT', '/admin/categories/X', Response::HTTP_OK];
        //yield ['DELETE', '/admin/categories/X', Response::HTTP_OK];
    }

    

}
