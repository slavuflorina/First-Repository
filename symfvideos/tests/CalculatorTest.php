<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Services\Calculator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorTest extends WebTestCase
{
    /**
     *@dataProvider provideUrls
     */
    public function testSomething($url)
    {
      /*  $calculator = new Calculator();
        $result = $calculator->add(1,9);
        $this->assertEquals(10, $result); */

        $client = static::createClient();
        $crawler = $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());

    }
    public function provideUrls()
    {
        return [
            ['/event'],
            ['/login']
        ];
    }

}
