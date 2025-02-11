<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json($category);
        } else {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->name = $request->name;
            $category->save();
            return response()->json($category);
        } else {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Category deleted']);
        } else {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }
}