<?php

namespace App\Tests\Controller\admin\Category;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response; // https://github.com/symfony/http-foundation/blob/master/Response.php

class DeleteTest extends WebTestCase
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
     * @dataProvider provide_deleteCategoriesBy
     */
    public function test_deleteCategoriesBy($url, $http_code, $message)
    {
        $client = $this->createAuthenticatedClient();
        $client->request('DELETE', $url);

        $response = $client->getResponse();
        $this->assertSame('application/json', $response->headers->get('content-type'));
        $this->assertEquals($http_code, $response->getStatusCode());

        $json = json_decode($response->getContent(), true);
        $this->assertEquals($message, $json['message']);
    }
    public function provide_deleteCategoriesBy()
    {
        yield ['/admin/categories/BAD-SALT', Response::HTTP_NOT_FOUND, 'Not found'];
        yield ['/admin/categories/GOOD-SALT-1', Response::HTTP_NOT_ACCEPTABLE, 'Not acceptable'];
        yield ['/admin/categories/GOOD-SALT-2', Response::HTTP_NOT_ACCEPTABLE, 'Not acceptable'];
        yield ['/admin/categories/GOOD-SALT-3', Response::HTTP_NOT_ACCEPTABLE, 'Not acceptable'];
        yield ['/admin/categories/GOOD-SALT-4', Response::HTTP_OK, 'Successful'];
    }
}
