@extends('layout.master')

@section('title')
Tags
@endsection

@section('page-title')
Tags
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
            <th scope="col">color</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
    <div class="col-md-4">
      <form action="{{route('tags.store')}}" method="POST" class="card p-3">
        @method('POST')
        @csrf
        <label for="exampleFormControlInput1" class="form-label">Tag name :</label>
        <input type="text" class="form-control mb-3" id="exampleFormControlInput1" placeholder="Tag name" name="name">
        <label for="exampleColorInput" class="form-label">Select Color </label>
        <input type="color" class="form-control form-control-color" name="color" value="#563d7c"
          title="Choose your color">
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
  ajax: "{{route('tags.list')}}",
  columns:[
  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
  {data: 'name', name: 'name'},
  {data: 'color', name: 'color'},

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