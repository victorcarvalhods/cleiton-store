<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // ...

    public function getCategories()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function getCategoryById(Int $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        return response()->json($category, 200);
    }


    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
        ];
        $request->validate($rules);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return response()->json($category, 201);
    }


    public function update(Request $request, Int $id)
    {
        $rules = [
            'name' => 'required|string',
        ];
        $request->validate($rules);

        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        $category->name = $request->name;
        $category->save();

        return response()->json($category, 204);
    }

    public function delete(Request $request, Int $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
