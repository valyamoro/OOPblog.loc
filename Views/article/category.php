<?php if (!empty($_SESSION['message'])): ?>
    <?php echo nl2br($_SESSION['message']); ?>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['warning'])): ?>
    <?php echo \nl2br($_SESSION['warning']); ?>
    <?php unset($_SESSION['warning']); ?>
<?php else: ?>
    <?php if (!empty($_SESSION['success'])): ?>
        <?php echo \nl2br($_SESSION['success']); ?>
        <?php unset($_SESSION['success']); ?>
        <br><br>
    <?php endif; ?>
    <?php if (!empty($_SESSION['message'])): ?>
        <?php echo \nl2br($_SESSION['message']); ?>
        <?php unset($_SESSION['message']); ?>
        <br><br>
    <?php endif; ?>
    <?php foreach ($articles as $article): ?>
        <a href="<?php echo "/articles/show?id={$article['id']}"; ?>"><?php echo $article['title']; ?></a><br>
        <br>
    <?php endforeach; ?>
<?php endif; ?>
<?php require __DIR__ . '/../pagination.php'; ?>

