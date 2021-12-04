{{-- jquery  --}}
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

{{-- preloader  --}}
<script src="{{asset('script/jquery.preloader.min.js')}}"></script>

<script>
  $('body').preloader();

 $( document ).ready(function() {
  $('body').preloader('remove')
});
</script>

{{-- bootstrap 4.6 --}}
<script src="{{asset('/script/bootstrap.bundle.min.js')}}"</script>


{{-- bootstrap 4.6 --}}
<script src="{{asset('/script/bootstrap5.bundle.min.js')}}"></script> 


{{-- SELECT 2 --}}
<script src="{{asset('/script/select2.min.js')}}"> </script>

{{-- sweetalert 2 --}}
<script src="{{asset('/script/sweetalert2.min.js')}}"> </script>


{{-- jquery validate  --}}
<script src="{{asset('/script/jquery.validate.js')}}"> </script>

{{-- jquery dataTables --}}
<script src="{{asset('/script/jquery.dataTables.min.js')}}"> </script>