<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\News;
use App\Services\Translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class NewsController extends Controller
{
    protected $translate_service;

    public function __construct(Translate $translate_service)
    {
        $this->translate_service = $translate_service;
    }

    public function index(Request $request)
    {
        $news = $this->list_news_paginate();
        return view('admin.new.index')->with([
            'news' => $news
        ]);
    }

    public function add(Request $request)
    {
        return view('admin.new.add_or_edit');
    }

    public function edit(Request $request, $id)
    {
        $new = null;

        if ($id) {
            $new = News::find($id);
        }

        return view('admin.new.add_or_edit')->with([
            'new' => $new
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg|max:8096',
            'link' => 'required',
        ]);
        $title = $request->get('title');
        $title_en = $this->translate_service->gg_translate('vi', 'en', $title);
        $title_fr = $this->translate_service->gg_translate('vi', 'fr', $title);
        $description = $request->get('description') ? $request->get('description') : "";
        $description_en = $this->translate_service->gg_translate('vi', 'en', $description);
        $description_fr = $this->translate_service->gg_translate('vi', 'fr', $description);
        $image_name = "";
        if ($request->hasFile('image')) {
            $arr_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('image')->getClientOriginalName()));
            $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
            $request->file('image')->move(public_path('images'), $image_name);
        }
        News::create([
            'image' => $image_name,
            'title' => $title,
            'title_en' => $title_en,
            'title_fr' => $title_fr,
            'link' => $request->get('link'),
            'description' => $description,
            'description_en' => $description_en,
            'description_fr' => $description_fr,
        ]);
        return redirect()->back()->with('success', 'Thêm Thành Công.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
        ]);

        $new = News::find($id);

        if ($new) {
            $title = $request->get('title');
            $description = $request->get('description') ? $request->get('description') : "";
            $arr_update_data = [
                'title' => $title,
                'title_en' => $this->translate_service->gg_translate('vi', 'en', $title),
                'title_fr' => $this->translate_service->gg_translate('vi', 'en', $title),
                'description' => $description,
                'description_en' => $this->translate_service->gg_translate('vi', 'en', $description),
                'description_fr' => $this->translate_service->gg_translate('vi', 'fr', $description),
            ];
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|mimes:jpeg,png,jpg|max:8096',
                ]);
                $arr_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('image')->getClientOriginalName()));
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('images'), $image_name);
                //delete old image
                if (file_exists(public_path('images/') . $new['image'])) {
                    unlink(public_path('images/') . $new['image']);
                }
                $arr_update_data = array_merge($arr_update_data, [
                    'image' => $image_name,
                ]);
            }
            News::where('id', $id)->update($arr_update_data);
            return redirect()->back()->with('success', 'Sửa Thành Công.');
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $new = News::find($id);
        if ($new) {
            //delete old image
            if (file_exists(public_path('images/') . $new['image'])) {
                unlink(public_path('images/') . $new['image']);
            }
            $new->delete();
        }
        return redirect()->back()->with('success', 'Xóa Thành Công.');
    }

    public function list_news_paginate()
    {
        return News::orderBy('id', 'desc')->paginate(Config::get('constants.paginate_admin'));
    }

    public function language_content(Request $request, $id)
    {
        News::where('id', $id)
            ->update([
                'title_en' => $request->get('title_en'),
                'title_fr' => $request->get('title_fr'),
                'description_en' => $request->get('description_en'),
                'description_fr' => $request->get('description_fr'),
            ]);

        return redirect()->back()->with('success', 'Sửa Thành Công.');
    }

    public function news()
    {
        $news = News::orderBy('id', 'desc')->get()->toArray();
        $info = Information::first();
        return view('ui.news')->with([
            'news' => $news,
            'info' => $info
        ]);
    }
}
