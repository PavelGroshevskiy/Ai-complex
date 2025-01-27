<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <nav>

    <a href="/create">Create Posts</a>
</nav>

<h2> Posts</h2>
 <span>
            <button id="refresh_posts">
                Refresh Posts
            </button>
        </span>
<ul>
    @forelse($posts as $post)

    <li class="post_card">
            {{-- <a href="{{ route('posts.show', $post->id) }}"> --}}
                {{-- <p class="hidden_id" hidden>{{ $post->id }}</p> --}}
                {{ $post->title }}
            </a>
            <p> - {{$post->description}}</p>
            <span>
                <button data-num = {{$post->id}} class="delete_post">
                   Delete
                </button>
            </span>

    </li>
    <hr>
    @empty
    <li>No Posts Found</li>
    @endforelse
</ul>

    <div id="result"></div>

</body>
 <script type="text/javascript">
        $('.post_card .delete_post').on('click', function(e) {

            console.log( $(this).attr('data-num'))
            $.ajax({
                url:`api/v1/posts/${$(this).attr('data-num')}`,
                type: "DELETE",

            })
        })

        $('#refresh_posts').on('click',function() {

            $('div#result').load('api/v1/posts', function(data, status, response) {
                console.log(data)
            })

            $.getJSON('api/v1/posts',
                function(result) {
                    $.each(result , function() {
                        console.log(this.title)
                    })
                });
        })


    </script>
</html>


