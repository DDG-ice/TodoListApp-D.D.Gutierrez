<!DOCTYPE html>
<html lang="en">
<head>
    <title>My To Do List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('style')
</head>
<body class="container max-auto mt-10 max-w-lg">
    <h1 class="text-2xl mb-4">@yield('title')</h1>
    <div>
        @if(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>