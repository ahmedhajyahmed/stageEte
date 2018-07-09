<?php

namespace ILANEO\CongeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class employeControllerTest extends WebTestCase
{
    public function testConnexion()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

}
