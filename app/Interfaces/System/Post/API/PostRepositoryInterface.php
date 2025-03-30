<?php

namespace App\Interfaces\System\Post\API;

use App\Models\Post;
use Illuminate\Http\Request;

interface PostRepositoryInterface
{
    public function index(Request $request);

    public function store(Request $request);

    public function activities(Request $request);

    public function update(Request $request, Post $post);

    public function helpCount(Request $request, Post $post);
}
