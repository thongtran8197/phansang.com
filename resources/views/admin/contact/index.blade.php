@extends('admin.master')
@section('content')
	<div class="card-body p-0">
	  <table class="table table-striped projects">
	      <thead>
	          <tr>
	              <th style="width: 1%">
	                  #
	              </th>
	              <th style="width: 20%">
	                  Tin Nhắn
	              </th>
                  <th style="width: 20%">
                      Họ Tên
                  </th>
                  <th style="width: 20%">
                      Email
                  </th>
                  <th style="width: 20%">
                       Số Điện Thoại
                  </th>
	              <th style="width: 30%">
	                  Ngày Tạo
	              </th>
	          </tr>
	      </thead>
	      <tbody>
          <?php foreach ($contacts as $contact): ?>
	          <tr>
	              <td>
                      <?php echo $contact->id; ?>
	              </td>
	              <td>
                      <?php echo $contact->message; ?>
	              </td>
                  <td>
                      <?php echo $contact->name; ?>
                  </td>
                  <td>
                      <?php echo $contact->email; ?>
                  </td>
                  <td>
                      <?php echo $contact->phone; ?>
                  </td>
	              <td>
                      <?php echo $contact->created_at; ?>
	              </td>
	          </tr>
          <?php endforeach; ?>
	      </tbody>
	  </table>
    <?php echo $contacts->render(); ?>
@endsection
