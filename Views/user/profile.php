<?php if (!empty($_SESSION['warning'])): ?>
    <?php displayMessages('warning'); ?>
<?php else: ?>
    User data: <br>
    <?php echo $user['first_name']; ?> <br>
    <?php echo $user['email']; ?> <br>
    <?php echo $user['created_at']; ?> <br>
    <br>
    Articles user: <br>
    <?php if (!empty($warning)): ?>
        <?php echo \nl2br($warning); ?>
    <?php else: ?>
        <?php foreach ($articles as $article): ?>
            <a href="<?php echo "/articles/show?id={$article['id']}"; ?>"><?php echo $article['title']; ?></a><br>
            <br>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>

<?php require_once __DIR__ . '/../pagination.php'; ?>
