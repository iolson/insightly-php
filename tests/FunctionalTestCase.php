<?php

namespace IanOlson\Insightly\Tests;

use Faker\Factory;
use Faker\Generator;
use IanOlson\Insightly\Insightly;
use PHPUnit_Framework_TestCase;

class FunctionalTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * The Insightly API instance.
     *
     * @var Insightly
     */
    protected $client;

    /**
     * Faker factory instance.
     *
     * @var Generator
     */
    protected $faker;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->client = new Insightly;
        $this->faker = Factory::create();
    }
}