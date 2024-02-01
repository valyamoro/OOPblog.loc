<?php if (!empty($warning)): ?>
    <?php echo \nl2br($warning); ?>
<?php else: ?>
    <?php if (!empty($_SESSION['success'])): ?>
        <?php displayMessages('success'); ?>
    <?php endif; ?>
    <?php foreach ($items as $item): ?>
        <?php if (!empty($item['title'])): ?>
            <a href="<?php echo "/articles/show?id={$item['id']}"; ?>"><?php echo $item['title']; ?></a><br>
        <?php else: ?>
            <a href="<?php echo "/articles/show?id={$item['id']}"; ?>"><?php echo $item['content']; ?></a><br>
        <?php endif; ?>
        <?php if ($item['is_blocked'] === 1): ?>
            Заблокирована:<br>
            <form action="unBlock?item=<?php echo $_GET['item']; ?>&id=<?php echo $item['id']; ?>" method="POST">
                <input type="submit" class="btn btn-warning" value="Un block">
            </form>
        <?php endif; ?>
        <?php if ($item['is_active'] === 0): ?>
            Не активна: <br>
            <form action="approve?item=<?php echo $_GET['item']; ?>&id=<?php echo $item['id']; ?>" method="POST">
                <input type="submit" class="btn btn-success" value="Approve">
            </form>
        <?php endif; ?>
        <form action="delete?item=<?php echo $_GET['item']; ?>&id=<?php echo $item['id']; ?>" method="POST">
            <input type="submit" class="btn btn-danger" value="Delete">
        </form>

        <br>
    <?php endforeach; ?>
<?php endif; ?>
<?php require_once __DIR__ . '/../pagination.php'; ?>
