@extends('layouts.app')

@section('content')

      <div class="container">
        <a href="product">
          <button type="button" class="btn btn-primary pull-right">ADD</button></a>
        <table class="datatable mdl-data-table dataTable" cellspacing="0"
          width="100%" role="grid" 
          style="width: 100%;">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
          </table>
      </div>



<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.material.min.js"></script>
<script>
    $(document).ready(function(){
     var table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('getdata') }}',
            columns: [
                {"data": "id", "orderable": true, "searchable": true},
                {"data": "name", "orderable": true, "searchable": true},
                {"data": "qty", "orderable": true},
                {"data": "image", "orderable": false},
                {"data": "action", "orderable": false}
                
           ]
        });
        $('.datatable').on('click', '.btn-delete[data-remote]', function (e) { 
            e.preventDefault();
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = $(this).data('remote');
            // confirm then
            if(confirm('Are you sure want to Delete this recorde..!')){
              $.ajax({
                  url: url,
                  type: 'DELETE',
                  dataType: 'json',
                  data: {method: '_DELETE', submit: true}
              }).always(function (data) {
                  table.draw(false);
              });
            }
        });
    });
  </script>
  @stop

	
