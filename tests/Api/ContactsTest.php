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
     *
     * @group integration
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
     *
     * @group integration
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

    /**
     * @test
     *
     * @group integration
     *
     * @expectedException \IanOlson\Insightly\Exception\NotFoundException
     */
    public function it_will_throw_an_exception_when_searching_for_a_non_existing_contact()
    {
        $this->client->contacts()->find(time());
    }

    /**
     * @test
     *
     * @group integration
     */
    public function it_can_update_an_existing_contact()
    {
        $FIRST_NAME = $this->faker->firstName;
        $LAST_NAME = $this->faker->lastName;
        $ORIGINAL_FIRST_NAME = $FIRST_NAME;
        $ORIGINAL_LAST_NAME = $LAST_NAME;

        $contact = $this->client->contacts()->create(compact('FIRST_NAME', 'LAST_NAME'));

        $this->contactId = Arr::get($contact, 'CONTACT_ID');

        $FIRST_NAME = $this->faker->firstName;
        $LAST_NAME = $this->faker->lastName;

        $contact = $this->client->contacts()->update($this->contactId, compact('FIRST_NAME', 'LAST_NAME'));

        $this->assertSame($FIRST_NAME, Arr::get($contact, 'FIRST_NAME'));
        $this->assertSame($LAST_NAME, Arr::get($contact, 'LAST_NAME'));
        $this->assertNotEquals($ORIGINAL_FIRST_NAME, Arr::get($contact, 'FIRST_NAME'));
        $this->assertNotEquals($ORIGINAL_LAST_NAME, Arr::get($contact, 'LAST_NAME'));
    }

    /**
     * @test
     *
     * @group integration
     */
    public function it_can_delete_an_existing_contact()
    {
        $FIRST_NAME = $this->faker->firstName;
        $LAST_NAME = $this->faker->lastName;

        $contact = $this->client->contacts()->create(compact('FIRST_NAME', 'LAST_NAME'));

        $contact = $this->client->contacts()->delete(Arr::get($contact, 'CONTACT_ID'));

        $this->assertNull($contact);
    }

    /**
     * @test
     *
     * @group integration
     */
    public function it_can_retrieve_all_contacts()
    {
        $FIRST_NAME = $this->faker->firstName;
        $LAST_NAME = $this->faker->lastName;

        $contact = $this->client->contacts()->create(compact('FIRST_NAME', 'LAST_NAME'));
        $this->contactId = Arr::get($contact, 'CONTACT_ID');

        $contacts = $this->client->contacts()->all();

        $this->assertNotEmpty($contacts);
        $this->assertInternalType('array', $contacts);
    }
}