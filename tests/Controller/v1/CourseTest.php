<?php

namespace App\Tests\Controller\v1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CourseTest extends WebTestCase
{
    public function test_getCourses()
    {
        $client = static::createClient();
        $client->request('GET', '/v1/courses');

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $courses = json_decode($response->getContent(), true);
        $this->assertEquals(7, count($courses));

        $course_1 = $courses[0];
        $this->assertEquals(5, count($course_1));
        $this->assertEquals($course_1['title'], 'Curso 1 1');
        $this->assertEquals($course_1['alias'], 'curso-1-1');
        $this->assertEquals($course_1['introtext'], 'Descripción 1');
        $this->assertEquals($course_1['image_intro'], 'curso.png');
        $this->assertEquals($course_1['level'], 'Nivel 1');
    }





}
