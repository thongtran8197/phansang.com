<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Information;
use App\Models\Post;
use App\Services\Translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class BookController extends Controller
{
    protected $translate_service;

    public function __construct(Translate $translate_service)
    {
        $this->translate_service = $translate_service;
    }

    public function index(Request $request)
    {
        $books = $this->list_books_paginate();
        return view('admin.book.index')->with([
            'books' => $books
        ]);
    }

    public function add(Request $request)
    {
        return view('admin.book.add_or_edit');
    }

    public function edit(Request $request, $id)
    {
        $book = null;

        if ($id) {
            $book = Book::find($id);
        }

        return view('admin.book.add_or_edit')->with([
            'book' => $book
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg|max:8096',
            'link' => 'required',
        ]);
        $name = $request->get('name');
        $name_en = $this->translate_service->gg_translate('vi', 'en', $name);
        $name_fr = $this->translate_service->gg_translate('vi', 'fr', $name);
        $description = $request->get('description') ? $request->get('description') : "";
        $description_en = $this->translate_service->gg_translate('vi', 'en', $description);
        $description_fr = $this->translate_service->gg_translate('vi', 'fr', $description);
        $image_name = "";
        if ($request->hasFile('image')) {
            $arr_image_name = explode('.',  preg_replace("/\s+/","-",$request->file('image')->getClientOriginalName()));
            $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
            $request->file('image')->move(public_path('images'), $image_name);
        }
        Book::create([
            'image' => $image_name,
            'name' => $name,
            'name_en' => $name_en,
            'name_fr' => $name_fr,
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
            'name' => 'required',
            'description' => 'required',
            'link' => 'required',
        ]);

        $book = Book::find($id);

        if ($book) {
            $name = $request->get('name');
            $description = $request->get('description') ? $request->get('description') : "";
            $arr_update_data = [
                'name' => $name,
                'name_en' => $this->translate_service->gg_translate('vi', 'en', $name),
                'name_fr' => $this->translate_service->gg_translate('vi', 'en', $name),
                'description' => $description,
                'description_en' => $this->translate_service->gg_translate('vi', 'en', $description),
                'description_fr' => $this->translate_service->gg_translate('vi', 'fr', $description),
            ];
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|mimes:jpeg,png,jpg|max:8096',
                ]);
                $arr_image_name = explode('.', preg_replace("/\s+/","-",$request->file('image')->getClientOriginalName()));
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('images'), $image_name);
                //delete old image
                if (file_exists(public_path('images/') . $book['image'])) {
                    unlink(public_path('images/') . $book['image']);
                }
                $arr_update_data = array_merge($arr_update_data, [
                    'image' => $image_name,
                ]);
            }
            Book::where('id', $id)->update($arr_update_data);
            return redirect()->back()->with('success', 'Sửa Thành Công.');
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $book = Book::find($id);
        if ($book) {
            //delete old image
            if (file_exists(public_path('images/') . $book['image'])) {
                unlink(public_path('images/') . $book['image']);
            }
            $book->delete();
        }
        return redirect()->back()->with('success', 'Xóa Thành Công.');
    }

    public function list_books_paginate()
    {
        return Book::orderBy('id', 'desc')->paginate(Config::get('constants.paginate_admin'));
    }

    public function language_content(Request $request, $id)
    {
        Book::where('id', $id)
            ->update([
                'name_en' => $request->get('name_en'),
                'name_fr' => $request->get('name_fr'),
                'description_en' => $request->get('description_en'),
                'description_fr' => $request->get('description_fr'),
            ]);

        return redirect()->back()->with('success', 'Sửa Thành Công.');
    }

    public function book()
    {
        $books = Book::get()->toArray();
        $info = Information::first();
        return view('ui.book')->with([
            'books' => $books,
            'info' => $info
        ]);
    }

}
