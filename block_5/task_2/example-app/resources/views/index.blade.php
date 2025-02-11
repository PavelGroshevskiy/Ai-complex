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
        <button id="refresh_posts_html">
            Refresh Posts Html
        </button>
        <button id="refresh_posts_json">
            Refresh Posts json
        </button>
    </span>

    <ul id="posts">

        @forelse($posts as $post)

            <li class="post_card">
                <p class="title">  {{ $post->title }}</p>
                <p class="description"> - {{$post->description}}</p>

                <button data-num = {{$post->id}} class="delete_post">
                    Delete
                </button>

                <hr>
            </li>

        @empty
        <li>No Posts Found</li>
        @endforelse
    </ul>
    <div id='html'>
        <ul id="result">

        </ul>
    </div>
</body>

 <script type="text/javascript">


        const jsonData = {
            container: '#result',
            url: 'api/v1/posts',
            delay:2000,
            attemps:3,

            reset: function() {
                this.delay = 2000;
                this.attempts = 3;
                },

            load: function() {
                    let json_data = this;
                        $.ajax({
                            type:"get",
                            url: this.url,
                            success: function(data) {
                                $('#posts').remove()
                                $('#result').remove()
                                $('body').append('<div id=result> </div>')

                                $.each(data, function(idx,item) {
                                    console.log(item)
                                            let title = '<p>' + item.title + '</p>'
                                            let description = '<p>' + item.description + '</p>'
                                            let button = '<button data-num =' + item.id + " class=delete_post> Delete </button>"

                                            let post = '<li class="post_card">'
                                                    +title
                                                    +description
                                                    +button
                                                    +'<hr>'
                                                    +'</li>'

                                            $('#result').append(post)

                                            $('.post_card .delete_post').on('click', function(e) {
                                                $(this).parent().remove()
                                                $.ajax({
                                                    url:`api/v1/posts/${$(this).attr('data-num')}`,
                                                    type: "DELETE",
                                                })
                                            })
                                        });

                                    },
                            error: function(xhr, status) {
                                        if (json_data.attemps-- == 0) {
                                            $('body').append('<h1> Error Connection </h1>')
                                            json_data.reset();
                                            return;
                                        }
                                        setTimeout(function() {
                                            json_data.load();
                                            }, json_data.delay *= 2);
                                    }

                        });
                },

            display: function (data) {},
            }

        $('#refresh_posts_html').on('click',function() {
            $('div#html').load('api/v1/posts', function(data, status, response) {
                console.dir({data,status,response})

                $(document).ready(function() {
                // URL для AJAX-запроса
                var url = 'api/v1/posts';

                // Выполняем AJAX-запрос
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'html',
                    success: function(data) {
                        console.log(data)
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Ошибка при загрузке данных: ', textStatus, errorThrown);
                    }
                });
            });

            })
        })

            //d

        $('#refresh_posts_json').on('click',function() {

            jsonData.load()

            // $.get('api/v1/posts')
            //     .done(function(data,status,xhr) {
            //         console.dir({data,status,xhr})
            //     })
            //     .fail(function(data,status,xhr) {
            //         // console.dir({data,status,xhr})
            //     })
            //     .always(function(data,status,xhr) {
            //         // console.dir({data,status,xhr})
            //     })
        })

        $('.post_card .delete_post').on('click', function(e) {

            $(this).parent().remove()
            $.ajax({
                url:`api/v1/posts/${$(this).attr('data-num')}`,
                type: "DELETE",
            })
        })
    </script>
</html>


