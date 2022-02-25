<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // https://blog.codehunger.in/create-dynamic-categories-and-subcategories-in-laravel-7-8/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->only("name"));

        if ($category) {
            return response()->json(
                [
                    "message" => "Category created successfully.",
                    "id" => $category->id,
                    "category" => $request->name,
                    "status" => 201
                ]
            );
        } else {
            return response()->json(
                [
                    "message" => "An error occurred during the operation.",
                    "status" => 404
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $update = $category->find($request->id)->update([
            "name" => $request->value
        ]);

        if ($update) {
            return response()->json(
                [
                    "message" => "Category deleted successfully.",
                    "status" => 201
                ]
            );
        } else {
            return response()->json(
                [
                    "message" => "An error occurred during the operation.",
                    "status" => 404
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, $id)
    {
        $delete = $category->find($id)->delete();

        if ($delete) {
            return response()->json(
                [
                    "message" => "Category deleted successfully.",
                    "status" => 201
                ]
            );
        } else {
            return response()->json(
                [
                    "message" => "An error occurred during the operation.",
                    "status" => 404
                ]
            );
        }
    }
}
