@extends('layout.master')


@section('title')
Tags
@endsection

@section('section')
<div class="container">
  <div class="row">

    <h6> Tags </h6>
    {{-- modal --}}
    <div class="modal" tabindex="-1" id="exampleModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add tag</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('tags.store') }}" method="POST">
              @csrf
              <label for="exampleFormControlInput1" class="form-label">Tag name :</label>
              <input type="text" class="form-control mb-3" id="exampleFormControlInput1" placeholder="Tag name"
                name="name">
              <label for="exampleColorInput" class="form-label">Select Color </label>
              <input type="color" class="form-control form-control-color" name="color" value="#563d7c"
                title="Choose your color">
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

    <button type="button" class="btn btn-secondary col col-md-2 mt-3 mb-5" data-bs-toggle="modal"
      data-bs-target="#exampleModal">
      Add Tag
    </button>

  </div>


  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Color</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($tags as $tag)
      <tr>

        <td>{{$tag->id}}</td>
        <td>{{$tag->name}}</td>
        <td>
          <div class='color' style="background: {{$tag->color}}"> </div>
        </td>
        <td>
          <button class="btn btn-secondary">Edit</button>
          <button class="btn btn-danger">delete</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $tags->links() }}
</div>

<style>
  .color {
    width: 30px;
    height: 30px;
    border-radius: 50%;
  }
</style>
@endsection