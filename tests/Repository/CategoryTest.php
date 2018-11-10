<?php

namespace App\Tests\Repository;

use App\Entity\Category;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CategoryTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $er;


    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()->get('doctrine')->getManager();
        $this->er = $this->em->getRepository(Category::class);
    }



    public function test_getLastOrdering()
    {
        $categories     = $this->er->findAll();
        $last_ordering  = $this->er->getLastOrdering();

        $this->assertEquals(count($categories), $last_ordering);
    }

    public function test_getNextOrdering()
    {
        $categories     = $this->er->findAll();
        $next_ordering  = $this->er->getNextOrdering();

        $this->assertEquals(count($categories) + 1, $next_ordering);
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
