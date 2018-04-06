<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    /**
     * Check if initial page is functional.
     *
     * @return void
     */
    public function testInicialPageIsSuccessful()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * Check if form search is functional.
     *
     * @return void
     */
    public function testSearchFunction()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/');

        $form = $crawler->selectButton('Pesquisar!')->form();

        // Set search value
        $form['default[q]'] = 'ClickBus';

        // Submit the form
        $crawler = $client->submit($form);

        // Check if form search is ok.
        $this->assertTrue(
            $crawler->filter('html:contains("Resultado da pesquisa (Total: ")')->count() > 0
        );
    }

    /**
     * Check if pagination search is functional.
     *
     * @return void
     */
    public function testPaginationFunction()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/');

        $form = $crawler->selectButton('Pesquisar!')->form();

        // Set search value. The "teste" value is a good parameter, because it is
        // return many results.
        $form['default[q]'] = 'Teste';

        // Submit the form
        $crawler = $client->submit($form);

        // Search link for go to last page of results.
        $link = $crawler
            ->filter('a:contains(">>")')
            ->eq(0)
            ->link()
        ;

        // Click (go) to the last page
        $crawler = $client->click($link);

        $this->assertTrue(
            $crawler->filter('html:contains("Resultado da pesquisa (Total: ")')->count() > 0
        );
    }
}

?>
