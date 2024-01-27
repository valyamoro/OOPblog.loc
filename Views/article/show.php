<?php echo $article['id']; ?> <br>
<?php echo $article['title']; ?> <br>
<?php echo $article['content']; ?> <br>
<br>
Комментарии: <br>
<?php if (!empty($warning)): ?>
    <?php echo \nl2br($warning); ?>
    <?php unset($warning); ?>
<?php else: ?>
    <?php foreach ($comments as $comment): ?>
        Автор: <?php echo $comment['firstName']; ?> <br>
        Комментарий: <?php echo $comment['content']; ?> <br>
    <?php endforeach; ?>
<br>
<?php endif; ?>
<br>
