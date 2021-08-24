@extends('layout.master')

@section('title')
Categories
@endsection

@section('page-title')
<i class="fas fa-list-alt"></i> Categories
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
      <div class="card">
        <div class="card-header">
          Create Category
        </div>
        <div class="card-body">
          <form class='add-form' action="{{route('categories.store')}}" method="POST" class=" p-3">
            @csrf
            <label for="exampleFormControlInput1" class="form-label">Name :</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="name">
            <label for="exampleFormControlInput1" class="form-label">Description :</label>
            <textarea type="text" class="form-control" id="exampleFormControlInput1" placeholder=""
              name="desc"></textarea>
            <div class="mt-3">
              <button type="submit" class="btn btn-warning save">
                <i class="fas fa-save icon"></i>
                <div class="d-none loading spinner-border spinner-border-sm" role="status"> <span
                    class="sr-only"></span>
                </div>
                Save
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update category</h5>
        <button onclick="$('.modal').modal('hide');" type="button"
          class="close btn rounded px-3 py-2 bg-light shaddow shaddow-lg" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('category.update')}}" class="form-group update-form">
          <input type="hidden" id="id" name="id" class="form-control">
          <input type="text" id="name" name="name" class="form-control">
          <textarea type="text" id="desc" name="desc" class="form-control mt-2">

          </textarea>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning"> Update</button>
        </form>
        <button onclick="$('.modal').modal('hide');" type="button" class="btn btn-secondary"
          data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@section('js')

<script>
  // INITIALIZE HEADER
  $.ajaxSetup({
headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});



  $(function () {
  
  var table = $('.yajra-datatable').DataTable({
  processing: true,
  serverSide: true,
  ajax: "{{ route('categories.list') }}",
  columns: [
    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
    {data: 'name', name: 'name', orderable: true, searchable: true},
    {data: 'desc', name: 'desc' , orderable: true, searchable: true},
    {data: 'action',name: 'action',orderable: false,searchable: false ,with:'200px'} ,
  ]
  });
  
  });


// ADD ITEM 

  $('.add-form').on('submit', function(e){
  e.preventDefault()
  var form_data = $(this).serialize();
  $('.loading').removeClass('d-none');
  $('.icon').addClass('d-none');
  $.ajax({
  url: this.action,
  type: this.method,
  data: form_data
  }).done(function(server_data){
    var table = $('.yajra-datatable').DataTable()
    
    if(server_data.message){
      toastr.success(server_data.message);
      table.ajax.reload();
    }

    if(server_data.error){
    toastr.error(server_data.error);
    }

    $('.icon').removeClass('d-none');
    $('.loading').addClass('d-none');

  
  }).fail(function(jqXHR, textStatus, errorThrown){
toastr.error('Somting went wrong in the server ')});
  
  });


// DELETE ITEM
function deleteitem(id) {

 $.ajax({
  url:"{{route('categories.destroy')}}",
  type: 'delete',
  data: {'id':id}
  }).done(function(server_data){
  var table = $('.yajra-datatable').DataTable()

  if(server_data.message){
  toastr.success(server_data.message);
  table.ajax.reload();
  }

  if(server_data.error){
  toastr.error(server_data.error);
  }

  }).fail(function(jqXHR, textStatus, errorThrown){
  toastr.error('Somting went wrong in the server ')
});

}


// EDIT ITEM 
function edititem(id){

  $.ajax({
  url:"{{route('getCategory.ajax')}}",
  type: 'GET',
  data: {'id':id}
  }).done(function(server_data){
  
  if(server_data){
      $('#id').val(id)
      $('#name').val(server_data.message.name)
      $('#desc').val(server_data.message.desc)
      $('.modal').modal('show');
  }
  
  if(server_data.error){
  toastr.error('Somting went wrong in the server ')
  }
  
  }).fail(function(jqXHR, textStatus, errorThrown){
  toastr.error('Somting went wrong in the server ')
  });

//Update ITEM

$('.update-form').on('submit', function(e){
e.preventDefault()
var form_data = $(this).serialize();

$.ajax({
url: this.action,
type: 'PUT',
data: form_data
}).done(function(server_data){
var table = $('.yajra-datatable').DataTable()

if(server_data.message){
toastr.success(server_data.message);
table.ajax.reload();
$('.modal').modal('hide');
}

if(server_data.error){
  toastr.error(server_data.error);
  $('.modal').modal('hide');
}

}).fail(function(jqXHR, textStatus, errorThrown){
toastr.error('Somting went wrong in the server ')});

});


}

</script>
@endsection
@endsection