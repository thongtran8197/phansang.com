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
                <a class="btn btn-success btn-sm" href="{{ route('admin.studio.add') }}">
                    <i class="fas fa-plus">
                    </i>
                    Thêm Studio
                </a>
                <a class="btn btn-success btn-sm" href="{{ route('admin.studio.get_studio_info') }}">
                    <i class="fas fa-plus">
                    </i>
                    Thông tin studio
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
                    Ảnh
                </th>
                <th>
                    Ngày Tạo
                </th>
                <th style="width: 20%">
                    Chức năng
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($studios as $studio)
                <tr>
                    <td>
                        {{$studio['id']}}
                    </td>
                    <td>
                        @if($studio['type'] == 1)
                        <img src="{{ asset('images/'.($studio['link_studio'])) }}" style="max-height:150px">
                        @elseif($studio['type'] == 2)
                            <video height="150px" controls>
                                <source src="{{ asset('videos/'.($studio['link_studio'] ?? "")) }}">
                                Your browser does not support HTML video.
                            </video>
                        @endif
                    </td>
                    <td>
                        {{$studio['created_at']}}
                    </td>
                    <td class="project-actions">
                        <a class="btn btn-info btn-sm" href="{{ route('admin.studio.edit', $studio['id'] ?? 0) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Sửa
                        </a>
                        <form action="{{ route('admin.studio.destroy', $studio['id'] ?? 0)}}" method="post">
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
    <?php echo $studios->render(); ?>
@endsection
