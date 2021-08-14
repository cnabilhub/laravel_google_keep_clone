@extends('layout.master')
@section('title')
Add Note
@endsection

@section('section')
<h3> Add Note </h3>


<div class="mb-3 mt-3">
  <form action="{{route('notes.store')}}" method="POST">
    @method('POST')
    @csrf
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title" name="title">
</div>
<div class="mb-3">
  <textarea class="form-control" id="mytextarea" rows="3" name="content"></textarea>

  <div class="row mt-3 mb-2">
    <div class="col col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Category :</label>
      <select class="form-select" aria-label="Default select example" name="category_id">
        <option value="">Uncategorized</option>
        @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>

        @endforeach

      </select>
    </div>

    <div class="col col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Tags :</label>
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

<script src="https://cdn.tiny.cloud/1/hlzrlscsfctrtbe3dqzfxtgbdfcwryi89xykg62ytxzgudct/tinymce/5/tinymce.min.js"
  referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: '#mytextarea',
    
  });
</script>
@endsection