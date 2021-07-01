@include('admin.header')
@include('admin.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </section>
</div>
@include('admin.footer')
