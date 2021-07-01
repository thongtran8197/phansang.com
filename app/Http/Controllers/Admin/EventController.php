<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Information;
use App\Models\SliderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class EventController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $events = $this->list_events_paginate();
        return view('admin.event.index')->with([
            'events' => $events
        ]);
    }

    public function add(Request $request)
    {
        return view('admin.event.add_or_edit');
    }

    public function edit(Request $request, $id)
    {
        $event = null;

        if ($id) {
            $event = Event::find($id);
        }

        return view('admin.event.add_or_edit')->with([
            'event' => $event
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg|max:8096',
        ]);
        $image_name = "";
        if ($request->hasFile('image')) {
            $arr_image_name = explode('.', preg_replace("/\s+/","-",$request->file('image')->getClientOriginalName()));
            $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
            $request->file('image')->move(public_path('images'), $image_name);
        }
        Event::create([
            'image' => $image_name,
        ]);
        return redirect()->back()->with('success', 'Thêm Thành Công.');
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        if ($event) {
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|mimes:jpeg,png,jpg|max:8096',
                ]);
                $arr_image_name = explode('.', preg_replace("/\s+/", "-" ,$request->file('image')->getClientOriginalName()));
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('images'), $image_name);
                // delete old image
                if (file_exists(public_path('images/') . $event['image'])) {
                    unlink(public_path('images/') . $event['image']);
                }
                Event::where('id', $id)->update([
                    'image' => $image_name
                ]);
                return redirect()->back()->with('success', 'Sửa Thành Công.');
            }
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $event = Event::find($id);
        if ($event) {
            if (file_exists(public_path('images/') . $event['image'])) {
                unlink(public_path('images/') . $event['image']);
            }
            $event->delete();
        }
        return redirect()->back()->with('success', 'Xóa Thành Công.');
    }

    public function list_events_paginate()
    {
        return Event::orderBy('id', 'desc')->paginate(Config::get('constants.paginate_admin'));
    }

    public function event()
    {
        $info = Information::first();
        $events = Event::get()->toArray();
        return view('ui.event')->with([
            'info' => $info,
            'events' => $events,
        ]);
    }
}
