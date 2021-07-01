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
            <h3 class="card-title">Thêm Quan Điểm</h3>
        </div>
        <form role="form" method="POST" action="{{ $point_view['id'] ?? 0 ? route('admin.point_view.update', $point_view['id']) : route('admin.point_view.create') }}">
            @if($point_view['id'] ?? 0)
                @method('PUT')
            @else
                @method('POST')
            @endif
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Quan điểm</label>
                    <textarea class="form-control" rows="5" placeholder="Mô tả" name="point_view"> {{ $point_view['point_view'] ?? '' }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
    @if ($point_view ?? 0)
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
            @if ($point_view['id'] ?? 0)
            <div class="card-header">
                <h3 class="card-title">Thông Tin Đa Ngôn Ngữ</h3>
            </div>
            <form role="form" method="POST" action="{{route('admin.point_view.language_content', $point_view['id'] ?? 0)}}">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Quan điểm (En)</label>
                        <textarea class="form-control" rows="5" placeholder="Mô tả" name="point_view_en">{{ $point_view['point_view_en'] ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Quan điểm (Fr)</label>
                        <textarea class="form-control" rows="5" placeholder="Mô tả" name="point_view_fr">{{ $point_view['point_view_fr'] ?? '' }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
            @endif
        </div>
    @endif
@endsection

