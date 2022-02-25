<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Page::orderBy("order", "ASC")->paginate(10);
        return view("backend.pages.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.pages.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {


        $page = Page::create([
            "name" => $request->name,
            "slug" => Str::slug($request->name),
            "description" => $request->description
        ]);

        if ($request->hasfile('image')) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('image'), $imageName);
            Image::create([
                "slug" => Str::slug($request->name),
                "image" => $imageName,
                "img_id" => $page->id
            ]);
        };
        return redirect()->route("page.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $data = $page->find($page->id)->load("getPageImage");

        // return $data->getPageImage[0]->image;
        return view("backend.pages.edit", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {


        // return dd($request->image->extension());

        $page->find($request->id)->update([
            "name" => $request->name,
            "slug" => Str::slug($request->name),
            "description" => $request->description
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);



        Image::whereImgId($request->id)->update([
            "image" => $imageName,
            "slug" => Str::slug($request->name),
        ]);

        return redirect()->route("page.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id)->delete();

        if ($page) {
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


    public function archive()
    {
        $data = Page::onlyTrashed()->paginate(10);
        return view("backend.pages.archive", compact("data"));
    }

    public function archiveRestore($id)
    {
        $page = Page::onlyTrashed()->find($id)->restore();
        if ($page) {
            return response()->json(
                [
                    "message" => "İşlemi başarılı",
                    "status" => 201
                ]
            );
        } else {
            return response()->json(
                [
                    "message" => "İşlem sırasında bir hata oluştu",
                    "status" => 404
                ]
            );
        }
    }

    public function archiveDelete($id)
    {
        $page = Page::onlyTrashed()->find($id)->forceDelete();
        if ($page) {
            return response()->json(
                [
                    "message" => "Silme işlemi başarılı",
                    "status" => 201
                ]
            );
        } else {
            return response()->json(
                [
                    "message" => "İşlem sırasında bir hata oluştu",
                    "status" => 404
                ]
            );
        }
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

    public function statusChangeHandler(Request $request)
    {
        $status = Page::find($request->id)->update([
            "status" => $request->status
        ]);

        if ($status) {
            return response()->json(
                [
                    "message" => "Status is update",
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
    public function orderChangeHandler(Request $request)
    {
        // return $request->only("data");
        $orderRequestHandler = $request->only("data");
        // return $orderRequestHandler;

        foreach ($orderRequestHandler["data"] as  $value) {
            $status = Page::find($value["id"])->update([
                "order" => $value["order"]
            ]);
        }


        if ($status) {
            return response()->json(
                [
                    "message" => "Order change is save",
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

    public function statusArchiveChangeHandler(Request $request)
    {
        $status = Page::onlyTrashed()->find($request->id)->update([
            "status" => $request->status
        ]);

        if ($status) {
            return response()->json(
                [
                    "message" => "Status is update",
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
    public function orderArchiveChangeHandler(Request $request)
    {
        // return $request->only("data");
        $orderRequestHandler = $request->only("data");
        // return $orderRequestHandler;

        foreach ($orderRequestHandler["data"] as  $value) {
            $status = Page::onlyTrashed()->find($value["id"])->update([
                "order" => $value["order"]
            ]);
        }


        if ($status) {
            return response()->json(
                [
                    "message" => "Order change is save",
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
