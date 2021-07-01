@extends('ui.master')
@section('content')
    <?php $is_dark = \Session::get('is_dark'); ?>
    <?php $locate = \Session::get('locale');?>
    <?php $length_slider_images = (count($slider_images) > 1) ? 1 : 0;?>
    <div class="content-holder elem scale-bg2 transition3 slid-hol" id="<?php echo($is_dark ? "dark-mode" : "")?>">
        <div class="content full-height">
            <div class="full-height-wrap home-bg">
                <div class="swiper-container" id="horizontal-slider" data-mwc="0" data-mwa="<?php echo($length_slider_images ? "1" : "")?>">
                    <div class="swiper-wrapper">
                        @foreach($slider_images as $slider_image)
                            <div class="swiper-slide">
                                <div class="bg" style="background-image:url({{ asset('images/'.$slider_image) }})"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if($length_slider_images)
                    <div class="swiper-nav-holder hor hs hs-custom">
                        <a class="swiper-nav arrow-left custom-arrow-left transition " href="#"><i class="fa fa-angle-left"></i></a>
                        <div class="pagination pagination-custom"></div>
                        <a class="swiper-nav  arrow-right custom-arrow-right transition" href="#"><i class="fa fa-angle-right"></i></a>
                    </div>
                @endif
            </div>
        </div>
@endsection
