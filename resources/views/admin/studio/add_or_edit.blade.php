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
            <h3 class="card-title">Thêm Studio</h3>
        </div>
        <form role="form" method="POST" action="{{ $studio['id'] ?? 0 ? route('admin.studio.update', $studio['id']) : route('admin.studio.create') }}" action="/file-upload" enctype="multipart/form-data">
            @if($studio['id'] ?? 0)
                @method('PUT')
            @else
                @method('POST')
            @endif
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" value="1" {{ ($studio['type'] ?? 1) == 1 ? "checked" : "" }}>
                        <label class="form-check-label">Image</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" value="2" {{ ($studio['type'] ?? 1) == 2 ? "checked" : "" }}>
                        <label class="form-check-label">Video</label>
                    </div>
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
                @if(($studio['type'] ?? 0) == 1)
                <div class="form-group">
                    <img src="{{ asset('images/'. ($studio['link_studio'] ?? '')) }}" style="max-height: 300px">
                </div>
                @endif
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
@endsection
