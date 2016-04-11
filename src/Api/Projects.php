<?php

namespace IanOlson\Insightly\Api;

use Illuminate\Support\Arr;

class Projects extends Api
{
    /**
     * Adds a project.
     *
     * @param array $parameters
     *
     * @return array
     */
    public function create(array $parameters = [])
    {
        return $this->postRequest("Projects", $parameters);
    }

    /**
     * Gets a project.
     *
     * @param $projectId
     *
     * @return array
     */
    public function find($projectId)
    {
        return $this->getRequest("Projects/{$projectId}");
    }

    /**
     * Updates a project.
     *
     * @param int   $projectId
     * @param array $parameters
     *
     * @return array
     */
    public function update($projectId, array $parameters = [])
    {
        $parameters = Arr::add($parameters, 'CONTACT_ID', $projectId);

        return $this->putRequest("Projects", $parameters);
    }

    /**
     * Deletes a project.
     *
     * @param int $projectId
     *
     * @return void
     */
    public function delete($projectId)
    {
        $this->deleteRequest("Projects/{$projectId}");

        return;
    }

    /**
     * Gets a list of projects.
     *
     * @param array $parameters
     *
     * @return array
     */
    public function all(array $parameters = [])
    {
        $this->setFilters(['ids', 'tag']);

        return $this->getRequest("Projects", Arr::only($parameters, $this->getFilters()));
    }
}
