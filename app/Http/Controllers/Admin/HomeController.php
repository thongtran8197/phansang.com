<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Information;
use App\Models\SliderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $slider_images = $this->list_slider_images_paginate();
        return view('admin.slider_image.index')->with([
            'slider_images' => $slider_images
        ]);
    }

    public function add(Request $request)
    {
        return view('admin.slider_image.add_or_edit');
    }

    public function edit(Request $request, $id)
    {
        $slider_image = null;

        if ($id) {
            $slider_image = SliderImage::find($id);
        }

        return view('admin.slider_image.add_or_edit')->with([
            'slider_image' => $slider_image
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg|max:8096',
        ]);
        $image_name = "";
        if ($request->hasFile('image')) {
            $arr_image_name = explode('.', preg_replace("/\s+/", '-', $request->file('image')->getClientOriginalName()));
            $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
            $request->file('image')->move(public_path('images'), $image_name);
        }
        SliderImage::create([
            'image' => $image_name,
        ]);
        return redirect()->back()->with('success','Thêm Thành Công.');
    }

    public function update(Request $request, $id)
    {
        $slider_image = SliderImage::find($id);
        if ($slider_image) {
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|mimes:jpeg,png,jpg|max:8096',
                ]);
                $arr_image_name = explode('.',  preg_replace("/\s+/", "-", $request->file('image')->getClientOriginalName()));
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('images'), $image_name);
                // delete old image
                if (file_exists(public_path('images/') . $slider_image['image'])) {
                    unlink(public_path('images/') . $slider_image['image']);
                }
                SliderImage::where('id', $id)->update([
                    'image' => $image_name
                ]);
                return redirect()->back()->with('success','Sửa Thành Công.');
            }
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $slider_image = SliderImage::find($id);
        if ($slider_image) {
            if (file_exists(public_path('images/') . $slider_image['image'])) {
                unlink(public_path('images/') . $slider_image['image']);
            }
            $slider_image->delete();
        }
        return redirect()->back()->with('success','Xóa Thành Công.');
    }

    public function list_slider_images_paginate()
    {
        return SliderImage::orderBy('id', 'desc')->paginate(Config::get('constants.paginate_admin'));
    }

    public function home(Request $request)
    {
        $slider_images = SliderImage::get()->pluck('image');
        $newest_collection = Collection::orderBy('created_at', 'desc')->first();
        $info = Information::first();
        return view('ui.index')->with([
            "slider_images" => $slider_images,
            "newest_collection" => $newest_collection,
            "info" => $info
        ]);
    }

    public function test(Request $request)
    {
    }
}
