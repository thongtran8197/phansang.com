@extends('ui.master')
@section('content')
    <?php $is_dark = \Session::get('is_dark');?>
    <div id="<?php echo($is_dark ? "dark-mode" : "")?>" class="content-holder elem scale-bg2 transition3 slid-hol">
        <div class="content full-height">
            <div class="full-height-wrap">
                <div class="bg-container">
                    <div class="custom-background">
                        <div class="bg-image" style="background-image:url({{asset('images/'.($about_me['image_about'] ?? ""))}})">
                            <div class="bg-overlay">
                                <div class="description slide-title cdc">
                                    <span class="subtitle"></span>
                                    <div class="first-desc">
                                        <div class="hyphen"></div>
                                            <div class="cBgContent">
                                                <div><a href="{{ route('ui.detail_about_me') }}" class="about-me-title">{{ __('labels.about_me') }}</a></div>
                                            </div>
                                        <a href="{{ route('ui.detail_about_me') }}" class="hyphen"></a>
                                    </div>
                                    <a href="{{ route('ui.detail_about_me') }}" style="color: white;">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-background">
                        <div class="bg-image" style="background-image:url({{asset('images/'.($about_me['image_event'] ?? ""))}})">
                            <div class="bg-overlay">
                                <div class="description slide-title cdc">
                                    <span class="subtitle"></span>
                                    <div class="first-desc">
                                        <div class="hyphen"></div>
                                        <div class="cBgContent">
                                                <div><a href="{{ route('ui.event') }}" class="about-me-title">{{ __('labels.event') }}</a></div>
                                        </div>
                                        <div class="hyphen"></div>
                                    </div>
                                    <a href="{{ route('ui.event') }}" style="color: white;">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-background">
                        <div class="bg-image" style="background-image:url({{asset('images/'.($about_me['image_book'] ?? ""))}})">
                            <div class="bg-overlay">
                                <div class="description slide-title cdc">
                                    <span class="subtitle"></span>
                                    <div class="first-desc">
                                        <div class="hyphen"></div>
                                        <div class="cBgContent">
                                                <div><a href="{{ route('ui.news') }}" class="about-me-title">{{ __('labels.news') }}</a></div>
                                        </div>
                                        <div class="hyphen"></div>
                                    </div>
                                    <a href="{{ route('ui.event') }}" style="color: white;">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
@endsection
