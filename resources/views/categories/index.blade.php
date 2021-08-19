@extends('layout.master')

@section('title')
Categories
@endsection

@section('page-title')
Categories
@endsection

@section('section')
<div class="container">
  <div class="row">
    <div class="col col-md-8">
      <table class="table bg-white table yajra-datatable mb-5">
        <thead class="bg-dark text-white">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description </th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
    <div class="col-md-4">
      <form action="{{route('categories.store')}}" method="POST" class="card p-3">
        @method('POST')
        @csrf
        <label for="exampleFormControlInput1" class="form-label">Name :</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="category name" name="name">
        <label for="exampleFormControlInput1" class="form-label">Description :</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="category name" name="desc">
        <div class="mt-3">
          <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Save</button>
        </div>

      </form>
    </div>
  </div>
</div>

@section('js')
<script>
  $(function () {
  
  var table = $('.yajra-datatable').DataTable({
  processing: true,
  serverSide: true,
  ajax: "{{ route('categories.list') }}",
  columns: [
  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
  {data: 'name', name: 'name'},
  {data: 'desc', name: 'desc'},

  {
  data: 'action',
  name: 'action',
  orderable: true,
  searchable: true
  },
  ]
  });
  
  });
</script>
@endsection
@endsection