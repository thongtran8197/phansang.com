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
            <h3 class="card-title">Thêm Ảnh Chính</h3>
        </div>
        <form role="form" method="POST" action="{{ route('admin.collection.post_main_post', $collection_id) }}">
            @method('POST')
            @csrf
            @foreach($posts as $post)
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="main_post_id" value="{{$post['id']}}" {{$main_post_id == $post['id'] ? 'checked' : ''}}>
                        <img src="{{ asset('images/'.($post['image'] ?? '')) }}" style="max-height: 200px">
                    </div>
                </div>
            @endforeach
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
@endsection
