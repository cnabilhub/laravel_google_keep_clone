@extends('layout.master')
@section('title')
Google Keep Clone
@endsection

@section('page-title')
<i class="fas fa-home"></i> Notes
@endsection

@section('section')


<div class="container">
  <div class="row mb-4">
    <div class="bg-white p-3 d-flex justify-content-between align-items-center rounded">
      @if ($data['notes']->count()>0)

      <div class="">
        Select Category
        <select id='cat' class="custom-select custom-select-md inline">
          <option selected value="">All</option>
          @foreach ($data['categories'] as $category)
          @if ($category->notes->count() != null)

          <option value="{{$category->id}}" @isset($data['selected']) @if($category->id == $data['selected']) selected
            @endif @endisset>
            {{$category->name}}({{$category->notes->count()}})
          </option>
          @endif
          @endforeach

        </select>
      </div>
      @endif
      {{ $data['notes']->links() }}
    </div>

  </div>

  <div class="row">

    @forelse ($data['notes'] as $note)

    <div class="col col-md-4 mb-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{$note->title}}</h5>
          <div class="card-text note-content">
            {!!\Illuminate\Support\Str::limit($note->content, 180, $end='...') !!}
          </div>

          <a href="/{{$note->category->id}}" class="card-subtitle ml-2 mb-4">
            <i class="far fa-list-alt"></i>
            {{$note->category->name}}</a>

          <br>





          {{-- TAGS --}}
          <div class="tags mt-4">
            @foreach ($note->tags as $tag)
            <a href="#" class="tag-link text-decoration-none">
              <span class="tag rounded px-3 py-1 bg-light rounded-pill"
                style="border: 2px solid{{$tag->color}};color: {{$tag->color}};">
                {{$tag->name}}</span>
            </a>
            @endforeach
          </div>

          <div class="dropdown-divider mt-3 mb-3"></div>

          <div class="mt-2 mb2 actions d-flex justify-space-between">

            <button class="btn btn-sm btn-secondary  rounded mx-1"> <i class="fas fa-eye"></i></button>
            <button class="btn btn-sm btn-warning  rounded mx-1"> <i class="fas fa-edit"></i></button>

            <button class="btn btn-sm btn-success rounded mx-1 copy" onclick="copy({{$note->id}})"> <i
                class="fas fa-clipboard"></i>
            </button>
            <form action="{{route('notes.destroy')}}" method="POST">
              @csrf
              <input type="hidden" name='id' value="{{$note->id}}">
              <button type="submit" class="btn btn-sm btn-danger rounded mx-1 h-100"><i class="fas fa-trash"></i>
              </button>
            </form>

            <span class="card-subtitle mb-2 mt-1 mx-2"><i class="far fa-clock"></i>
              {{\Carbon\Carbon::parse($note->updated_at)->diffForHumans()}} </span>
          </div>
        </div>

        <input type="text" class="opacity-0 note-{{$note->id}}" value="{{strip_tags($note->content)}}">
      </div>
    </div>

    @empty
    @include('layout.empty')
    @endforelse

  </div>
</div>
<script>
  //  Auto change categories
document.getElementById('cat').addEventListener('change',()=>{
var cat = document.getElementById('cat').value;
cat = '/'+cat+'';
window.location.href = cat;
});

function copy(id) {
var copyText = document.querySelector(`.note-${id}`);
copyText.select();
copyText.setSelectionRange(0, 99999)
document.execCommand("copy");

Toast.fire({ icon: 'success', title: "Text copied" })
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