@extends('layout.master')
@section('title')
    Google Keep Clone
@endsection

@section('page-title')
    <i class="fas fa-sticky-note"></i> Notes
    @if($data['term'])
    - Search for " {{$data['term']}} "
    @endif
@endsection

@section('section')

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6 d-flex  align-items-center ">

                            <div class="bg-white p-3 d-flex justify-content-between align-items-center rounded">
                @if ($data['notes']->count() > 0)

                    <div class="cat-selector">
                        <select id='cat' class="form-control d-inline">
                            <option selected value="0">All Categories</option>
                            @foreach ($data['categories'] as $category)
                                @if ($category->notes->count() != null)

                                    <option value="{{ $category->id }}" @isset($data['selected']) @if ($category->id == $data['selected']) selected
                                @endif @endisset >
                                {{ $category->name }}({{ $category->notes->count() }})
                                </option>
                            @endif
                @endforeach

                </select>

            </div>

            </div>
           

            @endif
        </div>
      

    </div>

    <div class="row">

        @forelse ($data['notes'] as $note)

            <div class="col col-md-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $note->title }}</h5>
                        <div class="card-text note-content">
                            {!! \Illuminate\Support\Str::limit($note->content, 180, $end = '...') !!}
                        </div>

                        <a href="{{route('home',$note->category->id)}}" class="card-subtitle ml-2 mb-4">
                            <i class="far fa-list-alt"></i>
                            {{ $note->category->name }}</a>

                        <br>


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

                        <div class="dropdown-divider mt-3 mb-3"></div>

                        <div class="mt-2 mb2 actions d-flex justify-space-between">

                            <a href="{{ route('notes.show', $note->id) }}"
                                class=" btn btn-sm btn-secondary  rounded  btn-action "><i class="fas fa-eye"></i></a>
                            <a href="{{ route('notes.edit', $note->id) }}"
                                class=" btn btn-sm btn-warning  rounded  btn-action "><i class="fas fa-edit"></i></a>

                            <button class=" btn btn-sm btn-success rounded  copy btn-action "
                                onclick="copy({{ $note->id }})">
                                <i class="fas fa-clipboard"></i>
                            </button>

                            <button onclick="deleteitem({{ $note->id }})" type="submit"
                                class=" btn btn-sm btn-danger rounded  h-100 btn-action "><i class="fas fa-trash"></i>
                            </button>


                            <span class="small-text mb-2 mt-1 mx-2"><i class="far fa-clock"></i>
                                {{ \Carbon\Carbon::parse($note->updated_at)->diffForHumans() }} </span>
                        </div>
                    </div>

                    <input type="text" class="opacity-0 note-{{ $note->id }}"
                        value="{{ strip_tags($note->content) }}">
                </div>
            </div>

        @empty
            @include('layout.empty')
        @endforelse

          <div class="row p-3 bg-light">
               <div class="col-md-12 d-flex justify-content-end align-items-center ">
                {{ $data['notes']->links() }}
            </div>
          </div>

    </div>
    </div>
    @section('js')


        <script>

            //  Auto change categories
            if(document.getElementById('cat')){
            document.getElementById('cat').addEventListener('change', () => {
                        searchAndFilter()
                        });
            }

            function copy(id) {
                var copyText = document.querySelector(`.note-${id}`);
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");

                Toast.fire({
                    icon: 'success',
                    title: "Text copied"
                })
            }


            // DELETE ITEM
            function deleteitem(id) {


                Swal.fire({
                    title: 'Do you want Delete this category?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: `DELETE`,
                    denyButtonText: `Cancel`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('notes.destroy') }}",
                            type: 'DELETE',
                            data: {
                                'id': id
                            }
                        }).done(function(server_data) {

                            if (server_data.message) {

                                Toast.fire({
                                    icon: 'success',
                                    title: server_data.message
                                })
                                setTimeout(() => {
                                    window.location.href = "{{ route('home') }}"
                                }, 1000)

                            }

                            if (server_data.error) {

                                Toast.fire({
                                    icon: 'error',
                                    title: server_data.error
                                })

                            }

                        }).fail(function(jqXHR, textStatus, errorThrown) {

                            Toast.fire({
                                icon: 'error',
                                title: 'Somting went wrong in the server '
                            })
                        });

                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })

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
@endsection
