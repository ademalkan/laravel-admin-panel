<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\ArticleAtCategory;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Blog::orderBy("order", "asc")->paginate(10);
        $categories = Category::all();
        return view("backend.blog.index", compact("data", "categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.blog.create', compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $page = Blog::create([
            "title" => $request->title,
            "slug" => Str::slug($request->title),
            "content" => $request->content,
            "published_date" => $request->published_date
        ]);

        ArticleAtCategory::create([
            "category_id" => $request->category,
            "article_id" => $page->id
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('image'), $imageName);
            Image::create([
                "slug" => Str::slug($request->title),
                "image" => $imageName,
                "img_id" => $page->id
            ]);
        }


        return redirect()->route("blog.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $data = $blog->find($blog->id)->load("getArticleImage");
        $categories = Category::all();
        // return $data->getPageImage[0]->image;
        return view("backend.blog.edit", compact("data","categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }

    public function deleteImage(Request $request)
    {
        $delete = Image::findOrFail($request->image_id)->delete();
        if ($delete) {
            return response()->json(
                [
                    "message" => "Deletion successful",
                    "status" => 201
                ]
            );
        } else {
            return response()->json(
                [
                    "message" => "An error occurred during the operation",
                    "status" => 404
                ]
            );
        }
    }

}
