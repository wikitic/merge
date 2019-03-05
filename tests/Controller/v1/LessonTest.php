<?php

namespace App\Tests\Controller\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LessonTest extends WebTestCase
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
        yield ['/v1/lessons', Response::HTTP_NOT_FOUND];
        yield ['/v1/lessons/curso-1-1', Response::HTTP_OK];
        yield ['/v1/lessons/curso-1-1/leccion-1-1-1', Response::HTTP_OK];
        
        yield ['/v1/lessons/BAD-ALIAS', Response::HTTP_NOT_FOUND];
        yield ['/v1/lessons/BAD-ALIAS/BAD-ALIAS', Response::HTTP_NOT_FOUND];
        yield ['/v1/lessons/curso-1-3', Response::HTTP_NOT_FOUND]; // disabled
        yield ['/v1/lessons/curso-1-3/leccion-1-1-1', Response::HTTP_NOT_FOUND]; // disabled
        yield ['/v1/lessons/curso-1-1/BAD-ALIAS', Response::HTTP_NOT_FOUND];
        yield ['/v1/lessons/curso-1-1/leccion-1-1-3', Response::HTTP_NOT_FOUND]; // disabled
    }



    public function test_getLessonsByCourse()
    {
        $client = static::createClient();
        $client->request('GET', '/v1/lessons/curso-1-1');

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $lessons = json_decode($response->getContent(), true);
        $this->assertEquals(3, count($lessons));

        $lesson = $lessons[0];
        $this->assertEquals(2, count($lesson));
        $this->assertEquals(true, isset($lesson['title']));
        $this->assertEquals(true, isset($lesson['alias']));
    }



    public function test_getLessonsByCourseByAlias()
    {
        $client = static::createClient();
        $client->request('GET', '/v1/lessons/curso-1-1/leccion-1-1-1');

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $lesson = json_decode($response->getContent(), true);
        $this->assertEquals(5, count($lesson));
        $this->assertEquals(true, isset($lesson['title']));
        $this->assertEquals(true, isset($lesson['alias']));
        $this->assertEquals(true, isset($lesson['description']));
        $this->assertEquals(true, isset($lesson['video']));
        $this->assertEquals(true, isset($lesson['files']));
    }
}
