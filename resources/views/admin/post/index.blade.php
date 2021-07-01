@extends('admin.master')
@section('content')
    <div class="card-body p-0">
        <div class="card">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="card-body">
                <a class="btn btn-success btn-sm" href="{{ route('admin.post.add', $collection_id) }}">
                    <i class="fas fa-plus">
                    </i>
                    Thêm Tác Phẩm
                </a>
            </div>
        </div>
        <table class="table table-striped projects">
            <thead>
            <tr>
                <th style="width: 1%">
                    #
                </th>
                <th style="width: 20%">
                    Hình
                </th>
                <th style="width: 20%">
                    Tên
                </th>
                <th style="width: 20%">
                    Mô Tả
                </th>
                <th style="width: 20%">
                    Chi tiết
                </th>
                <th style="width: 20%">
                    Chức năng
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>
                        {{$post['id']}}
                    </td>
                    <td>
                        <img src="{{ asset('images/'.($post['image'])) }}" style="max-height:150px">
                    </td>
                    <td>
                        {{ $post['name'] ?? ""}}
                    </td>
                    <td>
                        {!! nl2br(e($post['description'] ?? ""))!!}
                    </td>
                    <td>
                        {!! nl2br(e($post['detail'] ?? ""))!!}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="{{ route('admin.post.edit', $post['id'] ?? 0) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Sửa
                        </a>
                        <form action="{{ route('admin.post.destroy', $post['id'] ?? 0)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fas fa-trash">
                                </i>
                                Xóa
                            </button>
                        </form>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.post.get_qr', [$post['id'] ?? 0, $post->name]) }}">
                            <i class="fas fa-folder">
                            </i>
                            In mã QR
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    <?php echo $posts->render(); ?>
@endsection
