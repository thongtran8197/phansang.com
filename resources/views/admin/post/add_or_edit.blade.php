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
            <h3 class="card-title">Thêm Tác Phẩm</h3>
        </div>
        <form role="form" method="POST" action="{{ $post['id'] ?? 0 ? route('admin.post.update', $post['id']) : route('admin.post.create') }}" action="/file-upload" enctype="multipart/form-data">
            @if($post['id'] ?? 0)
                @method('PUT')
            @else
                @method('POST')
            @endif
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" id="" name="collection_id" value="{{$collection_id ?? $post['collection_id']}}">
                </div>
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control" placeholder="Tên" name="name" value="{{ $post['name'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Mô Tả</label>
                    <textarea class="form-control" rows="5" placeholder="Mô tả" name="description"> {{ $post['description'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Chi tiết</label>
                    <textarea class="form-control" rows="5" placeholder="Chi Tiết" name="detail"> {{ $post['detail'] ?? '' }}</textarea>
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
                    <img src="{{ asset('images/'.($post['image'] ?? '')) }}" style="max-height: 300px">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
        @if ($post['id'] ?? 0)
        <div class="card-header">
            <h3 class="card-title">Thông Tin Đa Ngôn Ngữ</h3>
        </div>
        <form role="form" method="POST" action="{{route('admin.post.language_content', $post['id'] ?? 0)}}">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Tên (En)</label>
                    <input type="text" class="form-control" placeholder="Tên" name="name_en" value="{{ $post['name_en'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Tên (Fr)</label>
                    <input type="text" class="form-control" placeholder="Tên" name="name_fr" value="{{ $post['name_fr'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Mô Tả (En)</label>
                    <textarea class="form-control" rows="5" placeholder="Mô tả" name="description_en"> {{ $post['description_en'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Mô Tả (Fr)</label>
                    <textarea class="form-control" rows="5" placeholder="Mô tả" name="description_fr"> {{ $post['description_fr'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Chi Tiết (En)</label>
                    <textarea class="form-control" rows="5" placeholder="Chi Tiết" name="detail_en"> {{ $post['detail_en'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Chi Tiết (Fr)</label>
                    <textarea class="form-control" rows="5" placeholder="Chi Tiết" name="detail_fr"> {{ $post['detail_fr'] ?? '' }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
        @endif
    </div>
@endsection
