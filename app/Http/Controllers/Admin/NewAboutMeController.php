<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMe;
use App\Models\Information;
use App\Models\NewAboutMe;
use App\Services\Translate;
use Illuminate\Http\Request;

class NewAboutMeController extends Controller
{
    protected $translate_service;

    public function __construct(Translate $translate_service)
    {
        $this->translate_service = $translate_service;
    }

    public function index(Request $request)
    {
        $new_about_me = NewAboutMe::first();
        return view('admin.new_about_me.index')->with([
            'new_about_me' => $new_about_me
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        if ($id) {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
            ]);
            $title = $request->get('title') ? $request->get('title') : "";
            $title_en = $this->translate_service->gg_translate('vi', 'en', $title);
            $title_fr = $this->translate_service->gg_translate('vi', 'fr', $title);
            $content = $request->get('content') ? $request->get('content') : "";
            $content_en = $this->translate_service->gg_translate('vi', 'en', $content);
            $content_fr = $this->translate_service->gg_translate('vi', 'fr', $content);
            $arr_data_update = [
                'title' => $title,
                'title_en' => $title_en,
                'title_fr' => $title_fr,
                'content' => $content,
                'content_en' => $content_en,
                'content_fr' => $content_fr,
            ];
            if ($request->hasFile('image')) {
                $arr_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('image')->getClientOriginalName()));
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('images'), $image_name);
                $arr_data_update = array_merge($arr_data_update, [
                    'image' => $image_name,
                ]);
            }
            if ($request->hasFile('logo_image')) {
                $arr_logo_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('logo_image')->getClientOriginalName()));
                $logo_image_name = $arr_logo_image_name[0] . '-' . time() . '.' . $arr_logo_image_name[1];
                $request->file('logo_image')->move(public_path('images'), $logo_image_name);
                $arr_data_update = array_merge($arr_data_update, [
                    'logo_image' => $logo_image_name,
                ]);
            }
            NewAboutMe::where('id', $id)->update($arr_data_update);
        } else {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'image' => 'required|mimes:jpeg,png,jpg|max:8192',
                'logo_image' => 'required|mimes:jpeg,png,jpg|max:8192',
            ]);
            $title = $request->get('title') ? $request->get('title') : "";
            $title_en = $this->translate_service->gg_translate('vi', 'en', $title);
            $title_fr = $this->translate_service->gg_translate('vi', 'fr', $title);
            $content = $request->get('content') ? $request->get('content') : "";
            $content_en = $this->translate_service->gg_translate('vi', 'en', $content);
            $content_fr = $this->translate_service->gg_translate('vi', 'fr', $content);
            $image_name = "";
            $logo_image_name = "";
            if ($request->hasFile('image')) {
                $arr_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('image')->getClientOriginalName()));
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('images'), $image_name);
            }
            if ($request->hasFile('logo_image')) {
                $arr_logo_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('logo_image')->getClientOriginalName()));
                $logo_image_name = $arr_logo_image_name[0] . '-' . time() . '.' . $arr_logo_image_name[1];
                $request->file('logo_image')->move(public_path('images'), $logo_image_name);
            }
            NewAboutMe::create([
                'title' => $title,
                'title_en' => $title_en,
                'title_fr' => $title_fr,
                'content' => $content,
                'content_en' => $content_en,
                'content_fr' => $content_fr,
                'image' => $image_name,
                'logo_image' => $logo_image_name,
            ]);
        }
        return redirect()->back()->with("message", "Thành Công");
    }

    public function language_content(Request $request, $id)
    {
        NewAboutMe::where('id', $id)
            ->update([
                'title_en' => $request->get('title_en'),
                'title_fr' => $request->get('title_fr'),
                'content_en' => $request->get('content_en'),
                'content_fr' => $request->get('content_fr'),
            ]);

        return redirect()->back()->with('success', 'Sửa Thành Công.');
    }

    public function about_me(Request $request)
    {
        $info = Information::first();
        $about_me = NewAboutMe::first();
        return view('ui.detail_about_me')->with([
            'info' => $info,
            'about_me' => $about_me
        ]);
    }
}
