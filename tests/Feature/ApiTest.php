<?php

namespace Tests\Feature;

use App\Http\Controllers\AthleteController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /** @var bool */
    protected bool $seed = true;

    protected string $path;

    /** @inheritDoc */
    protected function setUp(): void
    {
        parent::setUp();

        $this->refreshTestDatabase();

        $this->path = storage_path('files/athletes.json');
    }

    /**
     * @return \Illuminate\Testing\TestResponse
     */
    protected function createAthletes(): TestResponse
    {
        return $this->post(
            action('FileController@store'),
            ['file' => new UploadedFile($this->path, 'athletes.json', 'application/json', null, true)]
        );
    }

    /** @test */
    public function it_should_allow_to_upload_json_file()
    {
        $response = $this->createAthletes();
        $response->assertExactJson(['data' => 'You have successfully uploaded the file.']);

        $this->assertDatabaseCount('athletes', 3);
        $this->assertDatabaseHas(
            'athletes',
            [
                'name' => 'Bob Doo',
                'age' => 37,
            ]
        );
    }

    /** @test */
    public function it_should_get_all_athletes()
    {
        $this->createAthletes();

        $response = $this->get(action('AthleteController@index'));
        $response
            ->assertStatus(200)
            ->assertExactJson(
                [
                    'data' => [
                        [
                            'id' => 1,
                            'name' => 'Bob Doo',
                            'age' => '37',
                            'location' => 'Montreal, QC',
                        ],
                        [
                            'id' => 2,
                            'name' => 'Tod Robinson',
                            'age' => '34',
                            'location' => 'Halifax, NS',
                        ],
                        [
                            'id' => 3,
                            'name' => 'Tom Dilan',
                            'age' => '27',
                            'location' => 'Palo Alto, CA',
                        ],
                    ],
                ]
            );
    }

    /** @test */
    public function it_should_show_athlete_by_id()
    {
        $this->createAthletes();

        $response = $this->get(action([AthleteController::class, 'show'], ['athlete' => 1]));
        $response
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'age',
                        'country',
                        'province',
                        'city',
                    ],
                ])
            ->assertStatus(200)
            ->assertExactJson(
                [
                    'data' => [
                        'id' => 1,
                        'name' => 'Bob Doo',
                        'age' => '37',
                        'country' => 'Canada',
                        'province' => 'Quebec',
                        'city' => 'Montreal',
                    ],
                ]
            );
    }

    /** @test */
    public function it_should_delete_athlete_by_id()
    {
        $this->createAthletes();

        $response = $this->delete(action([AthleteController::class, 'destroy'], ['athlete' => 1]));

        $response->assertExactJson(['data' => 'The athlete successfully deleted']);

        $this->assertDatabaseCount('athletes', 2);
        $this->assertDatabaseMissing('athletes', ['id' => 1]);
    }
}
