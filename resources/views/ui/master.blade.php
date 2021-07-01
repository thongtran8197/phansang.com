<?php $is_dark = \Session::get('is_dark'); ?>
@include('ui.header')
<div id="wrapper">
    @yield('content')
</div>
</div>
@include('ui.footer')


