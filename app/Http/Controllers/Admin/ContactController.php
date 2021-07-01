<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMe;
use App\Models\Contact;
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
        $about_me = AboutMe::first();
        $info = Information::first();
        return view('ui.contact')->with([
            'info'=> $info,
            'about_me' => $about_me
        ]);
    }
}
