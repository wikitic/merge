<?php

namespace App\Tests\Controller\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response; // https://github.com/symfony/http-foundation/blob/master/Response.php

class CategoryPatchTest extends WebTestCase
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
    public function test_patchCategories_HTTP_UNAUTHORIZED()
    {
        $client = $this->client;
        $client->request('PATCH', '/v1/categories/X');

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());

        $json = json_decode($response->getContent(), true);
        
        $this->assertEquals('Authentication Required', $json['message']);
    }


    /**
     * @AUTHORIZED @ROLE_ADMIN
     * @dataProvider provide_patchCategories
     */
    public function test_patchCategories($url, $http_code, $data, $message)
    {
        $client = $this->createAuthenticatedClient();
        $client->request('PATCH', $url, [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $this->assertEquals($http_code, $response->getStatusCode());

        $json = json_decode($response->getContent(), true);
        
        $this->assertEquals($message, $json['message']);
    }
    public function provide_patchCategories()
    {
        yield ['/v1/categories/BAD',  Response::HTTP_NOT_FOUND, json_encode([]), 'Not found'];
        yield ['/v1/categories/1',  Response::HTTP_BAD_REQUEST, json_encode(['alias'=>'categoria-2']), 'Bad request'];
    }

    /**
     * @AUTHORIZED @ROLE_ADMIN
     * @dataProvider provide_patchCategories_OK
     */
    public function test_patchCategories_OK($url, $http_code, $data)
    {
        $client = $this->createAuthenticatedClient();
        $client->request('PATCH', $url, [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $this->assertEquals($http_code, $response->getStatusCode());

        $category = json_decode($response->getContent(), true);
        
        $this->assertEquals(7, count($category));

        $data = json_decode($data);
        $k = key($data);
        $v = $data->$k;
        $this->assertEquals($category[$k], $v);


    }
    public function provide_patchCategories_OK()
    {
        yield ['/v1/categories/1',  Response::HTTP_OK, json_encode(['title'=>'title'])];
        yield ['/v1/categories/1',  Response::HTTP_OK, json_encode(['alias'=>'alias'])];
        yield ['/v1/categories/1',  Response::HTTP_OK, json_encode(['description'=>'description'])];
        yield ['/v1/categories/1',  Response::HTTP_OK, json_encode(['metatitle'=>'metatitle'])];
        yield ['/v1/categories/1',  Response::HTTP_OK, json_encode(['metadesc'=>'metadesc'])];
        yield ['/v1/categories/1',  Response::HTTP_OK, json_encode(['metakey'=>'metakey'])];
        yield ['/v1/categories/1',  Response::HTTP_OK, json_encode(['metaimage'=>'metaimage'])];
        // yield ['/v1/categories/1',  Response::HTTP_OK, json_encode(['active'=>'1'])];
    }

}
