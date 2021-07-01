<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $info = Information::first();
        return view('admin.information.index')->with([
            'info' => $info
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'gmail' => 'required',
            'address' => 'required',
            'link_fb' => 'required',
            'link_instagram' => 'required',
            'link_twitter' => 'required',
            'birthday' => 'required',
            'country' => 'required',
            'graduation' => 'required',
        ]);
        $id = $request->get('id');
        if ($id){
            Information::where('id', $id)
                ->update([
                    'name' => $request->get('name'),
                    'phone_number' => $request->get('phone_number'),
                    'gmail' => $request->get('gmail'),
                    'address' => $request->get('address'),
                    'link_fb' => $request->get('link_fb'),
                    'link_instagram' => $request->get('link_instagram'),
                    'link_twitter' => $request->get('link_twitter'),
                    'birthday' => $request->get('birthday'),
                    'country' => $request->get('country'),
                    'graduation' => $request->get('graduation')
                ]);
        }else{
            Information::create([
                'name' => $request->get('name'),
                'phone_number' => $request->get('phone_number'),
                'gmail' => $request->get('gmail'),
                'address' => $request->get('address'),
                'link_fb' => $request->get('link_fb'),
                'link_instagram' => $request->get('link_instagram'),
                'link_twitter' => $request->get('link_twitter'),
                'birthday' => $request->get('birthday'),
                'country' => $request->get('country'),
                'graduation' => $request->get('graduation')
            ]);
        }
        return redirect()->back()->with("message", "Thành Công");
    }
}
