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
            <h3 class="card-title">Đổi mật khẩu</h3>
        </div>
        <form role="form" method="POST" action=" {{ route('admin.user.change_password', Auth::user()->id) }}">
            @method('PUT')
            @csrf
            <div class="card-body">
                <input type="input" class="form-control" name="id" value="{{ Auth::user()->id }}" hidden>
                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <input type="text" class="form-control" placeholder="mật khẩu mới" name="new_password" value="" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
@endsection
