<?php

namespace IanOlson\Insightly\Tests\Api;

use IanOlson\Insightly\Tests\FunctionalTestCase;

class CurrenciesTest extends FunctionalTestCase
{
    /**
     * @test
     */
    public function it_can_retrieve_all_contacts()
    {
        $currencies = $this->client->currencies()->all();

        $this->assertNotEmpty($currencies);
        $this->assertInternalType('array', $currencies);
    }
}