@extends('ui.master')
@section('content')
        <?php $is_dark = \Session::get('is_dark'); ?>
        <?php $locate = \Session::get('locale');?>
        <div id="<?php echo($is_dark ? "dark-mode" : "")?>" class="content-holder elem scale-bg2 transition3 post-content-holder">
            <div class="overlay-content">
            <div class="content full-height custom-post-content collection-v2-ctn">
                <div class="col-md-12 posts-ctn no-padding">
                    <div class="col-md-3 post-item collection-ctn">
                        <h1 class="toggle-button black-bg">
                            {{ __('labels.collections') }}
                            <i class="fa fa-long-arrow-down"></i>
                        </h1>
                        <ul class="post-list toggle-menu black-bg">
                            @foreach( $collections as $key => $collection)
                                @if($locate == 'en')
                                    <li onclick="switchCollection({{$collection['id'] ?? 0}}, this)" data-id="{{$collection['id'] ?? 0}}">
                                        @if($key === 0)
                                            <span><span class="newest-collection text-uppercase">{{__('labels.newest_collection')}}: </span><span>
                                        @endif
                                        {{$collection['name_en'] ?? ""}}
                                    </li>
                                @elseif($locate == 'fr')
                                    <li onclick="switchCollection({{$collection['id'] ?? 0}}, this)" data-id="{{$collection['id'] ?? 0}}">
                                          @if($key === 0)
                                            <span><span class="newest-collection text-uppercase">{{__('labels.newest_collection')}}: </span><span>
                                          @endif
                                        {{$collection['name_fr'] ?? ""}}
                                    </li>
                                @else
                                    <li onclick="switchCollection({{$collection['id'] ?? 0}}, this)" data-id="{{$collection['id'] ?? 0}}">
                                        @if($key === 0)
                                            <span><span class="newest-collection text-uppercase">{{__('labels.newest_collection')}}: </span><span>
                                        @endif
                                        {{$collection['name'] ?? ""}}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="show-hid-content" style="z-index: 1001"><i class="fa fa-long-arrow-down"></i></div>
                    <div class="col-md-3 post-item description-ctn">
                        <div class="col-md-12 post-fixed-info-container" style="background: #898c9d;">
                            <div class="post-fixed-info-sub-ctn">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 post-item post-carousel-ctn">
                        <div class="post-resize-carousel resize-carousel-holder anim-holder">
                            <div class="p_horizontal_wrap">
                                <div id="portfolio_horizontal_container">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-name">
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script type="text/javascript" src="{{asset('ui/js/jquery.min.js')."?v=".time()}}"></script>
        <script>
        const ENDPOINT = "{{ url('/') }}";
        var locate = "{{ $locate }}";
        var page = 1;
        var currentCollectionId = {{$collections[0]['id'] ?? 0}};

        renderData(currentCollectionId);

        function initNiceScroll(resData) {
            var b = {
                touchbehavior: true,
                cursoropacitymax: 1,
                cursorborderradius: "0",
                background: "#a4a4a3",
                cursorwidth: "5px",
                cursorborder: "0px",
                cursorcolor: "#3f3f3f",
                autohidemode: false,
                bouncescroll: false,
                scrollspeed: 120,
                mousescrollstep: 90,
                grabcursorenabled: true,
                horizrailenabled: true,
                preservenativescrolling: true,
                cursordragontouch: true,
                railpadding: {
                    top: -3,
                    right: 0,
                    left: 0,
                    bottom: 0
                },
            };
            var $scroll = $(".p_horizontal_wrap").niceScroll(b);
            $scroll.onscrollend = function(data) {
                if ((data.end.x === this.page.maxw) && resData) {
                    page += 1;
                    renderPostByCollection(currentCollectionId)
                }
            }
        }

        function initOpenNewTabEvent() {
            var a = document.querySelectorAll(".zoomimage");
            for (var i = 0, len = a.length; i < len; i++) {
                a[i].addEventListener('click', function (event) {
                    event.stopPropagation();
                    event.preventDefault();
                    window.open($(this).attr('href'));
                }, false);
            }
        }

        function initRedirectPageEvent() {
            if(trueMobile) {
                var a = document.querySelectorAll(".zoomimage");
                for (var i = 0, len = a.length; i < len; i++) {
                    a[i].addEventListener('click', function (event) {
                        event.stopPropagation();
                        event.preventDefault();
                        window.open($(this).attr('href'));
                    }, false);
                }
            }
        }

        function initGalleryHeight() {
            // adjust for post name in post page
            var paddingPostName = 30;
            var a = $(window).height(),
                b = $("header").outerHeight(),
                c = $("footer").outerHeight(),
                d = $(".p_horizontal_wrap");
            d.css("height", a - b - c);
            $(" #portfolio_horizontal_container .portfolio_item img , .port-desc-holder").css({
                height: $(".p_horizontal_wrap").outerHeight(true) - 60
            });
        }
        function renderPostByCollection (collectionId){
            $.ajax({
                url: ENDPOINT + "/tac-pham/" + collectionId + "?page=" + page,
                datatype: "json",
                type: "get",
            })
            .done(function (res){
                var isTrueMobile;
                try {
                    isTrueMobile = trueMobile;
                }
                catch {
                    isTrueMobile = false;
                }
                if(res) {
                    $("#portfolio_horizontal_container").append(res.toString());
                    initGalleryHeight(res);
                }

                if(isTrueMobile) {
                    $('.collection-v2-ctn .p_horizontal_wrap').removeAttr('style');
                    initOpenNewTabEvent();
                    initScrollOnMobile(res);
                }
                else {
                    initNiceScroll(res);
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError){
                console.log("Server error occured");
            });
        }
        function initScrollOnMobile (resData) {
            $('.collection-v2-ctn').on('scroll', function(event) {
              const $scrollTop = $(event.target).scrollTop();
              const $height = $(event.target).height();
              const $offset = 10;
              const shouldLoadMore = ($scrollTop + $height + $offset) >= $('.posts-ctn').height();


              if(shouldLoadMore && resData) {
                  page += 1;
                  renderPostByCollection(currentCollectionId);
              }
            })
        }
        function renderDescription (collectionId) {
            $.ajax({
                url: ENDPOINT + "/mo-ta-bo-suu-tap-v2/" + collectionId,
                datatype: "json",
                type: "get",
            })
            .done(function (res){
                $(".post-fixed-info-sub-ctn").append(res.toString());
            })
            .fail(function (jqXHR, ajaxOptions, thrownError){
                console.log("Server error occured");
            });
        }

        function renderCollectionName (collectionId) {
            $.ajax({
                url: ENDPOINT + "/ten-bo-suu-tap-v2/" + collectionId,
                datatype: "json",
                type: "get",
            })
            .done(function (res){
                $(".post-name").append(res.toString());
            })
            .fail(function (jqXHR, ajaxOptions, thrownError){
                console.log("Server error occured");
            });
        }

        function switchCollection(collectionId) {
            if (collectionId) {
                clearData();
                page = 1;
                currentCollectionId = collectionId;
                renderData(collectionId)
            }
        }

        function renderData (collectionId) {
            setCssActiveCollection (collectionId);
            renderCollectionName(collectionId);
            renderDescription(collectionId);
            renderPostByCollection(collectionId);
        }

        function clearData() {
            $(".post-fixed-info-sub-ctn").html("");
            $(".post-name").html("");
            $("#portfolio_horizontal_container").html("");
        };

        function setCssActiveCollection (collectionId) {
            $('.collection-v2-ctn').find('.post-list li.active').removeClass('active');
            $('.collection-v2-ctn').find(`[data-id='${collectionId}']`).addClass('active');
        }
    </script>
@endsection
