<?php

namespace IanOlson\Insightly\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use IanOlson\Insightly\ConfigInterface;
use IanOlson\Insightly\Exception\Handler;
use Psr\Http\Message\RequestInterface;

class Api implements ApiInterface
{
    /**
     * The config repository instance.
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * Available filters.
     *
     * @var array
     */
    protected $filters;

    /**
     * JSON Request methods.
     *
     * @var array
     */
    protected $jsonRequestMethods;

    /**
     * Type of request.
     *
     * @var string
     */
    protected $type;

    /**
     * Constructor.
     *
     * @param ConfigInterface $config
     *
     * @return void
     */
    public function __construct(ConfigInterface $config)
    {
        $this->setConfig($config)
             ->setFilters()
             ->setJsonRequestMethods(['post', 'put'])
             ->setRequestType();
    }

    /**
     * Get config repository instance.
     *
     * @return ConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set config repository instance.
     *
     * @param ConfigInterface $config
     *
     * @return $this
     */
    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Get query filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Set query filters.
     *
     * @param array $filters
     *
     * @return $this
     */
    public function setFilters(array $filters = [])
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * Get JSON request methods.
     *
     * @return array
     */
    public function getJsonRequestMethods()
    {
        return $this->jsonRequestMethods;
    }

    /**
     * Set JSON request methods.
     *
     * @param array $jsonRequestMethods
     *
     * @return $this
     */
    public function setJsonRequestMethods(array $jsonRequestMethods = [])
    {
        $this->jsonRequestMethods = $jsonRequestMethods;

        return $this;
    }

    /**
     * Get request type.
     *
     * @return string
     */
    public function getRequestType()
    {
        return $this->type;
    }

    /**
     * Set request type.
     *
     * @param string $type
     *
     * @return $this
     */
    public function setRequestType($type = 'query')
    {
        $this->type = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function baseUrl()
    {
        return 'https://api.insight.ly';
    }

    /**
     * {@inheritdoc}
     */
    public function _get($url = null, $parameters = [])
    {
        return $this->execute('get', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _head($url = null, array $parameters = [])
    {
        return $this->execute('head', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _delete($url = null, array $parameters = [])
    {
        return $this->execute('delete', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _put($url = null, array $parameters = [])
    {
        return $this->execute('put', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _patch($url = null, array $parameters = [])
    {
        return $this->execute('patch', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _post($url = null, array $parameters = [])
    {
        return $this->execute('post', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _options($url = null, array $parameters = [])
    {
        return $this->execute('options', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function execute($httpMethod, $url, array $parameters = [])
    {
        if (in_array($httpMethod, $this->getJsonRequestMethods())) {
            $this->setRequestType('json');
        }

        try {
            $response = $this->getClient()->{$httpMethod}("/{$this->getConfig()->getApiVersion()}/{$url}", [
                $this->getRequestType() => $parameters
            ]);

            return json_decode((string)$response->getBody(), true);
        } catch (ClientException $e) {
            new Handler($e);
        }
    }

    /**
     * Returns an Http client instance.
     *
     * @return Client
     */
    protected function getClient()
    {
        return new Client([
            'base_uri' => $this->baseUrl(),
            'handler'  => $this->createHandler(),
        ]);
    }

    /**
     * Create the client handler.
     *
     * @return HandlerStack
     */
    protected function createHandler()
    {
        $stack = HandlerStack::create();

        $stack->push(Middleware::mapRequest(function (RequestInterface $request) {
            $config = $this->getConfig();

            return $request
                ->withHeader('User-Agent', 'IanOlson-Insightly/' . $config->getVersion())
                ->withHeader('Authorization', 'Basic ' . base64_encode($config->getApiKey()));
        }));

        return $stack;
    }
}
