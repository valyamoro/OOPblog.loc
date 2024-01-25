<?php if (!empty($_SESSION['warning'])): ?>
    <?php echo \nl2br($_SESSION['warning']); ?>
    <?php unset($_SESSION['warning']); ?>
<?php else: ?>
    Данные пользователя: <br>
    <?php echo $user['firstName']; ?> <br>
    <?php echo $user['email']; ?> <br>
    <?php echo $user['created_at']; ?> <br>
    <br>
    Статьи пользователя: <br>
    <?php foreach ($articles as $article): ?>
        <a href="<?php echo "/articles/show?id={$article['id']}"; ?>"><?php echo $article['title']; ?></a><br>
        <br>
    <?php endforeach; ?>
<?php endif; ?>
