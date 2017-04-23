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

}