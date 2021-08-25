<!DOCTYPE html>
<html>
@include('layout.head')

<body>

    @include('layout.header')

    <div class="container">

        <div class="mt-2">

            <div class="card pb-3`">
                <div class="card-header bg-warning p-3">
                    <h5>

                        @yield('page-title')
                    </h5>
                </div>
                <div class="card-body">
                    @yield('section')

                </div>
            </div>
        </div>


    </div>

    @include('layout.script')

    {{-- toasrt errors  --}}

    <script>
        // Swal Options 

const Toast = Swal.mixin({
toast: true,
position: 'bottom-end',
showConfirmButton: false,
timer: 3000,
timerProgressBar: true,
didOpen: (toast) => {
toast.addEventListener('mouseenter', Swal.stopTimer)
toast.addEventListener('mouseleave', Swal.resumeTimer)
}
})

  @if(Session::has('message'))
        Toast.fire({
        icon: 'success',
        title: "{{ session('message') }}"
        })
  @endif

  @if(Session::has('error'))
        Toast.fire({
        icon: 'error',
        title: "{{ session('error') }}"
        })

  @endif

  
    </script>

    @yield('js')
</body>

</html>