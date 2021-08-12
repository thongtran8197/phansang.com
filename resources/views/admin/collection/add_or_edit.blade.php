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
            <h3 class="card-title">Thêm Bộ Sưu Tập</h3>
        </div>
        <form role="form" method="POST" action="{{ $collection['id'] ?? 0 ? route('admin.collection.update', $collection['id']) : route('admin.collection.create') }}">
            @if($collection['id'] ?? 0)
                @method('PUT')
            @else
                @method('POST')
            @endif
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control" placeholder="" name="name" value="{{ $collection['name'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Tên Tiếng Anh</label>
                    <input type="text" class="form-control" placeholder="" name="name_en" value="{{ $collection['name_en'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Mô Tả</label>
                    <textarea class="form-control" row="5" placeholder="Mô tả" name="description"> {{ $collection['description'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Mô Tả Tiếng Anh</label>
                    <textarea class="form-control" row="5" placeholder="Mô tả" name="description_en"> {{ $collection['description_en'] ?? '' }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
    @if ($collection ?? 0)
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
    </div>
    @endif
@endsection
