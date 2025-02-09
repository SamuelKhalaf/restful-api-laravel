<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesCollection;
use App\Http\Resources\CategoriesResource;
use App\Traits\GeneralTrait;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        return new CategoriesCollection($categories);
    }

    public function store(Request $request)
    {
        try {
            $data  = $request->only('name','slug');
            $data['is_active'] = $this->setStatus($request);
            $data['parent_id'] = $this->setParentId($request);
            Category::create($data);

            return response()->json(['status' => 'true' , 'msg' => 'Category added successfully']);

        } catch (\Exception $exception) {
            return response()->json(['status' => 'false' , 'msg' => 'An error occurred', 'error' => $exception]);

        }
    }

    public function update(Request $request, Category $category)
    {
        try {
            $data  = $request->only('name','slug');
            $data['is_active'] = $this->setStatus($request);
            $data['parent_id'] = $this->setParentId($request);

            $category->update($data);

            return response()->json(['status' => 'true' , 'msg' => 'Category updated successfully']);

        } catch (\Exception $exception) {

            return response()->json(['status' => 'false' , 'msg' => 'An error occurred' ]);
        }
    }

    public function destroy(Category $category)
    {
        try {
            // Delete the category
            $category->delete();

            return response()->json(['status' => 'true' , 'msg' => 'Category deleted successfully']);

        } catch (\Exception $exception) {
            return response()->json(['status' => 'false' , 'msg' => 'An error occurred']);
        }
    }

    public function setStatus($request): int
    {
        return $request->filled('is_active') ? 1 : 0;
    }

    public function setParentId($request): ?int
    {
        return $request->filled('parent_id') ? $request->parent_id : null;
    }
}
