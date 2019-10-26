<?php

namespace Tests\Feature;

use App\Services\CommentsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAllComments()
    {

        $this->mock(CommentsService::class, function ($mock) {
            $data=['data'=>
                [
                    [
                        'content'=>"Film was good",
                        'film_episode_id'=>1,
                        'created_at'=>"1980-05-17",
                        'commenter_ip'=>4,
                    ]
                ]
            ];
            $mock->shouldReceive('commentsForFilm')->with('1')->andReturn($data);
        });
        $response = $this->get('/api/films/1/comments');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data'=>[
                    [
                        'content',
                        'film_episode_id',
                        'created_at',
                        'commenter_ip'
                    ]
                ]
            ]);

    }
}
