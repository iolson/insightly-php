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
     * @param string  $url
     * @param array $parameters
     *
     * @return mixed
     */
    public function _get($url = null, $parameters = []);
}