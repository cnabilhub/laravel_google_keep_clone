@extends('layout.master')
@section('title')
Add Note
@endsection

@section('section')
<h3> Add Note </h3>


<div class="mb-3 mt-3">
  @if ($categories->count()>0)
  <form action="{{route('notes.store')}}" method="POST">
    @method('POST')
    @csrf
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title" name="title">
</div>
<div class="mb-3">
  <textarea class="form-control" id="mytextarea" rows="3" name="content"></textarea>

  {{-- Categories --}}
  <div class="row mt-3 mb-2">
    <div class="col col-md-6">
      <label for="exampleFormControlInput1" class="form-label"><i class="fas fa-list-alt"></i> Category :</label>
      <select class="form-select" aria-label="Default select example" name="category_id">

        @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
      </select>
    </div>

    {{-- TAGS --}}
    <div class="col col-md-6">
      <label for="exampleFormControlInput1" class="form-label"><i class="fas fa-tags"></i> Tags :</label>
      <select class="form-select js-example-basic-multiple " name="tags[]" multiple="multiple">

        @foreach ($tags as $tag)
        <option value="{{$tag->id}}" style="color:{{$tag->color}}">{{$tag->name}}</option>
        @endforeach

      </select>
    </div>

  </div>
  <div class="row">

    </select></div>



  <button type="submit" class="btn btn-warning btn-lg mt-4"><i class="fas fa-save"></i> Create note</button>


  </form>
  @else

  <h3 class="col text-center">
    You must add at least one category before create a note!
  </h3>

  @endif

</div>




@section('js')

<script src="https://cdn.tiny.cloud/1/hlzrlscsfctrtbe3dqzfxtgbdfcwryi89xykg62ytxzgudct/tinymce/5/tinymce.min.js"
  referrerpolicy="origin"></script>

<script>
  tinymce.init({
selector: '#mytextarea',

});


$(document).ready(function() {
$('.js-example-basic-multiple').select2();
});
</script>
@endsection
@endsection