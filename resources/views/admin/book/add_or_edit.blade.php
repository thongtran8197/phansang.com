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
        <form role="form" method="POST" action="{{ $book['id'] ?? 0 ? route('admin.book.update', $book['id']) : route('admin.book.create') }}" action="/file-upload" enctype="multipart/form-data">
            @if($book['id'] ?? 0)
                @method('PUT')
            @else
                @method('POST')
            @endif
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control" placeholder="Tên" name="name" value="{{ $book['name'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Mô Tả</label>
                    <textarea class="form-control" rows="5" placeholder="Mô tả" name="description"> {{ $book['description'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Link</label>
                    <input type="text" class="form-control" placeholder="Tên" name="link" value="{{ $book['link'] ?? '' }}" required>
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
                    <img src="{{ asset('images/'.($book['image'] ?? '')) }}" style="max-height: 300px">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
        @if($book['id'] ?? 0)
        <div class="card-header">
            <h3 class="card-title">Thông Tin Đa Ngôn Ngữ</h3>
        </div>
        <form role="form" method="POST" action="{{route('admin.book.language_content', $book['id'] ?? 0)}}">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Tên (En)</label>
                    <input type="text" class="form-control" placeholder="Tên" name="name_en" value="{{ $book['name_en'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Tên (Fr)</label>
                    <input type="text" class="form-control" placeholder="Tên" name="name_fr" value="{{ $book['name_fr'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Mô Tả (En)</label>
                    <textarea class="form-control" rows="5" placeholder="Mô tả" name="description_en"> {{ $book['description_en'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Mô Tả (Fr)</label>
                    <textarea class="form-control" rows="5" placeholder="Mô tả" name="description_fr"> {{ $book['description_fr'] ?? '' }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
        @endif
    </div>
@endsection
