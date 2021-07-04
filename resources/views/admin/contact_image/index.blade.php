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
            <h3 class="card-title">Ảnh liên hệ</h3>
        </div>
            <form role="form" method="POST" action="{{ route('admin.contact_image.update_contact_image') }}" action="/file-upload" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <input type="input" name="id" value="{{ $contact_image['id'] ?? 0 }}" hidden>
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
                        <img src="{{ asset('images/'.($contact_image['image'] ?? '')) }}" style="max-height: 300px">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>

    </div>
@endsection
