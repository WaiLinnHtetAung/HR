<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    {{-- pincode  --}}
    <link rel="stylesheet" href="{{ asset('assets/css/pincode.css') }}">

    <title>@yield('title')</title>
    @yield('styles')

    {{-- bootstrap  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- custom css  --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

</head>

<body class="font-sans antialiased">
    @yield('content')
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

{{-- pin code  --}}
<script src="{{ asset('assets/js/pincode.js') }}"></script>

{{-- sweetalert  --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('scripts')

<script>
    //csrf token
    let token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
        $.ajaxSetup({
            headers: {
                'X-CSRF_TOKEN': token.content
            }
        })
    }
</script>

</html>
