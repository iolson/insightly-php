<?php

namespace IanOlson\Insightly\Api;

interface ApiInterface
{
    /**
     * Returns the API base url.
     *
     * @return string
     */
    public function baseUrl();

    /**
     * Send a GET request.
     *
     * @param string $url
     * @param array  $parameters
     *
     * @return array
     */
    public function getRequest($url = null, $parameters = []);

    /**
     * Send an HEAD request.
     *
     * @param string $url
     * @param array  $parameters
     *
     * @return array
     */
    public function headRequest($url = null, array $parameters = []);

    /**
     * Send an DELETE request.
     *
     * @param string $url
     * @param array  $parameters
     *
     * @return array
     */
    public function deleteRequest($url = null, array $parameters = []);

    /**
     * Send an PUT request.
     *
     * @param string $url
     * @param array  $parameters
     *
     * @return array
     */
    public function putRequest($url = null, array $parameters = []);

    /**
     * Send an PATCH request.
     *
     * @param string $url
     * @param array  $parameters
     *
     * @return array
     */
    public function patchRequest($url = null, array $parameters = []);

    /**
     * Send an POST request.
     *
     * @param string $url
     * @param array  $parameters
     *
     * @return array
     */
    public function postRequest($url = null, array $parameters = []);

    /**
     * Send an OPTIONS request.
     *
     * @param string $url
     * @param array  $parameters
     *
     * @return array
     */
    public function optionsRequest($url = null, array $parameters = []);

    /**
     * Executes the HTTP request.
     *
     * @param string $httpMethod
     * @param string $url
     * @param array  $parameters
     *
     * @return array
     */
    public function execute($httpMethod, $url, array $parameters = []);
}
