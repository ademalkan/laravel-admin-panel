<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Slider::orderBy("order", "asc")->paginate(10);
        return view("backend.slider.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSliderRequest $request)
    {

        // return $request->all();
        $slider = Slider::create([
            "name" => $request->name,
            "title" => $request->title,
            "subtitle" => $request->subtitle,
            "slug" => Str::slug($request->name),
            "description" => $request->description
        ]);

        if ($request->hasfile('imageFiles')) {
            foreach ($request->file('imageFiles') as $file) {
                $imageName = $file->getClientOriginalName();

                $file->move(public_path('image'), $imageName);
                Image::create([
                    "slug" => Str::slug($request->name),
                    "image" => $imageName,
                    "img_id" => $slider->id
                ]);
            }
        }


        return redirect()->route("slider.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $data = $slider->find($slider->id)->load("getSliderImage");
        // return $data;
        return view("backend.slider.edit", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Slider::findOrFail($id)->delete();

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

    public function archive()
    {
        $data = Slider::onlyTrashed()->orderBy("order", "asc")->paginate(10);
        return view("backend.slider.archive", compact("data"));
    }

    public function archiveRestore($id)
    {
        $restore = Slider::onlyTrashed()->find($id)->restore();
        if ($restore) {
            return response()->json(
                [
                    "message" => "Trashed is successful",
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

    public function archiveDelete($id)
    {
        $delete = Slider::onlyTrashed()->find($id)->forceDelete();
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
        $status = Slider::find($request->id)->update([
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
            $status = Slider::find($value["id"])->update([
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
        $status = Slider::onlyTrashed()->find($request->id)->update([
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
            $status = Slider::onlyTrashed()->find($value["id"])->update([
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
