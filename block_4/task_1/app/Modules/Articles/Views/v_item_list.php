
<div class="article-item-list">
    <table>
        <tr>
            <td><strong>Number</strong></td>
            <td><strong>Title</strong></td>
            <td><strong>Content</strong></td>
        </tr>
        <? foreach($articles as $key => $value): ?>
            <tr>
                <td><?echo $key?></td>
                <td>  
                <a href="article/<?echo $key?>" >
                    <?php echo $value['title']?>
                </a>
            </td>
            <td><?php echo $value['content']?></td>
        </tr>
        <? endforeach; ?>
    </table>    
</div>
<hr>
---------------------
