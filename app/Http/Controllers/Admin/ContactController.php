<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMe;
use App\Models\Contact;
use App\Models\ContactImage;
use App\Models\Information;
use App\Models\SliderImage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $contacts = Contact::orderBy('id', 'desc')->paginate(15);
        return view('admin.contact.index')->with([
            'contacts' => $contacts
        ]);
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'message' => 'required',
            'email' => 'required',
        ]);

        Contact::create([
            'name' => $request->get('name'),
            'message' => $request->get('message'),
            'email' => $request->get('email'),
        ]);
        return redirect()->back()->with('success','Thêm Thành Công.');
    }

    public function contact(Request $request)
    {
        $contact_image = ContactImage::first();
        $info = Information::first();
        return view('ui.contact')->with([
            'info'=> $info,
            'contact_image' => $contact_image
        ]);
    }

    public function get_contact_image(Request $request){
        $contact_image = ContactImage::first();
        return view('admin.contact_image.index')->with([
            'contact_image' => $contact_image
        ]);
    }

    public function update_contact_image(Request $request){
        $id = $request->get('id');
        if ($id) {
            $contact_image = ContactImage::find($id);
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|mimes:jpeg,png,jpg|max:8096',
                ]);
                $arr_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('image')->getClientOriginalName()));
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('images'), $image_name);
                //delete old image
                if (file_exists(public_path('images/') . $contact_image['image'])) {
                    unlink(public_path('images/') . $contact_image['image']);
                }
                $arr_update_data = [
                    'image' => $image_name,
                ];
                ContactImage::where('id', $id)->update($arr_update_data);
            }
        } else {
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|mimes:jpeg,png,jpg|max:8096',
                ]);
                $arr_image_name = explode('.', preg_replace("/\s+/", "-", $request->file('image')->getClientOriginalName()));
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('images'), $image_name);
                ContactImage::create([
                   'image' =>  $image_name,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Sửa Thành Công.');
    }
}
