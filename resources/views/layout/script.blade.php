{{-- jquery --}}
<script src="{{asset('/script/jquery.js')}}"> </script>





{{-- bootstrap bundle --}}
<script src="{{asset('script/bootstrap.bundle.min.js')}}"></script>





{{-- preloader  --}}
<script src="{{asset('script/jquery.preloader.min.js')}}"> </script>



{{-- SELECT 2 --}}
<script src="{{asset('/script/select2.min.js')}}"> </script>

{{-- sweetalert 2 --}}
<script src="{{asset('/script/sweetalert2.min.js')}}"> </script>

{{-- jquery validate  --}}
<script src="{{asset('/script/jquery.validate.js')}}"> </script>

{{-- jquery dataTables --}}
<script src="{{asset('/script/jquery.dataTables.min.js')}}"> </script>


{{-- bootstrap 5 --}}
<script src="{{asset('/script/bootstrap5.bundle.min.js')}}"> </script> 


{{-- popper --}}
<script src="{{asset('script/popper.min.js')}}"></script>

{{-- bootstrap --}}
<script src="{{asset('script/bootstrap.min.js')}}"></script>


<script>
  $('body').preloader();

 $( document ).ready(function() {
  $('body').preloader('remove')
});

</script>