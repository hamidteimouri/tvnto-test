<?php

namespace Tests\Unit;

use App\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndexMethod()
    {
        $category = factory(Category::class)->create();
        $response = $this->json('GET', route('api.category.index'));
        $response->assertStatus(200);
    }

    public function testIndexMethodStructure()
    {
        $category = factory(Category::class)->create();
        $response = $this->json('GET', route('api.category.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' =>
                [
                    [
                        'id',
                        'parent_id',
                        'title',
                        'created_at',
                        'updated_at',
                        'children',
                    ]
                ]
        ]);
    }

}
