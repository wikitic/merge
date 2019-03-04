<?php

namespace App\Tests\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response; // https://github.com/symfony/http-foundation/blob/master/Response.php

class CategoryPostTest extends WebTestCase
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
    public function test_postCategories_HTTP_UNAUTHORIZED()
    {
        $client = $this->client;
        $client->request('POST', '/admin/categories');

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());

        $json = json_decode($response->getContent(), true);
        
        $this->assertEquals('Authentication Required', $json['message']);
    }


    /**
     * @AUTHORIZED @ROLE_ADMIN
     * @dataProvider provide_postCategories
     */
    public function test_postCategories($url, $http_code, $data, $message)
    {
        $client = $this->createAuthenticatedClient();
        $client->request('POST', $url, [], [], ['CONTENT_TYPE' => 'application/json'], $data);

        $response = $client->getResponse();
        $this->assertEquals($http_code, $response->getStatusCode());

        $json = json_decode($response->getContent(), true);
        
        $this->assertEquals($message, $json['message']);
    }
    public function provide_postCategories()
    {
        $category = [
            'title' => 'title',
            'alias' => 'categoria-1', // Exist
            'alias' => 'alias',
            'description' => 'description',
            'metatitle' => 'metatitle',
            'metadesc' => 'metadesc',
            'metakey' => 'metakey',
            'metaimage' => 'metaimage',
            'active' => '0'
        ];
        foreach ($category as $k => $v) {
            $aux = $category;
            unset($aux[$k]);
            yield ['/admin/categories',  Response::HTTP_BAD_REQUEST, json_encode($aux), 'Bad request'];
        }
        yield ['/admin/categories',  Response::HTTP_BAD_REQUEST, json_encode([]), 'Bad request'];
    }

    /**
     * @AUTHORIZED @ROLE_ADMIN
     */
    public function test_postCategories_OK()
    {
        $data = [
            'title' => 'title',
            'alias' => 'alias',
            'description' => 'description',
            'metatitle' => 'metatitle',
            'metadesc' => 'metadesc',
            'metakey' => 'metakey',
            'metaimage' => 'metaimage',
            'active' => '0'
        ];

        $client = $this->createAuthenticatedClient();
        $client->request('POST', '/admin/categories', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $category = json_decode($response->getContent(), true);

        $this->assertEquals(7, count($category));
        $this->assertEquals($category['title'], 'title');
        $this->assertEquals($category['alias'], 'alias');
        $this->assertEquals($category['description'], 'description');
        $this->assertEquals($category['metatitle'], 'metatitle');
        $this->assertEquals($category['metadesc'], 'metadesc');
        $this->assertEquals($category['metakey'], 'metakey');
        $this->assertEquals($category['metaimage'], 'metaimage');
    }

}
