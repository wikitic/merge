<?php

namespace App\Tests\Controller\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CourseTest extends WebTestCase
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
        yield ['/v1/courses', Response::HTTP_OK];
        yield ['/v1/courses/categoria-1', Response::HTTP_OK];
        yield ['/v1/courses/categoria-1/curso-1-1', Response::HTTP_OK];
        
        yield ['/v1/courses/BAD-ALIAS-CATEGORY', Response::HTTP_NOT_FOUND];
        yield ['/v1/courses/BAD-ALIAS-CATEGORY/BAD-ALIAS-COURSE', Response::HTTP_NOT_FOUND];
        yield ['/v1/courses/categoria-2', Response::HTTP_NOT_FOUND]; // disabled
        yield ['/v1/courses/categoria-2/curso-2-1', Response::HTTP_NOT_FOUND]; // disabled
        yield ['/v1/courses/categoria-1/BAD-ALIAS-COURSE', Response::HTTP_NOT_FOUND];
        yield ['/v1/courses/categoria-1/curso-1-3', Response::HTTP_NOT_FOUND]; // disabled
    }



    public function test_getCourses()
    {
        $client = static::createClient();
        $client->request('GET', '/v1/courses');

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $courses = json_decode($response->getContent(), true);
        $this->assertEquals(6, count($courses));

        $course = $courses[0];
        $this->assertEquals(5, count($course));
        $this->assertEquals(true, isset($course['title']));
        $this->assertEquals(true, isset($course['alias']));
        $this->assertEquals(true, isset($course['introtext']));
        $this->assertEquals(true, isset($course['image_intro']));
        $this->assertEquals(true, isset($course['level']));
    }



    public function test_getCoursesByCategory()
    {
        $client = static::createClient();
        $client->request('GET', '/v1/courses/categoria-1');

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $courses = json_decode($response->getContent(), true);
        $this->assertEquals(2, count($courses));

        $course = $courses[0];
        $this->assertEquals(5, count($course));
        $this->assertEquals(true, isset($course['title']));
        $this->assertEquals(true, isset($course['alias']));
        $this->assertEquals(true, isset($course['introtext']));
        $this->assertEquals(true, isset($course['image_intro']));
        $this->assertEquals(true, isset($course['level']));
    }



    public function test_getCoursesByCategoryByAlias()
    {
        $client = static::createClient();
        $client->request('GET', '/v1/courses/categoria-1/curso-1-1');

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $course = json_decode($response->getContent(), true);
        $this->assertEquals(9, count($course));
        $this->assertEquals(true, isset($course['title']));
        $this->assertEquals(true, isset($course['alias']));
        $this->assertEquals(true, isset($course['introtext']));
        $this->assertEquals(true, isset($course['image_intro']));
        $this->assertEquals(true, isset($course['level']));
        $this->assertEquals(true, isset($course['metatitle']));
        $this->assertEquals(true, isset($course['metadesc']));
        $this->assertEquals(true, isset($course['metakey']));
        $this->assertEquals(true, isset($course['metaimage']));
    }

}
