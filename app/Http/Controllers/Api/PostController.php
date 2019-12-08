<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Category;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;

class PostController extends BaseApiController
{

    public function index()
    {
        $objects = Post::with('category', 'tags')->latest()->paginate($this->paginate);
        return PostResource::collection($objects);
    }

    public function store()
    {
        $this->validate(request(), [
            'category_id' => 'required',
            'title' => 'required|max:256',
            'body' => 'required',
            'published_at' => 'required|date_format:Y/m/d',

            'tags' => 'nullable',
        ]);

        $category = Category::findOrFail(request('category_id'));
        $object = new Post;
        $object->category_id = $category->id;
        $object->title = request('title');
        $object->body = request('body');
        $object->published_at = request('published_at');
        $object->save();

        if (request()->filled('tags')) {
            $tags = request('tags');
            $object->tags()->sync($tags);
        }

        return response()->json([
            'msg' => 'Success'
        ]);
    }
}
