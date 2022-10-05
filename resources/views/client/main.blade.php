<!DOCTYPE html>
<html lang="en">

<head>
    @include('client.components.head')

    @yield('head')
</head>

<body> {{-- class="animsition" --}}

    <!-- Header -->
    @include('client.components.header')

    <!-- Cart -->
    @include('client.carts.yourCart')

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    @include('client.components.footer')

    @yield('footer')

</body>

</html>
