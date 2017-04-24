<?php

namespace CloneBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testPost()
    {
        $client = static::createClient();

        $client->request('GET', '/post');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testCreate()
    {
        $client = static::createClient();

        $client->request('GET', '/create');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testList()
    {
        $client = static::createClient();

        $client->request('GET', '/list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    public function testGetData()
    {
        $client = static::createClient();

        $client->request('GET', '/getData');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


}
