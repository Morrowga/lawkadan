<?php

namespace App\Repositories\System\Post\API;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Post;
use App\Models\User;
use App\Models\State;
use App\Models\Category;
use App\Models\PostHelper;
use Illuminate\Support\Str;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\System\Post\API\PostResource;
use App\Interfaces\System\Post\API\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    use ApiResponses;

    public function index(Request $request)
    {
        try {
            if (!$request->has('city_id')) {
                return $this->error('City ID Required', 400);
            }

            $posts = Post::with(['user', 'city', 'category'])
            ->where('status', '!=', 'closed')
            ->where('city_id', $request->query('city_id'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

            $postsArray = [
                'current_page' => $posts->currentPage(),
                'data' => PostResource::collection($posts),
                'total' => $posts->total(),
                'per_page' => $posts->perPage(),
                'last_page' => $posts->lastPage(),
                'from' => $posts->firstItem() ?? 0,
                'to' => $posts->lastItem() ?? 0,
            ];

            return $this->success('Posts successfully fetched.', $postsArray);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            if (contains_filtered_words($request->title) || contains_filtered_words($request->description)) {
                return $this->error('Your content contains restricted words.', 400);
            }

            $request['uuid'] = Str::uuid();
            $request['user_id'] = Auth::user()->id;

            $post = Post::create($request->all());

            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');

                $originalName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $date = now()->format('Y-m-d_H-i-s'); // Example: 2025-03-29_12-30-00
                $fileExtension = $imageFile->getClientOriginalExtension();
                $fileName = "{$originalName}_{$date}.{$fileExtension}";

                $tempPath = storage_path("app/{$fileName}");

                $image = Image::read($imageFile)->resize(800, 550);
                $image->save($tempPath);

                $post->addMedia($tempPath)->toMediaCollection('posts');
            }

            DB::commit();

            return $this->success('Post has been created successfully.', new PostResource($post));

        } catch (\Exception $e) {
            DB::rollback();

            return $this->error($e->getMessage());
        }
    }

    public function activities(Request $request)
    {
        $user = Auth::user();

        try {

            $data = Post::with(['city', 'user', 'category'])->where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);

            if($request->query('type') != 'post')
            {
                $ids = $user->helpedPosts()->pluck('post_id')->toArray();

                $data = Post::whereIn('id', $ids)->paginate(10);
            }

            return $this->success('Post has been fetched successfully.', new PostResource($data));

        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }

    public function update(Request $request,Post $post)
    {
        DB::beginTransaction();

        try {
            if(empty($post))
            {
                return $this->error('Post not found', 400);
            }

            $post->update([
                "status" => $request->status,
                "remark" => $request->remark
            ]);

            DB::commit();

            return $this->success('Post has been updated successfully.', new PostResource($post));

        } catch (\Exception $e) {
            DB::rollback();

            return $this->error($e->getMessage());
        }
    }

    public function helpCount(Request $request,Post $post)
    {
        DB::beginTransaction();

        try {
            if(empty($post))
            {
                return $this->error('Post not found', 400);
            }

            $user = Auth::user();

            if (!$user->helpedPosts()->where('post_id', $post->id)->exists()) {

                $user->helpedPosts()->attach($post->id);

                $post->help_count += 1;
                $post->save();
            }

            DB::commit();

            return $this->success('Post has been updated successfully.', new PostResource($post));

        } catch (\Exception $e) {
            DB::rollback();

            return $this->error($e->getMessage());
        }
    }
}
