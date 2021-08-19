@include('layout.head')
@include('layout.header')

<div class="container">

    <div class="mt-2">

        <div class="card pb-3`">
            <div class="card-header">
                <h3>

                    @yield('page-title')
                </h3>
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
    // toastr Options 

    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "00",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }

  @if(Session::has('message'))
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  		toastr.warning("{{ session('warning') }}");
  @endif
  
</script>
@yield('js')
</body>

</html>