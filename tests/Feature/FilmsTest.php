<?php

namespace Tests\Feature;

use App\Services\FilmsService;
use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilmsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetAllFIlms()
    {
        $this->mock(FilmsService::class, function ($mock) {
            $data=['data'=>
                [
                    [
                        'title'=>"Film",
                        'episode_id'=>1,
                           'release_date'=>"1980-05-17",
                           'comment_count'=>4,
                            'opening_crawl'=>"nice"
                    ]
            ]
            ];
            $mock->shouldReceive('allFilms')->andReturn($data);
        });
        $response = $this->get('/api/films');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data'=>[
                        [
                           'title',
                           'episode_id',
                           'release_date',
                           'comment_count',
                            'opening_crawl'
                        ]
    ]
                ]);

}
}