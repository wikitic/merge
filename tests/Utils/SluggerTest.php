<?php

namespace App\Tests\Utils;

use App\Utils\Slugger;

use PHPUnit\Framework\TestCase;

class SluggerTest extends TestCase
{
    /**
     * @dataProvider provideSlugify
     */
    public function testSlugify(string $string, string $slug)
    {
        $this->assertSame($slug, Slugger::slugify($string));
    }
    public function provideSlugify()
    {
        yield ['áéíóúüñ', 'aeiouun'];
        yield ['ÁÉÍÓÚÜÑ', 'aeiouun'];
        yield ['Lorem Ipsum', 'lorem-ipsum'];
        yield ['Lorem Ipsum', 'lorem-ipsum'];
        yield ['  Lorem Ipsum  ', 'lorem-ipsum'];
        yield [' lOrEm  iPsUm  ', 'lorem-ipsum'];
        yield ['!Lorem Ipsum!', 'lorem-ipsum'];
        yield ['lorem-ipsum', 'lorem-ipsum'];
    }
}