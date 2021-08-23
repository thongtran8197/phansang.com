@extends('ui.master')
@section('content')
    <?php $is_dark = \Session::get('is_dark'); ?>
    <?php $locate = \Session::get('locale');?>
    <div id="<?php echo($is_dark ? "dark-mode" : "")?>" class="content-holder elem scale-bg2 transition3" >
        <div class="content studio-custom-content">
            <div class="gallery-sub-header">
                <div class="hAvatar">
                    <img class="hAvatar-img" src="{{ asset('images/'. ($studio_info['image'] ?? '')) }}">
                    <div class="hAvatar-desc">
                        <h3 class="title-desc">My Studio</h3>
                        @if($locate == 'en')
                            <p class="content-desc">{!! nl2br(e($studio_info['description_en'] ?? ''))!!}</p>
                        @elseif($locate == 'fr')
                            <p class="content-desc">{!! nl2br(e($studio_info['description_fr'] ?? ''))!!}</p>
                        @else
                            <p class="content-desc">{!! nl2br(e($studio_info['description'] ?? ''))!!}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="gallery-items hid-port-info grid-small-pad studio-gallery-items">
                <?php $length_studio = count($studios)?>
                @foreach($studios as $index => $studio)
                <div class="gallery-item {{ ($index == 4 && $length_studio ? "gallery-item-second" : "") }}">
                    <div class="grid-item-holder">
                        @if ($studio['type'] == 1)
                            <div class="box-item">
                                <span class="overlay collection-overlay"></span>
                                <div class="zoomimage" data-caption="studio" data-magnify="gallery" href="{{ asset('images/'. ($studio['link_studio'] ?? '')) }}"><i class="fa fa-expand"></i></div>
                                <a>
                                    <img class="{{ ($index == 4 && $length_studio ? "studio-img-large" : "studio-img") }}" src="{{ asset('images/'. ($studio['link_studio'] ?? '')) }}" alt="">
                                </a>
                            </div>
                        @elseif($studio['type'] == 2)
                            <div class="box-item">
                                <video class="{{ ($index == 4 && $length_studio ? "studio-video-large" : "studio-video") }}" controls>
                                    <source src="{{ asset('videos/'.($studio['link_studio'] ?? '')) }}">
                                    Your browser does not support HTML video.
                                </video>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
@endsection
