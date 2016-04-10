<?php

namespace IanOlson\Insightly;

use RuntimeException;

class Config implements ConfigInterface
{
    /**
     * The current package version.
     *
     * @var string
     */
    protected $version;

    /**
     * The Insightly API key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The Insightly API version.
     *
     * @var string
     */
    protected $apiVersion;

    /**
     * Constructor.
     *
     * @param string $version
     * @param string $apiKey
     * @param string $apiVersion
     *
     * @throws RuntimeException
     */
    public function __construct($version, $apiKey, $apiVersion)
    {
        $this->setVersion($version);

        $this->setApiKey($apiKey ?: getenv('INSIGHTLY_API_KEY'));

        $this->setApiVersion($apiVersion ?: getenv('INSIGHTLY_API_VERSION') ?: 'v2.1');

        if (! $this->apiKey) {
            throw new RuntimeException('The Insightly API key is not defined!');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * {@inheritdoc}
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }
}
