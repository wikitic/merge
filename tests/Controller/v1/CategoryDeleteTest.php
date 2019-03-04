<?php

namespace App\Tests\Controller\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response; // https://github.com/symfony/http-foundation/blob/master/Response.php

class CategoryDeleteTest extends WebTestCase
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
     * HTTP_UNAUTHORIZED
     */
    public function test_deleteCategoriesByAlias_HTTP_UNAUTHORIZED()
    {
        $client = $this->client;
        $client->request('DELETE', '/v1/categories/X');

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());

        $json = json_decode($response->getContent(), true);
        
        $this->assertEquals('Authentication Required', $json['message']);
    }


    /**
     * @AUTHORIZED @ADMIN
     * @dataProvider provide_deleteCategoriesByAlias
     */
    public function test_deleteCategoriesByAlias($url, $http_code, $message)
    {
        $client = $this->createAuthenticatedClient();
        $client->request('DELETE', $url);

        $response = $client->getResponse();
        $this->assertEquals($http_code, $response->getStatusCode());

        $json = json_decode($response->getContent(), true);
        
        $this->assertEquals($message, $json['message']);
    }
    public function provide_deleteCategoriesByAlias()
    {
        yield ['/v1/categories/BAD', Response::HTTP_NOT_FOUND, 'Not found'];
        yield ['/v1/categories/1', Response::HTTP_NOT_ACCEPTABLE, 'Not acceptable'];
        yield ['/v1/categories/2', Response::HTTP_NOT_ACCEPTABLE, 'Not acceptable'];
        yield ['/v1/categories/3', Response::HTTP_NOT_ACCEPTABLE, 'Not acceptable'];
        yield ['/v1/categories/4', Response::HTTP_OK, 'successful'];
    }
}
