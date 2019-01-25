<?php

namespace App\Tests\Repository;

use App\Entity\Language;
use App\Entity\Module;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ModuleRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var \Doctrine\ORM\ServiceEntityRepository
     */
    private $er;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()->get('doctrine')->getManager();

        $this->er = $this->em->getRepository(Module::class);
    }


    
    /**
     * @dataProvider provideGetNextOrdering
     */
    public function testGetNextOrdering(string $alias = '', int $next = 0)
    {
        $language = $this->em->getRepository(Language::class)->findOneBy(['alias' => $alias]);

        $next_ordering = $this->er->getNextOrdering($language);

        $this->assertEquals($next, $next_ordering);
    }
    public function provideGetNextOrdering()
    {
        yield ['language-1', 4];
        yield ['language-2', 3];
        yield ['language-3', 2];
    }


    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}