@extends('ui.master')
@section('content')
        <?php $is_dark = \Session::get('is_dark'); ?>
        <?php $locate = \Session::get('locale');?>
        <div id="<?php echo($is_dark ? "dark-mode" : "")?>" class="content-holder elem scale-bg2 transition3">
            <div class="overlay-content">
            <div class="content full-height custom-post-content">
                <div class="detail-post-holder resize-carousel-holder anim-holder">
                    <div id="gallery_horizontal" class="gallery_horizontal">
                        <div class="horizontal_item">
                            @if($locate == 'en')
                                <h3 class="detail-post-header" style="font-size: 2em; text-align: start;">{{$post['name_en'] ? $post['name_en'] : $collection['name_en']}}</h3>
                            @elseif($locate == 'fr')
                                <h3 class="detail-post-header" style="font-size: 2em; text-align: start;">{{$post['name_fr'] ? $post['name_fr'] : $collection['name_fr']}}</h3>
                            @else
                                <h3 class="detail-post-header" style="font-size: 2em; text-align: start;">{{$post['name'] ? $post['name'] : $collection['name']}}</h3>
                            @endif
                        </div>
                        <div class="horizontal_item">
                            @if($locate == 'en')
                                <div class="zoomimage" data-caption="{{$post['name_en'] ?? ""}}" data-magnify="gallery" href="{{ asset('images/'.($post['image'] ?? "")) }}"><i class="fa fa-expand"></i></div>
                            @elseif($locate == 'fr')
                                <div class="zoomimage" data-caption="{{$post['name_fr'] ?? ""}}" data-magnify="gallery" href="{{ asset('images/'.($post['image'] ?? "")) }}"><i class="fa fa-expand"></i></div>
                            @else
                                <div class="zoomimage" data-caption="{{$post['name'] ?? ""}}" data-magnify="gallery" href="{{ asset('images/'.($post['image'] ?? "")) }}"><i class="fa fa-expand"></i></div>
                            @endif
                            <a>
                              <img src="{{ asset('images/'.($post['image'] ?? "")) }}" alt="">
                            </a>
                        </div>
                        <div class="horizontal_item">
                            @if($locate == 'en')
                                <p class="detail-post-name">{!! nl2br(e($post['detail_en'] ?? ""))!!}</p>
                            @elseif($locate == 'fr')
                                <p class="detail-post-name">{!! nl2br(e($post['detail_fr'] ?? ""))!!}</p>
                            @else
                                <p class="detail-post-name">{!! nl2br(e($post['detail'] ?? ""))!!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
