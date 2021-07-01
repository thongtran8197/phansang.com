@extends('ui.master')
@section('content')
    <?php $is_dark = \Session::get('is_dark'); ?>
<?php $locate = \Session::get('locale');?>
<div class="content-holder elem scale-bg2 transition3 slid-hol" id="<?php echo($is_dark ? "dark-mode" : "")?>">
    <div class="content full-height studio-content">
        <div class="full-height-wrap studio-content-wrapper">
            <div class="swiper-container" id="horizontal-slider" data-mwc="1" data-mwa="0">
                <div class="swiper-wrapper studio-swiper-wrapper">
                @foreach($books as $book)
                    <div class="swiper-slide studio-swiper-slide">
                        <section class="section-columns studio-section-column" id="sec1">
                            <div class="section-columns-img studio-column-img">
                                <div class="bg" style="background-image:url({{asset('images/'.($book['image'] ?? ""))}})" ></div>
                            </div>
                            <div class="section-columns-text studio-column-text">
                                <div class="studio-content-container">
                                    <div class="studio-header">
                                        @if($locate == 'en')
                                            <div class="hContent">{{$book['name_en']}}</div>
                                        @elseif($locate == 'fr')
                                            <div class="hContent">{{$book['name_fr']}}</div>
                                        @else
                                            <div class="hContent">{{$book['name']}}</div>
                                        @endif
                                    </div>
                                    <div class="studio-body">
                                        @if($locate == 'en')
                                            <div class="hContent">{!! nl2br(e($book['description_en']))!!}</div>
                                        @elseif($locate == 'fr')
                                            <div class="hContent">{!! nl2br(e($book['description_fr']))!!}</div>
                                        @else
                                            <div class="hContent">{!! nl2br(e($book['description']))!!}</div>
                                        @endif
                                    </div>
                                    <div class="studio-footer">
                                        <div class="fContent">
                                            <a href="{{$book['link']}}" target="_blank"><i class="fa fa-download"></i> downLoad</a>
                                        <div>
                                    </div>
                                </div>
                            </div>
                        </section>
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
