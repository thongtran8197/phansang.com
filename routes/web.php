<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
Route::group(['prefix' => 'admin'], function () {
    Route::get('/slider-image', 'Admin\HomeController@index')->name('admin.slider_image.index');
    Route::get('/slider-image/add', 'Admin\HomeController@add')->name('admin.slider_image.add');
    Route::get('/slider-image/edit/{id}', 'Admin\HomeController@edit')->name('admin.slider_image.edit');
    Route::post('/slider-image/create', 'Admin\HomeController@create')->name('admin.slider_image.create');
    Route::put('/slider-image/update/{id}', 'Admin\HomeController@update')->name('admin.slider_image.update');
    Route::delete('/slider-image/destroy/{id}', 'Admin\HomeController@destroy')->name('admin.slider_image.destroy');

    Route::get('/contact', 'Admin\ContactController@index')->name('admin.contact.index');

    Route::get('/collection', 'Admin\CollectionController@index')->name('admin.collection.index');
    Route::get('/collection/add', 'Admin\CollectionController@add')->name('admin.collection.add');
    Route::get('/collection/edit/{id}', 'Admin\CollectionController@edit')->name('admin.collection.edit');
    Route::post('/collection/create', 'Admin\CollectionController@create')->name('admin.collection.create');
    Route::put('/collection/update/{id}', 'Admin\CollectionController@update')->name('admin.collection.update');
    Route::delete('/collection/destroy/{id}', 'Admin\CollectionController@destroy')->name('admin.collection.destroy');
    Route::get('/collection/main_post/{collection_id}', 'Admin\CollectionController@get_main_post')->name('admin.collection.get_main_post');
    Route::post('/collection/main_post/{collection_id}', 'Admin\CollectionController@post_main_post')->name('admin.collection.post_main_post');
    Route::put('/collection/language_content/{collection_id}', 'Admin\CollectionController@language_content')->name('admin.collection.language_content');
    Route::get('/collection/get-qr/{collection_id}', 'Admin\CollectionController@get_qr')->name('admin.collection.get_qr');

    Route::get('/post/{collection_id}', 'Admin\PostController@index')->name('admin.post.index');
    Route::get('/collection-post1/add/{collection_id}', 'Admin\PostController@add')->name('admin.post.add');
    Route::get('/collection-post/edit/{id}', 'Admin\PostController@edit')->name('admin.post.edit');
    Route::post('/collection-post/create', 'Admin\PostController@create')->name('admin.post.create');
    Route::put('/collection-post/update/{id}', 'Admin\PostController@update')->name('admin.post.update');
    Route::delete('/collection-post/destroy/{id}', 'Admin\PostController@destroy')->name('admin.post.destroy');
    Route::put('/collection-post/language_content/{post_id}', 'Admin\PostController@language_content')->name('admin.post.language_content');
    Route::get('/collection-post/get-qr/{post_id}', 'Admin\PostController@get_qr')->name('admin.post.get_qr');


    Route::get('/studio', 'Admin\StudioController@index')->name('admin.studio.index');
    Route::get('/studio/add', 'Admin\StudioController@add')->name('admin.studio.add');
    Route::get('/studio/edit/{id}', 'Admin\StudioController@edit')->name('admin.studio.edit');
    Route::post('/studio/create', 'Admin\StudioController@create')->name('admin.studio.create');
    Route::put('/studio/update/{id}', 'Admin\StudioController@update')->name('admin.studio.update');
    Route::delete('/studio/destroy/{id}', 'Admin\StudioController@destroy')->name('admin.studio.destroy');
    Route::get('/studio/info', 'Admin\StudioController@get_studio_info')->name('admin.studio.get_studio_info');
    Route::post('/studio/info/update', 'Admin\StudioController@post_studio_info')->name('admin.studio.post_studio_info');
    Route::put('/studio/info/language_content/{id}', 'Admin\StudioController@language_content')->name('admin.studio_info.language_content');

    Route::get('/information', 'Admin\InformationController@index')->name('admin.information.index');
    Route::post('/information/update', 'Admin\InformationController@update')->name('admin.information.update');

    Route::get('/point-view', 'Admin\PointViewController@index')->name('admin.point_view.index');
    Route::get('/point-view/add', 'Admin\PointViewController@add')->name('admin.point_view.add');
    Route::get('/point-view/edit/{id}', 'Admin\PointViewController@edit')->name('admin.point_view.edit');
    Route::post('/point-view/create', 'Admin\PointViewController@create')->name('admin.point_view.create');
    Route::put('/point-view/update/{id}', 'Admin\PointViewController@update')->name('admin.point_view.update');
    Route::delete('/point-view/destroy/{id}', 'Admin\PointViewController@destroy')->name('admin.point_view.destroy');
    Route::put('/point_view/language_content/{id}', 'Admin\PointViewController@language_content')->name('admin.point_view.language_content');

    Route::get('/about-me', 'Admin\AboutMeController@index')->name('admin.about_me.index');
    Route::post('/about-me/update', 'Admin\AboutMeController@update')->name('admin.about_me.update');

    Route::get('/event', 'Admin\EventController@index')->name('admin.event.index');
    Route::get('/event/add', 'Admin\EventController@add')->name('admin.event.add');
    Route::get('/event/edit/{id}', 'Admin\EventController@edit')->name('admin.event.edit');
    Route::post('/event/create', 'Admin\EventController@create')->name('admin.event.create');
    Route::put('/event/update/{id}', 'Admin\EventController@update')->name('admin.event.update');
    Route::delete('/event/destroy/{id}', 'Admin\EventController@destroy')->name('admin.event.destroy');

    Route::get('/book', 'Admin\BookController@index')->name('admin.book.index');
    Route::get('/book/add', 'Admin\BookController@add')->name('admin.book.add');
    Route::get('/book/edit/{id}', 'Admin\BookController@edit')->name('admin.book.edit');
    Route::post('/book/create', 'Admin\BookController@create')->name('admin.book.create');
    Route::put('/book/update/{id}', 'Admin\BookController@update')->name('admin.book.update');
    Route::delete('/book/destroy/{id}', 'Admin\BookController@destroy')->name('admin.book.destroy');
    Route::put('/book/language_content/{id}', 'Admin\BookController@language_content')->name('admin.book.language_content');


    Route::get('/user/change_password', 'Admin\UserController@get_view_change_password')->name('admin.user.get_view_change_password');
    Route::put('/book/change_password/{user_id}', 'Admin\UserController@change_password')->name('admin.user.change_password');

    Route::get('/new', 'Admin\NewsController@index')->name('admin.new.index');
    Route::get('/new/add', 'Admin\NewsController@add')->name('admin.new.add');
    Route::get('/new/edit/{id}', 'Admin\NewsController@edit')->name('admin.new.edit');
    Route::post('/new/create', 'Admin\NewsController@create')->name('admin.new.create');
    Route::put('/new/update/{id}', 'Admin\NewsController@update')->name('admin.new.update');
    Route::delete('/new/destroy/{id}', 'Admin\NewsController@destroy')->name('admin.new.destroy');
    Route::put('/new/language_content/{id}', 'Admin\NewsController@language_content')->name('admin.new.language_content');

    Route::get('/new-about-me', 'Admin\NewAboutMeController@index')->name('admin.new_about_me.index');
    Route::post('/new-about-me/update', 'Admin\NewAboutMeController@update')->name('admin.new_about_me.update');
    Route::put('/new-about-me/language_content/{id}', 'Admin\NewAboutMeController@language_content')->name('admin.new_about_me.language_content');


    Route::get('/contact_image/get_contact_image', 'Admin\ContactController@get_contact_image')->name('admin.contact_image.get_contact_image');
    Route::post('/contact_image/update_contact_image', 'Admin\ContactController@update_contact_image')->name('admin.contact_image.update_contact_image');
});

Route::group(['prefix' => ''], function () {
    Route::get('locale/{locale}', function ($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    });
    Route::get('switch-mode', function (){
        if (session()->has('is_dark')) {
            session()->put('is_dark', !session('is_dark'));
        }
        else {
            session()->put('is_dark', true);
        }
        return redirect()->back();
    });
   	Route::get('/', 'Admin\HomeController@home')->name('ui.index');
    Route::get('/test', 'Admin\HomeController@test')->name('ui.test');
    Route::get('/lien-he', 'Admin\ContactController@contact')->name('ui.contact');
    Route::get('/gioi-thieu', 'Admin\NewAboutMeController@about_me')->name('ui.about_me');
    Route::get('/bo-suu-tap', 'Artist\CollectionController@index')->name('ui.collection_v2');
    Route::get('/bo-suu-tap/{collection_id}', 'Artist\CollectionController@index')->name('ui.collection.v3');
    Route::get('/mo-ta-bo-suu-tap-v2/{collection_id}', 'Admin\CollectionController@description_collection_v2')->name('ui.description_collection_v2');
    Route::get('/ten-bo-suu-tap-v2/{collection_id}', 'Admin\CollectionController@name_collection_v2')->name('ui.name_collection_v2');
    Route::get('/tac-pham/{collection_id}', 'Admin\PostController@posts_by_collection')->name('ui.post');
    Route::get('/mo-ta-tac-pham/{post_id}', 'Admin\PostController@get_detail_post')->name('ui.detail_post');
    Route::get('/studio', 'Admin\StudioController@studio')->name('ui.studio');
    Route::get('/sach', 'Admin\BookController@book')->name('ui.book');
    Route::get('/su-kien', 'Admin\EventController@event')->name('ui.event');
    Route::post('/lien-he/gui', 'Admin\ContactController@create')->name('contact.create');
    Route::get('/tin-tuc', 'Admin\NewsController@news')->name('ui.news');

});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');
