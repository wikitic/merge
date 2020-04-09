<?php

namespace App\Tests\Controller\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CategoryTest extends WebTestCase
{
    /**
     * @dataProvider provide_URLS
     */
    public function test_URLS(string $url, string $http_code)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $response = $client->getResponse();
        $this->assertSame('application/json', $response->headers->get('content-type'));
        $this->assertEquals($http_code, $response->getStatusCode());
    }
    public function provide_URLS()
    {
        yield ['/v1/categories', Response::HTTP_OK];
        yield ['/v1/categories/categoria-1', Response::HTTP_OK];
        yield ['/v1/categories/BAD-ALIAS', Response::HTTP_NOT_FOUND];
        yield ['/v1/categories/categoria-2', Response::HTTP_NOT_FOUND]; // disabled
    }



    public function test_getCategories()
    {
        $client = static::createClient();
        $client->request('GET', '/v1/categories');

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $categories = json_decode($response->getContent(), true);
        $this->assertEquals(3, count($categories));

        $category_1 = $categories[0];
        $this->assertEquals(3, count($category_1));
        $this->assertEquals($category_1['title'], 'Categoría 1');
        $this->assertEquals($category_1['alias'], 'categoria-1');
        $this->assertEquals($category_1['description'], 'Descripción 1');
    }



    public function test_getCategoriesByAlias()
    {
        $client = static::createClient();
        $client->request('GET', '/v1/categories/categoria-1');

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $category_1 = json_decode($response->getContent(), true);

        $this->assertEquals(7, count($category_1));
        $this->assertEquals($category_1['title'], 'Categoría 1');
        $this->assertEquals($category_1['alias'], 'categoria-1');
        $this->assertEquals($category_1['description'], 'Descripción 1');
        $this->assertEquals($category_1['metatitle'], 'Meta título de la categoría');
        $this->assertEquals($category_1['metadesc'], 'Meta descripción de la categoría 1');
        $this->assertEquals($category_1['metakey'], 'meta, palabras, categoría');
        $this->assertEquals($category_1['metaimage'], 'categoria.png');
    }

}
