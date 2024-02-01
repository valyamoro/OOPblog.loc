<?php if (!empty($_SESSION['message'])): ?>
    <?php displayMessages('message'); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['warning'])): ?>
    <?php displayMessages('warning'); ?>
<?php else: ?>
    <?php if (!empty($_SESSION['success'])): ?>
        <?php displayMessages('success'); ?>
        <br><br>
    <?php endif; ?>
    <?php if (!empty($_SESSION['message'])): ?>
        <?php displayMessages('message'); ?>
        <br><br>
    <?php endif; ?>
    <?php foreach ($articles as $article): ?>
        <a href="<?php echo "/articles/show?id={$article['id']}"; ?>"><?php echo $article['title']; ?></a><br>
        <br>
    <?php endforeach; ?>
<?php endif; ?>
<?php require __DIR__ . '/../pagination.php'; ?>

