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
        <form role="form" method="POST" action="{{ route('admin.new_about_me.update') }}" action="/file-upload" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <input type="input" name="id" value="{{ $new_about_me['id'] ?? '' }}" hidden>
                </div>
                <div class="form-group">
                    <label>Tiêu đề </label>
                    <textarea class="form-control" rows="5" placeholder="Mô tả" name="title" required> {{ $new_about_me['title'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea class="form-control" rows="5" placeholder="Mô tả" name="content" required> {{ $new_about_me['content'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Upload Ảnh Giới Thiệu 1</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="logo_image">
                            <label class="custom-file-label" for="exampleInputFile">Chọn File</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <img src="{{ asset('images/'.($new_about_me['logo_image'] ?? '')) }}" style="max-height: 300px">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Upload Ảnh Giới Thiệu 2</label>
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
                    <img src="{{ asset('images/'.($new_about_me['image'] ?? '')) }}" style="max-height: 300px">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
            @if ($new_about_me['id'] ?? 0)
                <div class="card-header">
                    <h3 class="card-title">Thông Tin Đa Ngôn Ngữ</h3>
                </div>
                <form role="form" method="POST" action="{{route('admin.new_about_me.language_content', $new_about_me['id'] ?? 0)}}">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tiêu đề (En)</label>
                            <textarea class="form-control" rows="5" placeholder="Tiêu đề" name="title_en"> {{ $new_about_me['title_en'] ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề (Fr)</label>
                            <textarea class="form-control" rows="5" placeholder="Tiêu đề" name="title_fr"> {{ $new_about_me['title_fr'] ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội Dung (En)</label>
                            <textarea class="form-control" rows="5" placeholder="Nội Dung" name="content_en"> {{ $new_about_me['content_en'] ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội Dung (Fr)</label>
                            <textarea class="form-control" rows="5" placeholder="Nội Dung" name="content_fr"> {{ $new_about_me['content_fr'] ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            @endif
    </div>
@endsection
