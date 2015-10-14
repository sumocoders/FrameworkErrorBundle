<?php
namespace SumoCoders\FrameworkErrorBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Bundle\FrameworkBundle\Client;

class ExceptionControllerTest extends WebTestCase
{
    public function test404Page()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/non-existing-path');

        $this->assertErrorPage($client, $crawler, 404, 'Page not found.');
    }

    public function testStandardException()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/exception/standard');

        $this->assertErrorPage($client, $crawler, 500);
    }

    /**
     * Check if a page is a real error page
     *
     * @param Client  $client
     * @param Crawler $crawler
     * @param string  $code
     * @param string  $message
     */
    private function assertErrorPage(
        Client $client,
        Crawler $crawler,
        $code,
        $message = 'Something went wrong.'
    ) {
        // check if the code is set correctly
        $this->assertEquals($code, $client->getResponse()->getStatusCode());

        // check if the title is ok
        $this->assertEquals(
            sprintf('%1$s: %2$s', $code, $message),
            $crawler->filter('title')->html()
        );

        // check if no-index is set
        $this->assertEquals(
            'noindex, nofollow',
            $crawler->filter('meta[name=robots]')->attr('content')
        );

        // check if the message is ok
        $this->assertEquals(
            sprintf('%1$s: %2$s', $code, $message),
            $crawler->filter('#content h1')->html()
        );
    }
}
