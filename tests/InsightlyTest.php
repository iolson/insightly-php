<?php

namespace IanOlson\Insightly\Tests;

use BadMethodCallException;
use IanOlson\Insightly\Config;
use IanOlson\Insightly\ConfigInterface;
use IanOlson\Insightly\Insightly;
use Mockery as m;
use PHPUnit_Framework_TestCase;
use RuntimeException;

class InsightlyTest extends PHPUnit_Framework_TestCase
{
    /**
     * The Insightly API client instance.
     *
     * @var Insightly
     */
    protected $insightly;

    /**
     * Setup resources and dependencies.
     *
     * @return void
     */
    public function setUp()
    {
        $this->insightly = new Insightly('insightly-api-key', 'v2.1');
    }

    /**
     * Close mockery.
     *
     * @return void
     */
    public function tearDown()
    {
        m::close();
    }

    /**
     * @test
     */
    public function it_can_create_a_new_instance_using_the_make_method()
    {
        $insightly = Insightly::make('insightly-api-key');

        $this->assertEquals('insightly-api-key', $insightly->getApiKey());
    }

    /**
     * @test
     */
    public function it_can_create_a_new_instance_using_enviroment_variables()
    {
        $insightly = new Insightly;

        $this->assertEquals(getenv('INSIGHTLY_API_KEY'), $insightly->getApiKey());
        $this->assertEquals(getenv('INSIGHTLY_API_VERSION'), $insightly->getApiVersion());
    }

    /**
     * @test
     */
    public function it_can_get_and_set_the_api_key()
    {
        $this->insightly->setApiKey('new-insightly-api-key');

        $this->assertEquals('new-insightly-api-key', $this->insightly->getApiKey());
    }

    /**
     * @test
     *
     * @expectedException RuntimeException
     */
    public function it_throws_an_exception_when_the_api_key_is_not_set()
    {
        // Unset the environment variable
        putenv('INSIGHTLY_API_KEY');

        new Insightly;
    }

    /**
     * @test
     */
    public function it_can_get_and_set_the_api_version()
    {
        $this->insightly->setApiVersion('v2.2');
        $this->assertEquals('v2.2', $this->insightly->getApiVersion());
    }

    /**
     * @test
     */
    public function it_can_get_the_current_package_version()
    {
        $this->insightly->getVersion();
    }

    /**
     * @test
     */
    public function it_can_get_and_set_the_config_instance()
    {
        $config = new Config(Insightly::VERSION, 'insightly-api-key', null);
        $this->insightly->setConfig($config);

        $this->assertInstanceOf(ConfigInterface::class, $this->insightly->getConfig());
    }

    /**
     * @test
     */
    public function it_can_create_requests()
    {
        $this->insightly->contacts();
    }

    /**
     * @test
     *
     * @expectedException BadMethodCallException
     */
    public function it_throws_an_exception_when_the_request_is_invalid()
    {
        $this->insightly->foo();
    }
}