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
                <a class="btn btn-success btn-sm" href="{{ route('admin.collection.add') }}">
                    <i class="fas fa-plus">
                    </i>
                    Thêm Bộ Sưu Tập
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
	                  Tên
	              </th>
	              <th style="width: 30%">
	                  Mô tả
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
          @foreach($collections as $collection)
              <tr>
                  <td>
                      {{$collection['id']}}
                  </td>
                  <td>
                      {{$collection['name']}}
                  </td>
                  <td>
                      {{$collection['description']}}
                  </td>
                  <td>
                      {{$collection['created_at']}}
                  </td>
                  <td class="project-actions text-right">
                      <a class="btn btn-primary btn-sm" href="{{ route('admin.post.index', $collection['id'] ?? 0) }}">
                          <i class="fas fa-folder">
                          </i>
                          Thêm Tác Phẩm
                      </a>
                      <a class="btn btn-success btn-sm" href="{{ route('admin.collection.get_main_post', $collection['id'] ?? 0) }}">
                          <i class="fas fa-folder">
                          </i>
                          Chọn tác phẩm chính
                      </a>
                      <a class="btn btn-primary btn-sm" href="{{ route('admin.collection.get_qr', [$collection['id'] ?? 0, $collection->name]) }}">
                          <i class="fas fa-folder">
                          </i>
                          In mã QR
                      </a>
                      <a class="btn btn-info btn-sm" href="{{ route('admin.collection.edit', $collection['id'] ?? 0) }}">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Sửa
                      </a>
                      <form action="{{ route('admin.collection.destroy', $collection['id'] ?? 0)}}" method="post">
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
    <?php echo $collections->render(); ?>
@endsection
