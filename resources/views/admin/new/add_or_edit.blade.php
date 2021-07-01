@extends('admin.master')
@section('content')
<div class="card card-primary col-md-12">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br/>
    @endif
    <div class="card-header">
        <h3 class="card-title">Thêm Tin Tức</h3>
    </div>
    <form role="form" method="POST" action="{{ $new['id'] ?? 0 ? route('admin.new.update', $new['id']) : route('admin.new.create') }}" action="/file-upload" enctype="multipart/form-data">
        @if($new['id'] ?? 0)
        @method('PUT')
        @else
        @method('POST')
        @endif
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" class="form-control" placeholder="Tiêu đề" name="title" value="{{ $new['title'] ?? '' }}" required>
            </div>
            <div class="form-group">
                <label>Mô Tả</label>
                <textarea class="form-control" rows="5" placeholder="Mô tả" name="description"> {{ $new['description'] ?? '' }}</textarea>
            </div>
            <div class="form-group">
                <label>Link</label>
                <input type="text" class="form-control" placeholder="Tên" name="link" value="{{ $new['link'] ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Upload Ảnh</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Chọn File</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <img src="{{ asset('images/'.($new['image'] ?? '')) }}" style="max-height: 300px">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
    @if($new['id'] ?? 0)
    <div class="card-header">
        <h3 class="card-title">Thông Tin Đa Ngôn Ngữ</h3>
    </div>
    <form role="form" method="POST" action="{{route('admin.new.language_content', $new['id'] ?? 0)}}">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Tiêu đề (En)</label>
                <input type="text" class="form-control" placeholder="Tên" name="title_en" value="{{ $new['title_en'] ?? '' }}" required>
            </div>
            <div class="form-group">
                <label>Tiêu đề (Fr)</label>
                <input type="text" class="form-control" placeholder="Tên" name="title_fr" value="{{ $new['title_fr'] ?? '' }}" required>
            </div>
            <div class="form-group">
                <label>Mô Tả (En)</label>
                <textarea class="form-control" rows="5" placeholder="Mô tả" name="description_en"> {{ $new['description_en'] ?? '' }}</textarea>
            </div>
            <div class="form-group">
                <label>Mô Tả (Fr)</label>
                <textarea class="form-control" rows="5" placeholder="Mô tả" name="description_fr"> {{ $new['description_fr'] ?? '' }}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
    @endif
</div>
@endsection
