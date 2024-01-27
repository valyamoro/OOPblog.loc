<?php foreach ($articles as $article): ?>
<a href="<?php echo "/articles/show?id={$article['id']}"; ?>"><?php echo $article['title']; ?></a><br>
<?php endforeach; ?>
