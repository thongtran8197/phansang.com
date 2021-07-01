@extends('ui.master')
@section('content')
        <?php $is_dark = \Session::get('is_dark'); ?>
        <?php $locate = \Session::get('locale');?>
        <div id="<?php echo($is_dark ? "" : "dark-mode")?>" class="content-holder elem scale-bg2 transition3 post-content-holder">
            <div class="overlay-content">
            <div class="content full-height custom-post-content">
                <div class="show-hid-content post-show-hid-content isshow" style="z-index: 1001">{{ __('labels.description') }} <i class="fa fa-long-arrow-down"></i></div>
                <div class="post-fixed-info-container fixed-info-container hidden-column">
                    @if($locate == 'en')
                        <h3>{{$collection->c_name_en}}</h3>
                    @elseif($locate == 'fr')
                        <h3>{{$collection->c_name_fr}}</h3>
                    @else
                        <h3>{{$collection->c_name}}</h3>
                    @endif
                    <div class="separator"></div>
                    <div class="clearfix"></div>
                    @if($locate == 'en')
                        <p>{!! nl2br(e($collection->c_description_en))!!}</p>
                    @elseif($locate == 'fr')
                        <p>{!! nl2br(e($collection->c_description_fr))!!}</p>
                    @else
                        <p>{!! nl2br(e($collection->c_description))!!}</p>
                    @endif
                    <div class="post-img-info-container img-info-container">
                        <img src="{{ asset('images/'.$collection->image) }}" />
                    </div>
                </div>
                <div class="post-resize-carousel resize-carousel-holder anim-holder">
                    <div class="p_horizontal_wrap">
                        <div id="portfolio_horizontal_container" style="height: calc(100% - 10px);">
                            @foreach($posts as $post)
                                <div class="portfolio_item collection_portfolio_item">
                                    @if($locate == 'en')
                                        <div class="zoomimage" style="z-index: 100;" data-magnify="gallery"
                                             data-caption="{{$post['name_en'] ?? ""}}"
                                             href="{{ asset('images/'.($post['image'] ?? "")) }}">
                                            <i class="fa fa-expand"></i>
                                        </div>
                                    @elseif($locate == 'fr')
                                        <div class="zoomimage" style="z-index: 100;" data-magnify="gallery"
                                             data-caption="{{$post['name_fr'] ?? ""}}"
                                             href="{{ asset('images/'.($post['image'] ?? "")) }}">
                                            <i class="fa fa-expand"></i>
                                        </div>
                                    @else
                                        <div class="zoomimage" style="z-index: 100;" data-magnify="gallery"
                                             data-caption="{{$post['name'] ?? ""}}"
                                             href="{{ asset('images/'.($post['image'] ?? "")) }}">
                                            <i class="fa fa-expand"></i>
                                        </div>
                                    @endif
                                    <a>
                                      <img src="{{ asset('images/'.($post['image'] ?? "")) }}" alt="">
                                    </a>
                                    <div class="port-desc-holder collection-port-desc-holder">
                                        <div class="port-desc">
                                            <div class="overlay"></div>
                                        </div>
                                    </div>
                                    <div class="show-info" style="z-index: 100">
                                        <span>Info</span>
                                        <div class="tooltip-info">
                                            @if($locate == 'en')
                                                <p>{!! nl2br(e($post['description_en'] ?? ""))!!}</p>
                                            @elseif($locate == 'fr')
                                                <p>{!! nl2br(e($post['description_fr'] ?? ""))!!}</p>
                                            @else
                                                <p>{!! nl2br(e($post['description'] ?? ""))!!}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="post-name">
                    @if($locate == 'en')
                        {{$collection->c_name_en ?? ""}}
                    @elseif($locate == 'fr')
                        {{$collection->c_name_fr ?? ""}}
                    @else
                        {{$collection->c_name ?? ""}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
