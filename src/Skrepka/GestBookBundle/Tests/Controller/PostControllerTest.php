<?php

namespace Skrepka\GestBookBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{

    public function testIndexAction()
    {
        // Create a new client to browse the application
        $client = static::createClient();
        $crawler = $client->request('GET', '/post/');
        $this->assertTrue($client->getResponse()->getStatusCode() === 200);
    }

    public function testNewAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/post/');
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'posttype[name]'  => 'Test Name',
            'posttype[email]'  => 'test@email.com',
            'posttype[description]'  => 'Test Description',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertTrue($crawler->filter('td:contains("Test Name")')->count() > 0);
    }

    public function testEditAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/post/');
        $crawler = $client->click($crawler->selectLink('edit')->link());

        $form = $crawler->selectButton('Edit')->form(array(
            'posttype[name]'  => 'Foo Test Edit',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertTrue($crawler->filter('[value="Foo Test Edit"]')->count() > 0);
    }

    public function testDeleteAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/post/');
        $crawler = $client->click($crawler->selectLink('edit')->link());

        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the document has been delete on the list
        $this->assertNotRegExp('/Foo Test Edit/', $client->getResponse()->getContent());

    }
}
