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
        <form role="form" method="POST" action="{{ route('admin.about_me.update') }}" action="/file-upload" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <input type="input" name="id" value="{{ $about_me['id'] ?? '' }}" hidden>
                </div>
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea class="form-control" rows="5" placeholder="Mô tả" name="description" required> {{ $about_me['description'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Upload Ảnh Giới Thiệu</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image_about">
                            <label class="custom-file-label" for="exampleInputFile">Chọn File</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <img src="{{ asset('images/'.($about_me['image_about'] ?? '')) }}" style="max-height: 300px">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Upload Ảnh Sự Kiện</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image_event">
                            <label class="custom-file-label" for="exampleInputFile">Chọn File</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <img src="{{ asset('images/'.($about_me['image_event'] ?? '')) }}" style="max-height: 300px">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Upload Ảnh Sách</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image_book">
                            <label class="custom-file-label" for="exampleInputFile">Chọn File</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <img src="{{ asset('images/'.($about_me['image_book'] ?? '')) }}" style="max-height: 300px">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Upload Ảnh Giới Thiệu 1</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image_about_1">
                            <label class="custom-file-label" for="exampleInputFile">Chọn File</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <img src="{{ asset('images/'.($about_me['image_about_1'] ?? '')) }}" style="max-height: 300px">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Upload Ảnh Giới Thiệu 2</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image_about_2">
                            <label class="custom-file-label" for="exampleInputFile">Chọn File</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <img src="{{ asset('images/'.($about_me['image_about_2'] ?? '')) }}" style="max-height: 300px">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Upload Ảnh Giới Thiệu 3</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image_about_3">
                            <label class="custom-file-label" for="exampleInputFile">Chọn File</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <img src="{{ asset('images/'.($about_me['image_about_3'] ?? '')) }}" style="max-height: 300px">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
@endsection
