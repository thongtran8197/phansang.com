<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Post;
use App\Services\Translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PostController extends Controller
{
    protected $translate_service;

    public function __construct(Translate $translate_service)
    {
        $this->translate_service = $translate_service;
    }

    public function index(Request $request, $collection_id)
    {
        $posts = $this->list_posts_paginate($collection_id);
        return view('admin.post.index')->with([
            'collection_id' => $collection_id,
            'posts' => $posts
        ]);
    }

    public function add(Request $request, $collection_id)
    {
        return view('admin.post.add_or_edit')->with([
            'collection_id' => $collection_id
        ]);
    }

    public function edit(Request $request, $id)
    {
        $post = null;

        if ($id) {
            $post = Post::find($id);
        }

        return view('admin.post.add_or_edit')->with([
            'post' => $post
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg|max:8096',
        ]);
        $collection_id = (int)$request->get('collection_id');
        $image_name = "";
        $compress_image = "";
        if ($request->hasFile('image')) {
            $arr_image_name = explode('.', $request->file('image')->getClientOriginalName());
            $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
            $request->file('image')->move(public_path('images'), $image_name);

            $img = Image::make(public_path().'/images/'.$image_name);
            $img->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode(null,75);
            $compress_image = 'compress_'.$image_name;
            $img->save(public_path().'/images/'. $compress_image);
        }
        Post::create([
            'image' => $image_name,
            'compress_image' => $compress_image,
            'collection_id' => $collection_id,
            'description' => $request->get('description') ? $request->get('description') : "",
            'description_en' => $request->get('description_en') ? $request->get('description_en') : "",
            'description_fr' => "",
            'detail' => $request->get('detail') ? $request->get('detail') : "",
            'detail_en' => $request->get('detail_en') ? $request->get('detail_en') : "",
            'detail_fr' => "",
            'name' => $request->get('name') ? $request->get('name') : "",
            'name_en' => $request->get('name_en') ? $request->get('name_en') : "",
            'name_fr' => "",
        ]);
        return redirect()->back()->with('success', 'Th??m Th??nh C??ng.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $post = Post::find($id);

        if ($post) {
            $arr_update_data = [
                'description' => $request->get('description') ? $request->get('description') : "",
                'description_en' => $request->get('description_en') ? $request->get('description_en') : "",
                'description_fr' => "",
                'detail' => $request->get('detail') ? $request->get('detail') : "",
                'detail_en' => $request->get('detail_en') ? $request->get('detail_en') : "",
                'detail_fr' => "",
                'name' => $request->get('name') ? $request->get('name') : "",
                'name_en' => $request->get('name_en') ? $request->get('name_en') : "",
                'name_fr' => "",
            ];
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|mimes:jpeg,png,jpg|max:8096',
                ]);
                $arr_image_name = explode('.', $request->file('image')->getClientOriginalName());
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('images'), $image_name);

                $img = Image::make(public_path().'/images/'.$image_name);
                $img->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode(null,75);
                $compress_image = 'compress_'.$image_name;
                $img->save(public_path().'/images/'. $compress_image);
                //delete old image and compress image
                if (file_exists(public_path('images/') . $post['image'])) {
                    unlink(public_path('images/') . $post['image']);
                    unlink(public_path('images/') . $post['compress_image']);
                }
                $arr_update_data = array_merge($arr_update_data, [
                    'image' => $image_name,
                    'compress' => $compress_image,
                ]);
            }
            Post::where('id', $id)->update($arr_update_data);
            return redirect()->back()->with('success', 'S???a Th??nh C??ng.');
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post) {
            //delete old image
            if (file_exists(public_path('images/') . $post['image'])) {
                unlink(public_path('images/') . $post['image']);
            }
            $post->delete();
        }
        return redirect()->back()->with('success', 'X??a Th??nh C??ng.');
    }

    public function list_posts_paginate($collection_id)
    {
        return Post::where('collection_id', $collection_id)->orderBy('id', 'desc')->paginate(Config::get('constants.paginate_admin'));
    }

    public function posts_by_collection(Request $request, $collection_id)
    {
        $posts = Post::where('collection_id', $collection_id)->orderBy('id', 'desc')->paginate(2);

        return view('ui.components.image_collection_v2')->with([
            'posts' => $posts,
        ]);
    }

    public function get_qr(Request $request, $post_id)
    {
        if ($post_id) {
            $host = $request->getHttpHost();
            $url = 'https://' . $host . '/mo-ta-tac-pham/' . $post_id;
            $qr = QrCode::format('png')
                ->size(200)->errorCorrection('H')
                ->generate($url);
            return view('admin.post.get_qr')->with([
                'qr' => $qr
            ]);
        }
    }

    public function get_detail_post(Request $request, $post_id)
    {
        $post = null;
        $collection = null;
        if ($post_id) {
            $post = Post::find($post_id);
            $collection = Collection::find($post->collection_id);
        }
        return view('ui.detail_post_v2')->with([
            'post' => $post,
            'collection' => $collection
        ]);
    }
}
