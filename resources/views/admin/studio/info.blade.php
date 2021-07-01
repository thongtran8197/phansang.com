@extends('admin.master')
@section('content')
    <div class="card card-primary col-md-12">
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
            <h3 class="card-title">Giới Thiệu</h3>
        </div>
        <form role="form" method="POST" action="{{ route('admin.studio.post_studio_info') }}" action="/file-upload" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <input type="input" name="id" value="{{ $studio_info['id'] ?? '' }}" hidden>
                </div>
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea class="form-control" rows="5" placeholder="Mô tả" name="description" required> {{ $studio_info['description'] ?? '' }}</textarea>
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
                    <img src="{{ asset('images/'.($studio_info['image'] ?? '')) }}" style="max-height: 300px">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
        @if ($studio_info['id'] ?? 0)
        <div class="card-header">
            <h3 class="card-title">Thông Tin Đa Ngôn Ngữ</h3>
        </div>
        <form role="form" method="POST" action="{{ route('admin.studio_info.language_content', $studio_info['id'] ?? 0) }}">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Mô Tả (En)</label>
                    <textarea class="form-control" rows="5" placeholder="Mô tả" name="description_en">{{ $studio_info['description_en'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Mô Tả (Fr)</label>
                    <textarea class="form-control" rows="5" placeholder="Mô tả" name="description_fr">{{ $studio_info['description_fr'] ?? '' }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
        @endif
    </div>
@endsection
