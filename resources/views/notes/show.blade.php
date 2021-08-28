@extends('layout.master')
@section('title')
    Note {{ $note->id }}
@endsection

@section('page-title')
    <i class="fas fa-sticky-note"></i> Note {{ $note->id }}
@endsection

@section('section')
    <div class="row">
        <div class="col col-md-8 p-4">
            <h3> {{ $note->title }}</h3>
            <div>
                {!! $note->content !!}
            </div>
        </div>
        <div class="col col-md-4">
            <div class="card">
                <div class="card-header bg-warning">
                    Details
                </div>
                <br>
                <a href="/{{ $note->category->id }}" class="card-subtitle mb-1 p-1 mx-2 mt-3">
                    <i class="far fa-list-alt"></i>
                    {{ $note->category->name }}
                </a>

                <div class="card-subtitle mb-1 p-1 mx-2"><i class="far fa-clock"></i>
                    {{ \Carbon\Carbon::parse($note->updated_at)->diffForHumans() }}
                </div>

                <div class="tags">
                    {{-- TAGS --}}
                    <div class="tags mt-4">
                        @foreach ($note->tags as $tag)
                            <a href="#" class="tag-link text-decoration-none">
                                <span class="tag rounded px-3 py-1 bg-light rounded-pill"
                                    style="border: 2px solid{{ $tag->color }};color: {{ $tag->color }};">
                                    {{ $tag->name }}</span>
                            </a>
                        @endforeach
                    </div>

                     <a href="{{ route('notes.edit', $note->id) }}"
                                class=" btn btn-warning  rounded text-dark mx-3 my-4 "><i class="fas fa-edit"></i> Edit </a>
                </div>

               
            </div>
        </div>
    </div>
@endsection
