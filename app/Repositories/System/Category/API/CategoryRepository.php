<?php

namespace App\Repositories\System\Category\API;

use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\System\Category\API\CategoryResource;
use App\Interfaces\System\Category\API\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    use ApiResponses;

    public function index(Request $request)
    {
        try {

            $categories = Category::get();

            return $this->success('Categories successfully fetched.', CategoryResource::collection($categories));

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $category = Category::create($request->all());

            DB::commit();

            return $this->success('Category has been created successfully.', new CategoryResource($category));

        } catch (\Exception $e) {
            DB::rollback();

            return $this->error($e->getMessage());
        }
    }
}
