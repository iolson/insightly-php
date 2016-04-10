<?php

namespace IanOlson\Insightly;

interface ConfigInterface
{
    /**
     * Returns the current package version.
     *
     * @return string
     */
    public function getVersion();

    /**
     * Sets the current package version.
     *
     * @param string $version
     *
     * @return $this
     */
    public function setVersion($version);

    /**
     * Returns the Insightly API key.
     *
     * @return string
     */
    public function getApiKey();

    /**
     * Sets the Insightly API key.
     *
     * @param string $apiKey
     *
     * @return $this
     */
    public function setApiKey($apiKey);

    /**
     * Returns the Insightly API version.
     *
     * @return string
     */
    public function getApiVersion();

    /**
     * Sets the Insightly API version.
     *
     * @param string $apiVersion
     *
     * @return $this
     */
    public function setApiVersion($apiVersion);
}