<?php

namespace ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testGetlatest()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/v1/posts');
    }

    public function testGetlatestpaginated()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/v1/posts/{page}');
    }

    public function testGetpostdetails()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/v1/post/{slug}');
    }

}
