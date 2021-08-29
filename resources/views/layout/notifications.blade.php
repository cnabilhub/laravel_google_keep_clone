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