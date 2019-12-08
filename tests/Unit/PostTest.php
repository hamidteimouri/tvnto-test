<?php

namespace Tests\Unit;

use App\Post;
use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Category;

class PostTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndexMethod()
    {
        $category = factory(Category::class)->create()->each(function ($object) {
            factory(Post::class)->create(['category_id' => $object->id]);
        });
        $response = $this->json('GET', route('api.post.index'));
        $response->assertStatus(200);
    }

    public function testIndexMethodStructure()
    {
        $category = factory(Category::class)->create();
        $post = factory(Post::class)->create();

        $response = $this->json('GET', route('api.post.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' =>
                [
                    [
                        'id',
                        'category_id',
                        'title',
                        'body',
                        'published_at',
                        'created_at',
                        'updated_at',
                        'category',
                        'tags'
                    ]
                ]
        ]);
    }

    public function testStoreMethodValidation()
    {
        $response = $this->json('POST', route('api.post.store'));
        $response->assertStatus(422);
    }

    public function testStoreMethod()
    {
        $category = factory(Category::class)->create();
        $tags = factory(Tag::class, 10)->create();
        $arr = $tags->pluck('id')->toArray();

        $data = [
            'title' => "this is title",
            'body' => "this is body of post",
            'published_at' => "2019/05/05",
            'category_id' => $category->id,
            'tags' => $arr
        ];
        $response = $this->json('POST', route('api.post.store'), $data);
        $response->assertStatus(200);

    }
}
