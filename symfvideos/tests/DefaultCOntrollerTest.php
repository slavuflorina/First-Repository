<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultCOntrollerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
       /* $crawler = $client->request('GET', '/event');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Subview included.');

        // $this->assertGreaterThan(0, $crawler->filter('h1.class')->count());
        $this->assertCount(1, $crawler->filter('h1')); */
       /* $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        ); */
      /*  $this->assertContains('foo', $client->getResponse()->getContent());
        $this->assertRegExp('/foo(bar)?/', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
        $this->assertTrue($client->getResponse()->isNotFound());
        $this->assertEquals(
            200, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );
        $this->assertTrue(
            $client->getResponse()->isRedirect('/demo/contact')
        // if the redirection URL was generated as an absolute URL
        // $client->getResponse()->isRedirect('http://localhost/demo/contact')
        );
        $link = $crawler
            ->filter('a:contains("awesome link")')
            ->link();

        $crawler = $client->click($link);
        $this->assertContains('Remember me', $client->getResponse()->getContent()); */
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Sign in')->form();
        $form['email'] = 'slavuflorina@yahoo.com';
        $form['password'] = '1234';

        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertEquals(1, $crawler->filter('a:contains("logout")')->count());
    }
}
