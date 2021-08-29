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

@include('layout.notifications')

    @yield('js')
    @include('layout.footer')
</body>

</html>