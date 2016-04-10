<?php

namespace IanOlson\Insightly;

use BadMethodCallException;
use IanOlson\Insightly\Api\ApiInterface;

class Insightly
{
    /**
     * The package version.
     *
     * @var string
     */
    const VERSION = '0.1.0';

    /**
     * The Config repository instance.
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param string $apiKey
     * @param string $apiVersion
     *
     * @return void
     */
    public function __construct($apiKey = null, $apiVersion = null)
    {
        $this->config = new Config(self::VERSION, $apiKey, $apiVersion);
    }

    /**
     * Create a new Insightly API instance.
     *
     * @param string $apiKey
     * @param string $apiVersion
     *
     * @return Insightly
     */
    public static function make($apiKey = null, $apiVersion = null)
    {
        return new static($apiKey, $apiVersion);
    }

    /**
     * Returns the current package version.
     *
     * @return string
     */
    public static function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Returns the Config repository instance.
     *
     * @return ConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Sets the Config repository instance.
     *
     * @param  ConfigInterface $config
     *
     * @return $this
     */
    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Returns the Insightly API key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->config->getApiKey();
    }

    /**
     * Sets the Insightly API key.
     *
     * @param  string $apiKey
     *
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->config->setApiKey($apiKey);

        return $this;
    }

    /**
     * Returns the Insightly API version.
     *
     * @return string
     */
    public function getApiVersion()
    {
        return $this->config->getApiVersion();
    }

    /**
     * Sets the Insightly API version.
     *
     * @param  string $apiVersion
     *
     * @return $this
     */
    public function setApiVersion($apiVersion)
    {
        $this->config->setApiVersion($apiVersion);

        return $this;
    }

    /**
     * Dynamically handle missing methods.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return ApiInterface
     */
    public function __call($method, array $parameters = [])
    {
        return $this->getApiInstance($method);
    }

    /**
     * Returns the Api class instance for the given method.
     *
     * @param string $method
     *
     * @return ApiInterface
     *
     * @throws BadMethodCallException
     */
    protected function getApiInstance($method)
    {
        $class = "\\IanOlson\\Insightly\\Api\\" . ucwords($method);

        if (class_exists($class)) {
            return new $class($this->config);
        }

        throw new BadMethodCallException("Undefined method [{$method}] called.");
    }
}
