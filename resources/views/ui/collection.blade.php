@extends('ui.master')
@section('content')
        <?php $is_dark = \Session::get('is_dark'); ?>
        <?php $locate = \Session::get('locale');?>
        <div id="<?php echo($is_dark ? "dark-mode" : "")?>" class="collection-content-holder content-holder elem scale-bg2 transition3">
        <div class="overlay-content">
        <div id="collection" class="content full-height">
                <div class="filter-holder column-filter">
                <div class="filter-button">{{ __('labels.collections') }}<i class="fa fa-long-arrow-down"></i></div>
                <div class="gallery-filters hid-filter">
                    <?php $collections_chunk = array_chunk($collections, 6); ?>
                    <div class="content-container">
                    @foreach($collections_chunk as $collection_chunk)
                            <div class="column-content">
                        @foreach($collection_chunk as $collection)
                            @if($locate == 'en')
                                <a href="{{ route('ui.post', $collection->id) }}" class="gallery-filter transition2">{{$collection->name_en ?? ""}}</a>
                            @elseif($locate == 'fr')
                                <a href="{{ route('ui.post', $collection->id) }}" class="gallery-filter transition2">{{$collection->name_fr ?? ""}}</a>
                            @else
                                <a href="{{ route('ui.post', $collection->id) }}" class="gallery-filter transition2">{{$collection->name ?? ""}}</a>
                            @endif
                        @endforeach
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="resize-carousel-holder">
                <div class="p_horizontal_wrap">
                    <div id="portfolio_horizontal_container">
                        @foreach($collections as $collection)
                            <div class="portfolio_item collection_portfolio_item">
                                <a href="{{route('ui.post', $collection->id)}}"><img  src="{{ asset('images/'.$collection->image) }}"  alt=""></a>
                                <div class="port-desc-holder collection-port-desc-holder">
                                    <div class="port-desc">
                                        <div class="overlay"></div>
                                        <div class="grid-item">
                                            @if($locate == 'en')
                                                <h3><a href="{{ route('ui.post', $collection->id) }}">{{$collection->name_en}}</a></h3>
                                            @elseif($locate == 'fr')
                                                <h3><a href="{{ route('ui.post', $collection->id) }}">{{$collection->name_fr}}</a></h3>
                                            @else
                                                <h3><a href="{{ route('ui.post', $collection->id) }}">{{$collection->name}}</a></h3>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($locate == 'en')
                                    <span class="mbItemName"><a href="{{ route('ui.post', $collection->id) }}">{{$collection->name_en}}</a></span>
                                @elseif($locate == 'fr')
                                    <span class="mbItemName"><a href="{{ route('ui.post', $collection->id) }}">{{$collection->name_fr}}</a></span>
                                @else
                                    <span class="mbItemName"><a href="{{ route('ui.post', $collection->id) }}">{{$collection->name}}</a></span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
