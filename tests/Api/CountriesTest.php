<?php

namespace IanOlson\Insightly\Tests\Api;

use IanOlson\Insightly\Tests\FunctionalTestCase;

class CountriesTest extends FunctionalTestCase
{
    /**
     * @test
     *
     * @group integration
     */
    public function it_can_retrieve_all_contacts()
    {
        $countries = $this->client->countries()->all();

        $this->assertNotEmpty($countries);
        $this->assertInternalType('array', $countries);
    }
}