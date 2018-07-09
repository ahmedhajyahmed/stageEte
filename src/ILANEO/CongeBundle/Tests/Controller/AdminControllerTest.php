<?php

namespace ILANEO\CongeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testVisualisation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/visualisation');
    }

}
