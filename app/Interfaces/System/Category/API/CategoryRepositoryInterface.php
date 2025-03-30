<?php

namespace App\Interfaces\System\Category\API;

use Illuminate\Http\Request;

interface CategoryRepositoryInterface
{
    public function index(Request $request);

    public function store(Request $request);
}
