<?php

namespace App\Tests\Repository;

use App\Entity\Language;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LanguageRepositoryTest extends KernelTestCase
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

        $this->er = $this->em->getRepository(Language::class);
    }



    public function testGetNextOrdering()
    {
        $next_ordering = $this->er->getNextOrdering();

        $this->assertEquals(4, $next_ordering);
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