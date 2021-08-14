@extends('layout.master')

@section('title')
Categories
@endsection

@section('section')
<div class="container">
  <div class=" d-flex justify-content-between align-items-center">
    <h3> Categories </h3>

    <button type="button" class="btn btn-secondary col col-md-2 mt-3 mb-5" data-bs-toggle="modal"
      data-bs-target="#exampleModal">
      Add Category
    </button>
  </div>
  <div class="row">
    {{-- modal --}}
    <div class="modal" tabindex="-1" id="exampleModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{route('categories.store')}}" method="POST">
              @method('POST')
              @csrf
              <label for="exampleFormControlInput1" class="form-label">Category name :</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="category name"
                name="name">
          </div>
          <div class="mb-3">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
        </form>
      </div>
    </div>



  </div>


  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category)
      <tr>

        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td>
          <button class="btn btn-secondary">Edit</button>
          <button class="btn btn-danger">delete</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>


  {{ $categories->links() }}

</div>
@endsection