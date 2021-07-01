@extends('ui.master')
@section('content')
    <?php $is_dark = \Session::get('is_dark'); ?>
<?php $locate = \Session::get('locale');?>
<div class="content-holder elem scale-bg2 transition3 slid-hol" id="<?php echo($is_dark ? "dark-mode" : "")?>">
    <div class="content full-height studio-content">
        <div class="full-height-wrap">
            <div class="swiper-container" id="horizontal-slider" data-mwc="1" data-mwa="0">
                <div class="swiper-wrapper studio-swiper-wrapper">
                    @foreach($events as $event)
                    <div class="swiper-slide studio-swiper-slide">
                        <div class="bg" style="background-image:url({{asset('images/'.($event['image'] ?? ''))}})"></div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="pagination"></div>
            <div class="swiper-nav-holder hor hs">
                <a class="swiper-nav swiper-nav-custom arrow-left transition " href="#"><i class="fa fa-angle-left"></i></a>
                <a class="swiper-nav swiper-nav-custom arrow-right transition" href="#"><i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </div>
 </div>

@endsection
