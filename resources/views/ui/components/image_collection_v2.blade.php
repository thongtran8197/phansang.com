<?php $is_dark = \Session::get('is_dark'); ?>
<?php $locate = \Session::get('locale');?>
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
