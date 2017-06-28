<?php

namespace ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentControllerControllerTest extends WebTestCase
{
    public function testGetpostcomments()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'get_post_comments');
    }

}
