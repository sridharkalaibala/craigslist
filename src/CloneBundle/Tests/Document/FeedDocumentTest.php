<?php
namespace CloneBundle\Tests\Document;

use Doctrine\ODM\MongoDB\DocumentManager;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use CloneBundle\Service\Download;
use CloneBundle\Document\Feed;
use Symfony\Component\Config\Definition\Exception\Exception;

class FeedDocumentTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ODM\MongoDB\DocumentManager
     */
    private $dm;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->dm = static::$kernel->getContainer()
            ->get('doctrine_mongodb')
            ->getManager();
    }


    public function testInsert()
    {
        $feedDocument = new Feed();
        $feedDocument->setTitle('test title');
        $feedDocument->setMainCategory('Housing');
        $feedDocument->setSubCategory('apts / housing');
        $feedDocument->setDetails('Test Details');
        $feedDocument->setLocation('Tokyo');
        $feedDocument->setEmail('test@test.com');
        $feedDocument->setContact('9999999');
        $feed = $this->dm->persist($feedDocument);
        $this->dm->flush();
        $this->assertEquals('test title', $feedDocument->getTitle());
        $this->assertEquals('Housing', $feedDocument->getMainCategory());
        $this->assertEquals('apts / housing', $feedDocument->getSubCategory());
        $this->assertEquals('Test Details', $feedDocument->getDetails());
        $this->assertEquals('Tokyo', $feedDocument->getLocation());
        $this->assertEquals('test@test.com', $feedDocument->getEmail());
        $this->assertEquals('9999999', $feedDocument->getContact());
    }

}