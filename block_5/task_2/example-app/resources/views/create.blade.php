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
    <a href="/">Posts</a>

</nav>
<div class="col-12">

    <h2>Create Post</h2>
    <form id="create_post" method="POST" action="api/v1/posts" >
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" class="pt-6 dark:bg-black">

        <label for="description">Body</label>
        <input type="text" name="description" >

        <input type="submit" value="submit">

    </form>
    <span></span>
</div>

</body>
    <script>
        // $('form').on('submit',function(e) {
        //     e.preventDefault();
        //     let formData = new FormData()
        //     console.log(formData)
        // })
        $('form').on('submit',function(e) {


            let $form = $(this)
            e.preventDefault();
            $form.find('.error').remove();

            if ($form.find("input[name=title]").val() === "" ||
                $form.find("input[name=description]").val() === "") {
                $( "span" ).text( "Заполните все поля" ).show().fadeOut( 1000 );
            return false;
            }

            $.post(
                $form.attr('action'),
                $form.serialize()
            );
            $( "span" ).text( "Отправлено" ).show().fadeOut(1999);
        })

    </script>
</html>
