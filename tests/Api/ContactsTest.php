<?php

namespace IanOlson\Insightly\Tests\Api;

use IanOlson\Insightly\Tests\FunctionalTestCase;
use Illuminate\Support\Arr;

class ContactsTest extends FunctionalTestCase
{
    /**
     * Contact ID created during tests.
     *
     * @var int
     */
    protected $contactId;

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();
        if (isset($this->contactId)) {
            $this->client->contacts()->delete($this->contactId);
        }
    }

    /**
     * @test
     */
    public function it_can_create_a_new_contact()
    {
        $FIRST_NAME = $this->faker->firstName;
        $LAST_NAME = $this->faker->lastName;

        $contact = $this->client->contacts()->create(compact('FIRST_NAME', 'LAST_NAME'));

        $this->contactId = Arr::get($contact, 'CONTACT_ID');

        $this->assertSame($FIRST_NAME, Arr::get($contact, 'FIRST_NAME'));
        $this->assertSame($LAST_NAME, Arr::get($contact, 'LAST_NAME'));
    }

    /**
     * @test
     */
    public function it_can_find_an_existing_contact()
    {
        $FIRST_NAME = $this->faker->firstName;
        $LAST_NAME = $this->faker->lastName;

        $contact = $this->client->contacts()->create(compact('FIRST_NAME', 'LAST_NAME'));

        $this->contactId = Arr::get($contact, 'CONTACT_ID');

        $contact = $this->client->contacts()->find($this->contactId);

        $this->assertSame($FIRST_NAME, Arr::get($contact, 'FIRST_NAME'));
        $this->assertSame($LAST_NAME, Arr::get($contact, 'LAST_NAME'));
    }
}