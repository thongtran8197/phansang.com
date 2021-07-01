<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMe;
use App\Models\Collection;
use App\Models\Information;
use App\Models\PointView;
use App\Services\Translate;
use Illuminate\Http\Request;

class AboutMeController extends Controller
{
    protected $translate_service;

    public function __construct(Translate $translate_service)
    {
        $this->translate_service = $translate_service;
    }

    public function index(Request $request)
    {
        $about_me = AboutMe::first();
        return view('admin.about_me.index')->with([
            'about_me' => $about_me
        ]);
    }

    public function update(Request $request)
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
            if ($request->hasFile('image_about')) {
                $arr_image_about_name = explode('.', preg_replace("/\s+/", "-", $request->file('image_about')->getClientOriginalName()));
                $image_about_name = $arr_image_about_name[0] . '-' . time() . '.' . $arr_image_about_name[1];
                $request->file('image_about')->move(public_path('images'), $image_about_name);
                $arr_data_update = array_merge($arr_data_update, [
                    'image_about' => $image_about_name,
                ]);
            }
            if ($request->hasFile('image_event')) {
                $arr_image_event_name = explode('.', preg_replace("/\s+/", "-", $request->file('image_event')->getClientOriginalName()));
                $image_event_name = $arr_image_event_name[0] . '-' . time() . '.' . $arr_image_event_name[1];
                $request->file('image_event')->move(public_path('images'), $image_event_name);
                $arr_data_update = array_merge($arr_data_update, [
                    'image_event' => $image_event_name,
                ]);
            }
            if ($request->hasFile('image_book')) {
                $arr_image_book_name = explode('.', preg_replace("/\s+/", "-", $request->file('image_book')->getClientOriginalName()));
                $image_book_name = $arr_image_book_name[0] . '-' . time() . '.' . $arr_image_book_name[1];
                $request->file('image_book')->move(public_path('images'), $image_book_name);
                $arr_data_update = array_merge($arr_data_update, [
                    'image_book' => $image_book_name,
                ]);
            }
            if ($request->hasFile('image_about_1')) {
                $arr_image_about_1_name = explode('.', preg_replace("/\s+/", "-", $request->file('image_about_1')->getClientOriginalName()));
                $image_about_1_name = $arr_image_about_1_name[0] . '-' . time() . '.' . $arr_image_about_1_name[1];
                $request->file('image_about_1')->move(public_path('images'), $image_about_1_name);
                $arr_data_update = array_merge($arr_data_update, [
                    'image_about_1' => $image_about_1_name ,
                ]);
            }
            if ($request->hasFile('image_about_2')) {
                $arr_image_about_2_name = explode('.', preg_replace("/\s+/", "-", $request->file('image_about_2')->getClientOriginalName()));
                $image_about_2_name = $arr_image_about_2_name[0] . '-' . time() . '.' . $arr_image_about_2_name[1];
                $request->file('image_about_2')->move(public_path('images'), $image_about_2_name);
                $arr_data_update = array_merge($arr_data_update, [
                    'image_about_2' => $image_about_2_name ,
                ]);
            }
            if ($request->hasFile('image_about_3')) {
                $arr_image_about_3_name = explode('.', preg_replace("/\s+/", "-", $request->file('image_about_3')->getClientOriginalName()));
                $image_about_3_name = $arr_image_about_3_name[0] . '-' . time() . '.' . $arr_image_about_3_name[1];
                $request->file('image_about_3')->move(public_path('images'), $image_about_3_name);
                $arr_data_update = array_merge($arr_data_update, [
                    'image_about_3' => $image_about_3_name,
                ]);
            }
            AboutMe::where('id', $id)->update($arr_data_update);
        } else {
            $request->validate([
                'description' => 'required',
                'image_about' => 'required|mimes:jpeg,png,jpg|max:8192',
                'image_event' => 'required|mimes:jpeg,png,jpg|max:8192',
                'image_book' => 'required|mimes:jpeg,png,jpg|max:8192',
                'image_about_1' => 'required|mimes:jpeg,png,jpg|max:8192',
                'image_about_2' => 'required|mimes:jpeg,png,jpg|max:8192',
                'image_about_3' => 'required|mimes:jpeg,png,jpg|max:8192',
            ]);
            $description = $request->get('description') ? $request->get('description') : "";
            $description_en = $this->translate_service->gg_translate('vi', 'en', $description);
            $description_fr = $this->translate_service->gg_translate('vi', 'en', $description);
            $image_about_name = "";
            $image_event_name = "";
            $image_book_name = "";
            $image_about_1_name = "";
            $image_about_2_name = "";
            $image_about_3_name = "";
            if ($request->hasFile('image_about')) {
                $arr_image_about_name = explode('.', preg_replace("/\s+/", "-", $request->file('image_about')->getClientOriginalName()));
                $image_about_name = $arr_image_about_name[0] . '-' . time() . '.' . $arr_image_about_name[1];
                $request->file('image_about')->move(public_path('images'), $image_about_name);
            }
            if ($request->hasFile('image_event')) {
                $arr_image_event_name = explode('.', preg_replace("/\s+/", "-", $request->file('image_event')->getClientOriginalName()));
                $image_event_name = $arr_image_event_name[0] . '-' . time() . '.' . $arr_image_event_name[1];
                $request->file('image_event')->move(public_path('images'), $image_event_name);
            }
            if ($request->hasFile('image_book')) {
                $arr_image_book_name = explode('.', preg_replace("/\s+/", "-", $request->file('image_book')->getClientOriginalName()));
                $image_book_name = $arr_image_book_name[0] . '-' . time() . '.' . $arr_image_book_name[1];
                $request->file('image_book')->move(public_path('images'), $image_book_name);
            }
            if ($request->hasFile('image_about_1')) {
                $arr_image_about_1_name = explode('.', preg_replace("/\s+/", "-", $request->file('image_about_1')->getClientOriginalName()));
                $image_about_1_name = $arr_image_about_1_name[0] . '-' . time() . '.' . $arr_image_about_1_name[1];
                $request->file('image_about_1')->move(public_path('images'), $image_about_1_name);
            }
            if ($request->hasFile('image_about_2')) {
                $arr_image_about_2_name = explode('.', preg_replace("/\s+/", "-", $request->file('image_about_2')->getClientOriginalName()));
                $image_about_2_name = $arr_image_about_2_name[0] . '-' . time() . '.' . $arr_image_about_2_name[1];
                $request->file('image_about_2')->move(public_path('images'), $image_about_2_name);
            }
            if ($request->hasFile('image_about_3')) {
                $arr_image_about_3_name = explode('.', preg_replace("/\s+/", "-", $request->file('image_about_3')->getClientOriginalName()));
                $image_about_3_name = $arr_image_about_3_name[0] . '-' . time() . '.' . $arr_image_about_3_name[1];
                $request->file('image_about_3')->move(public_path('images'), $image_about_3_name);
            }
            AboutMe::create([
                'description' => $description,
                'description_en' => $description_en,
                'description_fr' => $description_fr,
                'image_about' => $image_about_name,
                'image_event' => $image_event_name,
                'image_book' => $image_book_name,
                'image_about_1' => $image_about_1_name,
                'image_about_2' => $image_about_2_name,
                'image_about_3' => $image_about_3_name,
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
        AboutMe::where('id', $id)
            ->update([
                'description_en' => $request->get('description_en'),
                'description_fr' => $request->get('description_fr'),
            ]);

        return redirect()->back()->with('success', 'Sửa Thành Công.');
    }

    public function about_me(Request $request)
    {
        $info = Information::first();
        $about_me = AboutMe::first();
        return view('ui.about_me')->with([
            'info' => $info,
            'about_me' => $about_me
        ]);
    }

    public function detail_about_me(Request $request)
    {
        $point_views = PointView::get()->toArray();
        $info = Information::first();
        $about_me = AboutMe::first();
        return view('ui.detail_about_me')->with([
            'info' => $info,
            'point_views' => $point_views,
            'about_me' => $about_me
        ]);
    }
}
