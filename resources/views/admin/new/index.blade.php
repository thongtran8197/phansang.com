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
                <a class="btn btn-success btn-sm" href="{{ route('admin.new.add') }}">
                    <i class="fas fa-plus">
                    </i>
                    Thêm Tin
                </a>
            </div>
        </div>
        <table class="table table-striped projects">
            <thead>
            <tr>
                <th style="width: 1%">
                    #
                </th>
                <th style="width: 30%">
                    Tiêu đề
                </th>
                <th style="width: 30%">
                    Mô tả
                </th>
                <th style="width: 30%">
                    Link
                </th>
                <th style="width: 30%">
                    Ảnh
                </th>
                <th style="width: 20%">
                    Chức năng
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($news as $new)
                <tr>
                    <td>
                        {{$new['id']}}
                    </td>
                    <td>
                        {{$new['title']}}
                    </td>
                    <td>
                        {{$new['description']}}
                    </td>
                    <td>
                        <img src="{{ asset('images/'.($new['image'])) }}" style="max-height:150px">
                    </td>
                    <td>
                        {{$new['link']}}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="{{ route('admin.new.edit', $new['id'] ?? 0) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Sửa
                        </a>
                        <form action="{{ route('admin.new.destroy', $new['id'] ?? 0)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fas fa-trash">
                                </i>
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    <?php echo $news->render(); ?>
@endsection



