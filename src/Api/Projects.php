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
        return $this->_post("Projects", $parameters);
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
        return $this->_get("Projects/{$projectId}");
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

        return $this->_put("Projects", $parameters);
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
        $this->_delete("Projects/{$projectId}");

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

        return $this->_get("Projects", Arr::only($parameters, $this->getFilters()));
    }

    /**
     * Get a project's emails.
     *
     * @param int $projectId
     *
     * @return array
     */
    public function emails($projectId)
    {
        return $this->_get("Projects/{$projectId}/Emails");
    }

    /**
     * Get a project's notes.
     *
     * @param int $projectId
     *
     * @return array
     */
    public function notes($projectId)
    {
        return $this->_get("Projects/{$projectId}/Notes");
    }

    /**
     * Get a project's tasks.
     *
     * @param int $projectId
     *
     * @return array
     */
    public function tasks($projectId)
    {
        return $this->_get("Projects/{$projectId}/Tasks");
    }

    /**
     * Get a project's image.
     *
     * @param int $projectId
     *
     * @return array
     */
    public function image($projectId)
    {
        return $this->_get("Projects/{$projectId}/Image");
    }
}