<!DOCTYPE html>

<html lang="en">

<head>
                                     {{-- Bootstrap Files --}}

        @include('includes.heads')

</head>

<body>

                                        {{--Navigation Bar--}}

    @include('includes.header')

    @yield('content')
                                            {{--Footer--}}

    @include('includes.footer')

                                        {{-- Scripts Files --}}

    @include('includes.scripts')


    @yield('page-scripts')

    </body>

</html>
