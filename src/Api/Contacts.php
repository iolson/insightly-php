<?php

namespace IanOlson\Insightly\Api;

use Illuminate\Support\Arr;

class Contacts extends Api
{
    /**
     * Adds a contact.
     *
     * @param array $parameters
     *
     * @return array
     */
    public function create(array $parameters = [])
    {
        return $this->postRequest("Contacts", $parameters);
    }

    /**
     * Gets a contact.
     *
     * @param $contactId
     *
     * @return array
     */
    public function find($contactId)
    {
        return $this->getRequest("Contacts/{$contactId}");
    }

    /**
     * Updates a contact.
     *
     * @param int   $contactId
     * @param array $parameters
     *
     * @return array
     */
    public function update($contactId, array $parameters = [])
    {
        $parameters = Arr::add($parameters, 'CONTACT_ID', $contactId);

        return $this->putRequest("Contacts", $parameters);
    }

    /**
     * Deletes a contact.
     *
     * @param int $contactId
     *
     * @return void
     */
    public function delete($contactId)
    {
        $this->deleteRequest("Contacts/{$contactId}");

        return;
    }

    /**
     * Gets a list of contacts.
     *
     * @param array $parameters
     *
     * @return array
     */
    public function all(array $parameters = [])
    {
        $this->setFilters(['ids', 'email', 'tag']);

        return $this->getRequest("Contacts", Arr::only($parameters, $this->getFilters()));
    }

    /**
     * Get a contact's emails.
     *
     * @param int $contactId
     *
     * @return array
     */
    public function emails($contactId)
    {
        return $this->getRequest("Contacts/{$contactId}/Emails");
    }

    /**
     * Get a contact's notes.
     *
     * @param int $contactId
     *
     * @return array
     */
    public function notes($contactId)
    {
        return $this->getRequest("Contacts/{$contactId}/Notes");
    }

    /**
     * Get a contact's tasks.
     *
     * @param int $contactId
     *
     * @return array
     */
    public function tasks($contactId)
    {
        return $this->getRequest("Contacts/{$contactId}/Tasks");
    }

    /**
     * Get a contact's image.
     *
     * @param int $contactId
     *
     * @return array
     */
    public function image($contactId)
    {
        return $this->getRequest("Contacts/{$contactId}/Image");
    }
}
