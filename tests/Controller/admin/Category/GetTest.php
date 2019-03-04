<?php

namespace App\Tests\Controller\admin\Category;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response; // https://github.com/symfony/http-foundation/blob/master/Response.php

class GetTest extends WebTestCase
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



    public function test_getCategories()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/admin/categories');

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $categories = json_decode($response->getContent(), true);
        $this->assertEquals(4, count($categories));
    }



    /**
     * @dataProvider provide_getCategoriesByAlias
     */
    public function test_getCategoriesByAlias(string $url, string $http_code)
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', $url);

        $response = $client->getResponse();
        $this->assertEquals($http_code, $response->getStatusCode());

        $json = json_decode($response->getContent(), true);
    }
    public function provide_getCategoriesByAlias()
    {
        yield ['/admin/categories/BAD-ALIAS', Response::HTTP_NOT_FOUND];
        yield ['/admin/categories/categoria-1', Response::HTTP_OK];
    }
}
