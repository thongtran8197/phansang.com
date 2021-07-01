<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Information;
use App\Models\Post;
use App\Services\Translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CollectionController extends Controller
{
    protected $translate_service;

    public function __construct(Translate $translate_service)
    {
        $this->translate_service = $translate_service;
    }

    public function index(Request $request)
    {
        $collections = $this->list_collections_paginate();
        return view('admin.collection.index')->with([
            'collections' => $collections
        ]);
    }

    public function add(Request $request)
    {
        return view('admin.collection.add_or_edit');
    }

    public function edit(Request $request, $id)
    {
        $collection = null;

        if ($id) {
            $collection = Collection::find($id);
        }

        return view('admin.collection.add_or_edit')->with([
            'collection' => $collection,
            'collection_id' => $collection['id']
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $name = $request->get('name');
        $description = $request->get('description') ? $request->get('description') : "";

        Collection::create([
            'name' => $request->get('name'),
            'name_en' => $this->translate_service->gg_translate('vi', 'en', $name),
            'name_fr' => $this->translate_service->gg_translate('vi', 'fr', $name),
            'description' => $description,
            'description_en' => $this->translate_service->gg_translate('vi', 'en', $description),
            'description_fr' => $this->translate_service->gg_translate('vi', 'fr', $description),
        ]);
        return redirect()->back()->with('success', 'Thêm Thành Công.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $collection = Collection::find($id);

        if ($collection) {
            $name = $request->get('name');
            $description = $request->get('description') ? $request->get('description') : "";

            Collection::where('id', $id)->update([
                'name' => $request->get('name'),
                'name_en' => $this->translate_service->gg_translate('vi', 'en', $name),
                'name_fr' => $this->translate_service->gg_translate('vi', 'fr', $name),
                'description' => $description,
                'description_en' => $this->translate_service->gg_translate('vi', 'en', $description),
                'description_fr' => $this->translate_service->gg_translate('vi', 'fr', $description),
            ]);
            return redirect()->back()->with('success', 'Sửa Thành Công.');
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        Post::where('collection_id', $id)->delete();
        Collection::find($id)->delete();
        return redirect()->back()->with('success', 'Xóa Thành Công.');
    }

    public function list_collections()
    {
        return Collection::orderBy('id', 'desc')->get()->toArray();
    }

    public function list_collections_paginate()
    {
        return Collection::orderBy('id', 'desc')->paginate(Config::get('constants.paginate_admin'));
    }

    public function collection(Request $request)
    {
        $info = Information::first();
        $collections = DB::table('collections')->join('posts', 'collections.main_post_id', '=', 'posts.id')->select(
            'collections.id as id',
            'collections.name as name',
            'collections.name_en as name_en',
            'collections.name_fr as name_fr',
            'posts.image as image'
        )->orderBy('collections.id', 'desc')->get()->toArray();
        return view('ui.collection')->with([
            'collections' => $collections,
            'info' => $info
        ]);
    }

    public function get_main_post(Request $request, $collection_id)
    {
        $main_post_id = Collection::where('id', $collection_id)->first()['main_post_id'];
        $posts = Post::where('collection_id', $collection_id)->orderBy('created_at', 'desc')->get()->toArray();
        return view('admin.collection.main_post')->with([
            'collection_id' => $collection_id,
            'main_post_id' => $main_post_id,
            'posts' => $posts
        ]);
    }

    public function post_main_post(Request $request, $collection_id)
    {
        Collection::where('id', $collection_id)
            ->update([
                'main_post_id' => $request->get('main_post_id')
            ]);

        $collections = $this->list_collections_paginate();
        return redirect()->route('admin.collection.index', ['collections' => $collections]);
    }

    public function language_content(Request $request, $collection_id)
    {
        $request->validate([
            'name_en' => 'required',
            'name_fr' => 'required',
        ]);
        Collection::where('id', $collection_id)
            ->update([
                'name_en' => $request->get('name_en'),
                'name_fr' => $request->get('name_fr'),
                'description_en' => $request->get('description_en'),
                'description_fr' => $request->get('description_fr'),
            ]);

        return redirect()->back()->with('success', 'Sửa Thành Công.');
    }

    public function get_qr(Request $request, $collection_id)
    {
        if ($collection_id) {
            $host = $request->getHttpHost();
            $url = 'https://' . $host . '/bo-suu-tap';
            $qr = QrCode::format('png')
                ->size(200)->errorCorrection('H')
                ->generate($url);
            return view('admin.collection.get_qr')->with([
                'qr' => $qr
            ]);
        }
    }

    public function collection_v2(Request $request)
    {
        $collections = Collection::orderBy('id', 'desc')->get()->toArray();
        return view('ui.collection_v2')->with([
            "collections" => $collections
        ]);
    }

    public function description_collection_v2(Request $request, $collection_id)
    {
        $collection = DB::table('collections')->join('posts', 'collections.main_post_id', '=', 'posts.id')
            ->where('collections.id', $collection_id)->select(
                'image',
                'collections.name as c_name',
                'collections.name_en as c_name_en',
                'collections.name_fr as c_name_fr',
                'collections.description as c_description',
                'collections.description_en as c_description_en',
                'collections.description_fr as c_description_fr'
            )->first();
        return view('ui.components.description_collection_v2')->with([
            'collection' => $collection,
        ]);
    }

    public function name_collection_v2(Request $request, $collection_id)
    {
        $locate = \Session::get('locale');
        $collection = Collection::find($collection_id);
        $ret = "";
        if ($collection) {
            if ($locate == 'en') {
                $ret =  $collection->name_en;
            } elseif ($locate == 'fr'){
                $ret =  $collection->name_fr;
            } else {
                $ret =  $collection->name;
            }
        }
        return $ret;
    }
}
