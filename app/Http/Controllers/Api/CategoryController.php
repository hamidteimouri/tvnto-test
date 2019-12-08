<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\BaseApiController;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends BaseApiController
{
    public function index()
    {
        $objects = Category::whereNull('parent_id')->with('children')->latest()->paginate($this->paginate);
        return CategoryResource::collection($objects);
    }
}
