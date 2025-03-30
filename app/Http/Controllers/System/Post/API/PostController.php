<?php

namespace App\Http\Controllers\System\Post\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\Post\API\PostCreateRequest;
use App\Http\Requests\System\Post\API\PostUpdateRequest;
use App\Interfaces\System\Post\API\PostRepositoryInterface;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = $this->postRepository->index($request);

        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $createPost = $this->postRepository->store($request);

        return $createPost;
    }

    public function activities(Request $request)
    {
        $data = $this->postRepository->activities($request);

        return $data;
    }

    public function helpCount(Request $request, $post)
    {
        $record = Post::where('uuid', $post)->first();

        $helpCount = $this->postRepository->helpCount($request, $record);

        return $helpCount;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, $post)
    {
        $record = Post::where('uuid', $post)->first();

        $updatePost = $this->postRepository->update($request, $record);

        return $updatePost;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

    }
}
