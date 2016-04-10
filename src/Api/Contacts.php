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
}
