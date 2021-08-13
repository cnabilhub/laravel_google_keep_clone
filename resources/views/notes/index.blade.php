@extends('layout.master')
@section('title')
Google Keep Clone
@endsection
@section('section')
<div class="container">


  <div class="row mb-4">
    <div class="bg-light p-3 d-flex justify-content-between align-items-center rounded">
      <div>
        Select Category
        <select id='cat' class="custom-select custom-select-md inline">
          <option selected value="">All</option>

          @foreach ($data['categories'] as $category)
          <option value="{{$category->id}}" @isset($data['selected']) @if($category->id == $data['selected']) selected
            @endif @endisset>
            {{$category->name}}
          </option>
          @endforeach

        </select>
      </div>
      {{ $data['notes']->links() }}
    </div>

  </div>

  <div class="row">

    @foreach ($data['notes'] as $note)

    <div class="col-md-4 mb-2">
      <div class="card" style="border-bottom: 5px solid {{$note->tag->color}};
    border-bottom-right-radius: 15px;
    border-bottom-left-radius: 15px;
}">
        <div class="card-body">

          <h5 class="card-title">{{$note->title}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">{{$note->updated_at}}</h6>
          <p class="card-text">{{$note->content}}</p>

          <form action="{{route('notes.destroy')}}" method="POST">
            @csrf
            <input type="hidden" name='id' value="{{$note->id}}">
            <button type="submit" class="btn btn-sm btn-danger rounded">Delete</button>
          </form>
        </div>
      </div>
    </div>

    @endforeach


  </div>
</div>
<script>
  document.getElementById('cat').addEventListener('change',()=>{
  var cat = document.getElementById('cat').value;
  cat = '/'+cat+'';
  console.log(cat)
    window.location.href = cat;
});
</script>
<style>
  #cat {
    padding: 10px;
    min-width: 190px;
    margin-left: 2rem;
  }
</style>
@endsection