<?php

namespace IanOlson\Insightly\Tests\Api;

use IanOlson\Insightly\Tests\FunctionalTestCase;
use Illuminate\Support\Arr;

class ProjectsTest extends FunctionalTestCase
{
    /**
     * Project ID created during tests.
     *
     * @var int
     */
    protected $projectId;

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();
        if (isset($this->projectId)) {
            $this->client->projects()->delete($this->projectId);
        }
    }

    /**
     * @test
     *
     * @group integration
     */
    public function it_can_create_a_new_project()
    {
        $PROJECT_NAME = $this->faker->company;
        $STATUS = 'Not Started';

        $project = $this->client->projects()->create(compact('PROJECT_NAME', 'STATUS'));

        $this->projectId = Arr::get($project, 'PROJECT_ID');

        $this->assertSame($PROJECT_NAME, Arr::get($project, 'PROJECT_NAME'));
        $this->assertSame($STATUS, Arr::get($project, 'STATUS'));
    }

    /**
     * @test
     *
     * @group integration
     */
    public function it_can_find_an_existing_project()
    {
        $PROJECT_NAME = $this->faker->company;
        $STATUS = 'Not Started';

        $project = $this->client->projects()->create(compact('PROJECT_NAME', 'STATUS'));

        $this->projectId = Arr::get($project, 'PROJECT_ID');

        $project = $this->client->projects()->find($this->projectId);

        $this->assertSame($PROJECT_NAME, Arr::get($project, 'PROJECT_NAME'));
        $this->assertSame($STATUS, Arr::get($project, 'STATUS'));
    }

    /**
     * @test
     *
     * @group integration
     *
     * @expectedException \IanOlson\Insightly\Exception\NotFoundException
     */
    public function it_will_throw_an_exception_when_searching_for_a_non_existing_project()
    {
        $this->client->projects()->find(time());
    }

    /**
     * @test
     *
     * @group integration
     */
    public function it_can_update_an_existing_project()
    {
        $PROJECT_NAME = $this->faker->company;
        $STATUS = 'Not Started';
        $ORIGINAL_PROJECT_NAME = $PROJECT_NAME;

        $project = $this->client->projects()->create(compact('PROJECT_NAME', 'STATUS'));

        $this->projectId = Arr::get($project, 'PROJECT_ID');

        $PROJECT_NAME = $this->faker->company;

        $project = $this->client->projects()->update($this->projectId, compact('PROJECT_NAME', 'STATUS'));

        $this->assertSame($PROJECT_NAME, Arr::get($project, 'PROJECT_NAME'));
        $this->assertSame($STATUS, Arr::get($project, 'STATUS'));
        $this->assertNotEquals($ORIGINAL_PROJECT_NAME, Arr::get($project, 'PROJECT_NAME'));
    }

    /**
     * @test
     *
     * @group integration
     */
    public function it_can_delete_an_existing_project()
    {
        $PROJECT_NAME = $this->faker->company;
        $STATUS = 'Not Started';

        $project = $this->client->projects()->create(compact('PROJECT_NAME', 'STATUS'));

        $project = $this->client->projects()->delete(Arr::get($project, 'PROJECT_ID'));

        $this->assertNull($project);
    }

    /**
     * @test
     *
     * @group integration
     */
    public function it_can_retrieve_all_projects()
    {
        $PROJECT_NAME = $this->faker->company;
        $STATUS = 'Not Started';

        $project = $this->client->projects()->create(compact('PROJECT_NAME', 'STATUS'));
        $this->projectId = Arr::get($project, 'PROJECT_ID');

        $projects = $this->client->projects()->all();

        $this->assertNotEmpty($projects);
        $this->assertInternalType('array', $projects);
    }
}