<?php

namespace Tests\Feature;

use App\Services\CommentsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetComments()
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

    public function testGetZeroComments(){
        $response = $this->json('get', '/api/films/1/comments');

        $response
            ->assertStatus(200)
            ->assertJson([
            ]);
    }


    public function testSaveOfComment(){
        $response = $this->json('post', '/api/films/1/comments', ["content"=>"test content"]);

        $response
            ->assertStatus(201)
            ->assertJson(['content'=>'test content', 'film_episode_id'=>1])
            ->assertJsonStructure(['content',
                'film_episode_id','commenter_ip','created_at']);
    }

    public function testSaveLongContent(){
        $response = $this->json('post', '/api/films/1/comments', ["content"=>$this->faker->sentence(505)
        ]);

        $response
            ->assertStatus(500)
            ->assertJsonStructure(['error']);
    }
}
