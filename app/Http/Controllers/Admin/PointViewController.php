<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointView;
use App\Services\Translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PointViewController extends Controller
{
    protected $translate_service;

    public function __construct(Translate $translate_service)
    {
        $this->translate_service = $translate_service;
    }

    public function index(Request $request)
    {
        $point_views = $this->list_point_views_paginate();
        return view('admin.point_view.index')->with([
            'point_views' => $point_views
        ]);
    }

    public function add(Request $request)
    {
        return view('admin.point_view.add_or_edit');
    }

    public function edit(Request $request, $id)
    {
        $point_view = null;

        if ($id) {
            $point_view = PointView::find($id);
        }

        return view('admin.point_view.add_or_edit')->with([
            'point_view' => $point_view
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'point_view' => 'required',
        ]);
        $point_view = $request->get('point_view');
        $point_view_en = $this->translate_service->gg_translate('vi', 'en', $point_view);
        $point_view_fr =  $this->translate_service->gg_translate('vi', 'fr', $point_view);
        PointView::create([
            'point_view' => $point_view,
            'point_view_en' => $point_view_en,
            'point_view_fr' => $point_view_fr,
        ]);
        return redirect()->back()->with('success','Thêm Thành Công.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'point_view' => 'required',
        ]);
        $point_view = PointView::find($id);
        if ($point_view) {
            $point_view = $request->get('point_view');
            $point_view_en = $this->translate_service->gg_translate('vi', 'en', $point_view);
            $point_view_fr =  $this->translate_service->gg_translate('vi', 'fr', $point_view);
            PointView::where('id', $id)->update([
                'point_view' => $point_view,
                'point_view_en' => $point_view_en,
                'point_view_fr' => $point_view_fr,
            ]);
            return redirect()->back()->with('success','Sửa Thành Công.');
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        PointView::find($id)->delete();
        return redirect()->back()->with('success','Xóa Thành Công.');
    }

    public function list_point_views_paginate()
    {
        return PointView::orderBy('id', 'desc')->paginate(Config::get('constants.paginate_admin'));
    }

    public function language_content(Request $request, $id){
        $request->validate([
            'point_view_en' => 'required',
            'point_view_fr' => 'required',
        ]);
        PointView::where('id', $id)
            ->update([
                'point_view_en' => $request->get('point_view_en'),
                'point_view_en' => $request->get('point_view_en'),
            ]);

        return redirect()->back()->with('success','Sửa Thành Công.');
    }
}
