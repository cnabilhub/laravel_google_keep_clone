@extends('layout.master')
@section('title')
Edit Note
@endsection

{{-- {{dd($selectedTags) ;}} --}}


@section('page-title')
<i class="fas fa-edit"></i> Edit Note
@endsection

@section('section')
@if ($categories->count() > 0)
<div class="mb-3 mt-3">
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
</div>
<form action="{{ route('notes.update',$note->id) }}" method="POST">
@method('POST')
@csrf
<input type="text" class="form-control mb-3 text-dark @error('title') is-invalid @enderror"
id="exampleFormControlInput1" placeholder="Title" name="title" value="{{ $note->title }}">

<div class="mb-3">
<textarea class="form-control @error('content') is-invalid @enderror" id="mytextarea" rows="3"
name="content">
{!! $note->content !!}
</textarea>

{{-- Categories --}}
<div class="row mt-3 mb-2">
<div class="col col-md-6">
<label for="exampleFormControlInput1" class="form-label"><i class="fas fa-list-alt"></i> Select
Category
:</label>
<select class="js-example-basic-single form-select" aria-label="Default select example"
name="category_id">

@foreach ($categories as $category)
<option value="{{ $category->id }}" @if ($category->id == $note->category->id) selected @endif>{{ $category->name }}
</option>
@endforeach
</select>
</div>

{{-- TAGS --}}
<div class="col col-md-6">
<label for="exampleFormControlInput1" class="form-label"><i class="fas fa-tags"></i> Mention Tags
:</label>
<select class="form-select js-example-basic-multiple " name="tags[]" multiple="multiple" autocomplete='false'>

@foreach ($tags as $tag)
<option value="{{ $tag->id }}" style="color:{{ $tag->color }}" @if (in_array($tag->id,$selectedTags))
selected  @endif >
{{ $tag->name }}
</option>
@endforeach

</select>
</div>

</div>
<div class="row">

</select></div>

<button type="submit" class="btn btn-warning  mt-4"><i class="fas fa-edit"></i> Update note</button>

</form>
@else

<div class="mt-5 alert bg-light text-center text-dark">
You must add at least one category before create a note!
<br>
Click <a class="text-warning" href="{{ route('categories') }}">Here </a> to add a new category
</div>

@endif

</div>

@section('js')

    <script src="https://cdn.tiny.cloud/1/hlzrlscsfctrtbe3dqzfxtgbdfcwryi89xykg62ytxzgudct/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

        @production
            <script src="{{asset('script/tinymce.min.js')}}" referrerpolicy="origin"></script>
        @endproduction



<script>
tinymce.init({
selector: '#mytextarea',

});


$(document).ready(function() {
$('.js-example-basic-multiple').select2();
$('.js-example-basic-multiple').val([{{implode(",",$selectedTags)}}]);
});

$(document).ready(function() {
$('.js-example-basic-single').select2();
});
</script>
@endsection
@endsection
