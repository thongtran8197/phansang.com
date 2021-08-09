@extends('ui.master')
@section('css')
<style>
p{
    font-size: 20px;
}
@media(max-width: 1199px){
    .paragraph-box{
        width: 75%;
    }
}
</style>
@endsection

@section('content')
        <?php $is_dark = \Session::get('is_dark'); ?>
        <div id="<?php echo($is_dark ? "dark-mode" : "")?>" class="content-holder elem scale-bg2 transition3" >
    <?php $locate = \Session::get('locale');?>
    <div id="detail_about_me" class="elem scale-bg2 transition3" >
        <div class="content full-height">
            <div class="detail_about_me_ctn">
                <div class="header">
                    <img class="logo-img" src="{{ asset('images/'.($about_me['logo_image'] ?? "")) }}">
                </div>
                <div class="body">
                    <div class="img-box">
                        <img style="width: 100%;" class="img-item" src="{{ asset('images/'.($about_me['image'] ?? "")) }}" alt="" />
                    </div>
                    <div class="separator-line"></div>
                    <div class="paragraph-box">
                        <h2 class="title text-uppercase">
                            @if($locate == 'en')
                                {!! nl2br(e($about_me['title_en'] ?? ""))!!}
                            @elseif($locate == 'fr')
                                {!! nl2br(e($about_me['title_fr'] ?? ""))!!}
                            @else
                                {!! nl2br(e($about_me['title'] ?? ""))!!}
                            @endif
                        </h2>
                        <div>
                            <p class="content text-align-center">
                                @if($locate == 'en')
                                    {!! nl2br(e($about_me['content_en'] ?? ""))!!}
                                @elseif($locate == 'fr')
                                    {!! nl2br(e($about_me['content_fr'] ?? ""))!!}
                                @else
                                    {!! nl2br(e($about_me['content'] ?? ""))!!}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
