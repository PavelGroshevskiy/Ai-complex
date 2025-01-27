<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <title>@yield('title', 'My App')</title>
    </head>

    <body class="bg-gray-100">
        <h1>My App</h1>
        @include('partials.navbar')
        <main class="container mx-auto p-4 mt-4">
            @yield('content')
        </main>

    </body>
    <script type="text/javascript">
        $('.delete_post').on('click',function() {
            console.log('click')
        })

        $('#refresh_posts').on('click',function() {
            console.log('click')

             $.ajax({
  url: "/posts",
  context: document.body
}).done(function() {
  $( this ).addClass( "done" );
});
        })

    </script>
</html>
