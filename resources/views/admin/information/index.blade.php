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
            <h3 class="card-title">Thông tin cá nhân</h3>
        </div>
        <form role="form" method="POST" action="{{ route('admin.information.update') }}">
            @method('POST')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <input type="input" name="id" value="{{ $info['id'] ?? '' }}" hidden>
                </div>
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control" placeholder="" name="name" value="{{ $info['name'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Số Điện Thoại</label>
                    <input type="text" class="form-control" placeholder="" name="phone_number" value="{{ $info['phone_number'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Ngày Sinh</label>
                    <input type="text" class="form-control" placeholder="" name="birthday" value="{{ $info['birthday'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Quê quán</label>
                    <input type="text" class="form-control" placeholder="" name="country" value="{{ $info['country'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Tốt nghiệp</label>
                    <input type="text" class="form-control" placeholder="" name="graduation" value="{{ $info['graduation'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Gmail</label>
                    <input type="text" class="form-control" placeholder="" name="gmail" value="{{ $info['gmail'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" placeholder="" name="address" value="{{ $info['address'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Facebook</label>
                    <input type="text" class="form-control" placeholder="" name="link_fb" value="{{ $info['link_fb'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Instagram</label>
                    <input type="text" class="form-control" placeholder="" name="link_instagram" value="{{ $info['link_instagram'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Twitter</label>
                    <input type="text" class="form-control" placeholder="" name="link_twitter" value="{{ $info['link_twitter'] ?? '' }}" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
@endsection
