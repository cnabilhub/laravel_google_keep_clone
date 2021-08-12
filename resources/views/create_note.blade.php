@extends('layout.master')
@section('title')
Add Note
@endsection

@section('section')
<h6> Add Note </h6>


<div class="mb-3">
  <form action="{{route('save_note')}}" method="POST">
    @method('POST')
    @csrf
    <label for="exampleFormControlInput1" class="form-label">Title :</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="note title" name="title">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Note content</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>

  <div class="row mt-3 mb-2">
    <div class="col col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Title :</label>
      <select class="form-select" aria-label="Default select example" name="category_id">
        @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>

        @endforeach

      </select>
    </div>

    <div class="col col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Title :</label>
      <select class="form-select" aria-label="Default select example" name="tag_id">
        @foreach ($tags as $tag)
        <option value="{{$tag->id}}" style="color:{{$tag->color}}">{{$tag->name}}</option>

        @endforeach

      </select>
    </div>
  </div>

  <button type="submit" class="btn btn-success mt-4">Save</button>


  </form>

</div>
@endsection