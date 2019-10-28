<?php

namespace Tests\Feature;

use App\Services\CharactersService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Collection;

class CharactersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetCharacters(){

        $this->mock(CharactersService::class, function ($mock) {
            $data=['data'=>
                [
                    [
                        "name"=> "new jedi",
                        "height"=> "189",
                        "gender"=>'female'
                    ],
                    [
                        "name"=> "old jedi",
                        "height"=> "189",
                        "gender"=>'male'
                    ]
                ],
                "meta"=> [
                            "total_count"=> 18,
                            "total_height"=> [
                                "cm"=> 3066,
                                "feet"=> [
                                    "feet"=> 100,
                                    "inches"=> 7.08
                                ]
                            ]
                ]
            ];
            $mock->shouldReceive('charactersByFilm')->andReturn($data);
        });

        $response = $this->json('get', '/api/films/1/characters');
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'=>[
                    [
                        'name','height','gender'
                    ]
                ],
                'meta'=>[
                    'total_count',
                    'total_height'
                ]
            ]);
    }

}
