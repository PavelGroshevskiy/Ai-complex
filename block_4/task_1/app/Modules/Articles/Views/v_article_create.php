<div class="article-item-create">
    <h1><?echo $title?></h1>
    <form method='post'>
        <input type='text' name='title' placeholder="title"
            value='<?php echo htmlspecialchars($_POST['title'] ?? '', ENT_QUOTES); ?>' />
        <input type='text' name='content' placeholder="content"
            value='<?php echo htmlspecialchars($_POST['content'] ?? '', ENT_QUOTES); ?>' />
        <input type='submit' value='Отправить' />
    </form>
</div>

