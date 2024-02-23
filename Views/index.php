<?php if (!empty($_SESSION['success'])): ?>
    <?php displayMessages('success'); ?>
    <br><br>
<?php endif; ?>
<?php if (!empty($_SESSION['message'])): ?>
    <?php displayMessages('message'); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['warning'])): ?>
    <?php displayMessages('warning'); ?>
<?php else: ?>
    <?php if (!empty($_SESSION['message'])): ?>
        <?php displayMessages('message'); ?>
    <?php endif; ?>
    <?php foreach ($articles as $article): ?>
        <?php if (!empty($_SESSION['user']) && ($article['is_blocked'] === 1 && $_SESSION['user']['role'] === '1')): ?>
            Заблокирована<br>
        <?php endif; ?>
        <?php if (!empty($_SESSION['user']) && ($article['is_blocked'] === 1 && $_SESSION['user']['role'] !== '1')): ?>
            <?php continue; ?>
        <?php endif; ?>
        <?php if (empty($_SESSION['user']) && $article['is_blocked'] === 1): ?>
            <?php continue; ?>
        <?php endif; ?>
        <a href="<?php echo "/articles/show?id={$article['id']}"; ?>"><?php echo $article['title']; ?></a><br>
        <img src="<?php echo $article['image_path']; ?>" alt=""><br>
    <?php endforeach; ?>
<?php endif; ?>
<br>
<?php require_once __DIR__ . '/pagination.php'; ?>
