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
                <a class="btn btn-success btn-sm" href="{{ route('admin.book.add') }}">
                    <i class="fas fa-plus">
                    </i>
                    Thêm Sách
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
                     Tên
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
            @foreach($books as $book)
                <tr>
                    <td>
                        {{$book['id']}}
                    </td>
                    <td>
                        {{$book['name']}}
                    </td>
                    <td>
                        {{$book['description']}}
                    </td>
                    <td>
                        <img src="{{ asset('images/'.($book['image'])) }}" style="max-height:150px">
                    </td>
                    <td>
                        {{$book['link']}}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="{{ route('admin.book.edit', $book['id'] ?? 0) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Sửa
                        </a>
                        <form action="{{ route('admin.book.destroy', $book['id'] ?? 0)}}" method="post">
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
    <?php echo $books->render(); ?>
@endsection
