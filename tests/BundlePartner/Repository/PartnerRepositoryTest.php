<?php

namespace App\Tests\BundlePartner\Repository;

use App\BundlePartner\Entity\Partner;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PartnerRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var \Doctrine\ORM\ServiceEntityRepository
     */
    private $erp;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()->get('doctrine')->getManager('partner');

        $this->erp = $this->em->getRepository(Partner::class, 'partner');
    }



    /**
     * @dataProvider provideSerialize
     */
    public function testSerialize(string $code, bool $op)
    {
        $partner = $this->erp->findOneBy(['code' => $code]);
        $string = $this->erp->serialize($partner);

        $this->assertEquals(getType($string), 'string');

        $this->assertEquals(strpos($string, '"code"'), $op);
        $this->assertEquals(strpos($string, '"name"'), $op);
        $this->assertEquals(strpos($string, '"surname"'), $op);
        $this->assertEquals(strpos($string, '"email"'), $op);
        $this->assertEquals(strpos($string, '"fullName"'), $op);
        $this->assertEquals(strpos($string, '"roles"'), $op);
        $this->assertEquals(strpos($string, '"subscriptions"'), $op);

        $this->assertEquals(strpos($string, '"id"'), false);
        $this->assertEquals(strpos($string, '"role"'), false);
        $this->assertEquals(strpos($string, '"active"'), false);
        $this->assertEquals(strpos($string, '"cdate"'), false);
        $this->assertEquals(strpos($string, '"mdate"'), false);
        $this->assertEquals(strpos($string, '"username"'), false);
    }
    public function provideSerialize()
    {
        yield ['BAD-CODE', false];
        yield ['AAAAAA', true];
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