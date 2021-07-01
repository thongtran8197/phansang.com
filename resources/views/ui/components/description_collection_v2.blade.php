<?php $is_dark = \Session::get('is_dark'); ?>
<?php $locate = \Session::get('locale');?>
@if($locate == 'en')
    <span>
        <h3 class="text-uppercase description-title description-label">{{__('labels.newest_collection')}}: </h3>
        <div class="separator description-label"></div>
        <div class="clearfix description-label"></div>
    </span>
    <h3 class="description-title">{{$collection->c_name_en}}</h3>
@elseif($locate == 'fr')
    <span>
        <h3 class="text-uppercase description-title description-label">{{__('labels.newest_collection')}}: </h3>
        <div class="separator description-label"></div>
        <div class="clearfix description-label"></div>
    </span>
    <h3 class="description-title">{{$collection->c_name_fr}}</h3>
@else
    <span>
        <h3 class="text-uppercase description-title description-label">{{__('labels.newest_collection')}}: </h3>
        <div class="separator description-label"></div>
        <div class="clearfix description-label"></div>
    </span>
    <h3 class="description-title">{{$collection->c_name}}</h3>
@endif
<div class="separator"></div>
<div class="clearfix"></div>
@if($locate == 'en')
    <p class="description-ctn">{!! nl2br(e($collection->c_description_en))!!}</p>
@elseif($locate == 'fr')
    <p class="description-ctn">{!! nl2br(e($collection->c_description_fr))!!}</p>
@else
    <p class="description-ctn">{!! nl2br(e($collection->c_description))!!}</p>
@endif
<div class="post-img-info-container img-info-container">
    <img src="{{ asset('images/'.$collection->image) }}" />
</div>
