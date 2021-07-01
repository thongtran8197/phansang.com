@extends('ui.master')
@section('content')
    <?php $is_dark = \Session::get('is_dark'); ?>
    <?php $locate = \Session::get('locale');?>
    <div class="content-holder elem scale-bg2 transition3 slid-hol" id="<?php echo($is_dark ? "dark-mode" : "")?>">
        <div class="content full-height t-72 nice-scroll-container">
            @foreach($news as $new)
            <div class="_flex-container">
                <div class="flex-container">
                    <a href="{{$new['link']}}" class="img-container" style="flex: 1;">
                        <img src="{{asset('images/'.($new['image'] ?? ""))}}">
                    </a>
                    <div class="context-container" style="padding-left: 30px; flex: 2;">
                        @if($locate == 'en')
                            <h3 class="title"><a href="{{$new['link']}}">{{$new['title_en']}}</a></h3>
                        @elseif($locate == 'fr')
                            <h3 class="title"><a href="{{$new['link']}}">{{$new['title_fr']}}</a></h3>
                        @else
                            <h3 class="title"><a href="{{$new['link']}}">{{$new['title']}}</a></h3>
                        @endif
                        <p class="desc">
                            @if($locate == 'en')
                                {!! nl2br(e($new['description_en']))!!}
                            @elseif($locate == 'fr')
                                {!! nl2br(e($new['description_fr']))!!}
                            @else
                                {!! nl2br(e($new['description']))!!}
                            @endif
                        </p>
                    </div>
                    <a class="more-action" href="{{$new['link']}}">
                        {{ __('labels.view_more') }}
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
@endsection
