<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMe;
use App\Models\Collection;
use App\Models\Information;
use App\Models\SliderImage;
use App\Models\Studio;
use App\Models\StudioInfo;
use App\Services\Translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class StudioController extends Controller
{
    protected $translate_service;

    public function __construct(Translate $translate_service)
    {
        $this->translate_service = $translate_service;
    }

    public function index(Request $request)
    {
        $studios = $this->list_studios_paginate();
        return view('admin.studio.index')->with([
            'studios' => $studios
        ]);
    }

    public function add(Request $request)
    {
        return view('admin.studio.add_or_edit');
    }

    public function edit(Request $request, $id)
    {
        $studio = null;

        if ($id) {
            $studio = Studio::find($id);
        }

        return view('admin.studio.add_or_edit')->with([
            'studio' => $studio
        ]);
    }

    public function create(Request $request)
    {
        $type = (int)$request->get('type');
        if ($type == 1) {
            $request->validate([
                'image' => 'required|mimes:jpeg,png,jpg|max:8096',
            ]);
            $image_name = "";
            if ($request->hasFile('image')) {
                $arr_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('image')->getClientOriginalName()));
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('images'), $image_name);
            }
            Studio::create([
                'link_studio' => $image_name,
                'type' => $type,
            ]);
            return redirect()->back()->with('success', 'Thêm Thành Công.');
        } else if ($type == 2) {
            $request->validate([
                'image' => 'required|mimes:flv,mp4,m3u8,3gp,ts,mov,avi,wmv|max:51200',
            ]);
            $image_name = "";
            if ($request->hasFile('image')) {
                $arr_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('image')->getClientOriginalName()));
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('videos'), $image_name);
            }
            Studio::create([
                'link_studio' => $image_name,
                'type' => $type,
            ]);
            return redirect()->back()->with('success', 'Thêm Thành Công.');
        }

    }

    public function update(Request $request, $id)
    {
        $type = (int)$request->get('type');
        $studio = Studio::find($id);
        if ($studio) {
            if ($type == 1) {
                if ($request->hasFile('image')) {
                    $request->validate([
                        'image' => 'required|mimes:jpeg,png,jpg|max:8096',
                    ]);
                    $arr_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('image')->getClientOriginalName()));
                    $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                    $request->file('image')->move(public_path('images'), $image_name);
                    // delete old image
                    if ($studio['type'] == 1) {
                        if (file_exists(public_path('images/') . $studio['link_studio'])) {
                            unlink(public_path('images/') . $studio['link_studio']);
                        }
                    } else if ($studio['type'] == 2) {
                        if (file_exists(public_path('videos/') . $studio['link_studio'])) {
                            unlink(public_path('videos/') . $studio['link_studio']);
                        }
                    }

                    Studio::where('id', $id)->update([
                        'link_studio' => $image_name,
                        'type' => $type
                    ]);
                    return redirect()->back()->with('success', 'Sửa Thành Công.');
                }
            } else if ($type == 2) {
                $request->validate([
                    'image' => 'required|mimes:flv,mp4,m3u8,3gp,ts,mov,avi,wmv|max:51200',
                ]);
                $arr_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('image')->getClientOriginalName()));
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('videos'), $image_name);
                // delete old image
                if ($studio['type'] == 1) {
                    if (file_exists(public_path('images/') . $studio['link_studio'])) {
                        unlink(public_path('images/') . $studio['link_studio']);
                    }
                } else if ($studio['type'] == 2) {
                    if (file_exists(public_path('videos/') . $studio['link_studio'])) {
                        unlink(public_path('videos/') . $studio['link_studio']);
                    }
                }

                Studio::where('id', $id)->update([
                    'link_studio' => $image_name,
                    'type' => $type
                ]);
                return redirect()->back()->with('success', 'Sửa Thành Công.');
            }

        }
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $studio = Studio::find($id);
        if ($studio) {
            if ($studio['type'] == 1) {
                if (file_exists(public_path('images/') . $studio['link_studio'])) {
                    unlink(public_path('images/') . $studio['link_studio']);
                }
            } else if ($studio['type'] == 2) {
                if (file_exists(public_path('videos/') . $studio['link_studio'])) {
                    unlink(public_path('videos/') . $studio['link_studio']);
                }
            }
            $studio->delete();
        }
        return redirect()->back()->with('success', 'Xóa Thành Công.');
    }

    public function list_studios_paginate()
    {
        return Studio::orderBy('id', 'desc')->paginate(Config::get('constants.paginate_admin'));
    }

    public function studio(Request $request)
    {
        $studios = Studio::orderBy('id', 'desc')->get()->toArray();
        $info = Information::first();
        $studio_info = StudioInfo::first();
        return view('ui.studio')->with([
            'info' => $info,
            'studios' => $studios,
            'studio_info' => $studio_info
        ]);
    }

    public function get_studio_info(Request $request)
    {
        $studio_info = StudioInfo::first();
        return view('admin.studio.info')->with([
            'studio_info' => $studio_info
        ]);
    }

    public function post_studio_info(Request $request)
    {
        $id = $request->get('id');
        if ($id) {
            $request->validate([
                'description' => 'required',
            ]);
            $description = $request->get('description') ? $request->get('description') : "";
            $description_en = $this->translate_service->gg_translate('vi', 'en', $description);
            $description_fr = $this->translate_service->gg_translate('vi', 'en', $description);
            $arr_data_update = [
                'description' => $description,
                'description_en' => $description_en,
                'description_fr' => $description_fr,
            ];
            if ($request->hasFile('image')) {
                $arr_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('image')->getClientOriginalName()));
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('images'), $image_name);
                $arr_data_update = array_merge($arr_data_update, [
                    'image' => $image_name,
                ]);
            }
            StudioInfo::where('id', $id)->update($arr_data_update);
        } else {
            $request->validate([
                'description' => 'required',
                'image' => 'required|mimes:jpeg,png,jpg|max:8192',
            ]);
            $description = $request->get('description') ? $request->get('description') : "";
            $description_en = $this->translate_service->gg_translate('vi', 'en', $description);
            $description_fr = $this->translate_service->gg_translate('vi', 'en', $description);
            $image_name = "";

            if ($request->hasFile('image')) {
                $arr_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('image')->getClientOriginalName()));
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('images'), $image_name);
            }
            StudioInfo::create([
                'description' => $description,
                'description_en' => $description_en,
                'description_fr' => $description_fr,
                'image' => $image_name
            ]);
        }
        return redirect()->back()->with("message", "Thành Công");
    }

    public function language_content(Request $request, $id)
    {
        $request->validate([
            'description_en' => 'required',
            'description_fr' => 'required',
        ]);
        StudioInfo::where('id', $id)
            ->update([
                'description_en' => $request->get('description_en'),
                'description_fr' => $request->get('description_fr'),
            ]);

        return redirect()->back()->with('success', 'Sửa Thành Công.');
    }
}
