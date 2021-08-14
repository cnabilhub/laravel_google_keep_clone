@extends('layout.master')
@section('title')
Google Keep Clone
@endsection
@section('section')
<div class="container">


  <div class="row mb-4">
    <div class="bg-white p-3 d-flex justify-content-between align-items-center rounded">
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
    border-bottom-left-radius: 15px;">
        <div class="card-body">

          <h5 class="card-title">{{$note->title}}</h5>


          <p class="card-text ">{!!\Illuminate\Support\Str::limit($note->content, 150, $end='...') !!}</p>

          <span class="card-subtitle mb-3 mb-4 text-muted"><i class="far fa-clock"></i>
            {{\Carbon\Carbon::parse($note->updated_at)->diffForHumans()}}</span>

          <div class="dropdown-divider mt-3 mb-3"></div>
          <div class="mt-2 mb2 actions d-flex justify-space-between">
            <button class="btn btn-sm btn-success rounded mx-2 copy" data-id="{{$note->id}}"> <i
                class="fas fa-clipboard"></i> Copy </button>
            <form action="{{route('notes.destroy')}}" method="POST">
              @csrf
              <input type="hidden" name='id' value="{{$note->id}}">
              <button type="submit" class="btn btn-sm btn-danger rounded mx-2"><i class="fas fa-trash"></i>
                Delete</button>
            </form>
          </div>
        </div>
      </div>
      <input type="text" class="opacity-0 note-{{$note->id}}" value="{{strip_tags($note->content)}}">
    </div>

    @endforeach


  </div>
</div>
<script>
  //  Auto change categories
  document.getElementById('cat').addEventListener('change',()=>{
  var cat = document.getElementById('cat').value;
  cat = '/'+cat+'';
    window.location.href = cat;
});

// 
  btn = document.querySelectorAll('.copy').forEach((btn)=>{
btn.addEventListener('click',(e)=>{
  
  id = e.target.dataset.id;
  console.log(id);
  copy(id)
  })
  });

  function copy(id) {
  var copyText = document.querySelector(`.note-${id}`);
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  toastr.options =
    {
    "closeButton" : true,
    "progressBar" : true
    }
    toastr.success("Text copied")
  }

  
</script>

<style>
  #cat {
    padding: 10px;
    min-width: 190px;
    margin-left: 2rem;
  }
</style>
@endsection