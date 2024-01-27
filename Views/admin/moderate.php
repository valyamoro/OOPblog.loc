<?php if (!empty($_SESSION['success'])): ?>
<?php echo \nl2br($_SESSION['success']); ?>
<?php unset($_SESSION['success']); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['warning'])): ?>
    <?php echo \nl2br($_SESSION['warning']); ?>
    <?php unset($_SESSION['warning']); ?>
<?php endif; ?>
<?php if (!empty($warning)): ?>
    <?php echo \nl2br($warning); ?>
    <?php unset($warning); ?>
<?php endif; ?>
<?php foreach ($items as $item): ?>
    <a href="<?php echo "/articles/show?id={$item['id']}"; ?>"><?php echo $item['title']; ?></a><br>
    <form action="delete?page=<?php echo $_GET['page']; ?>&id=<?php echo $item['id']; ?>" method="POST">
        <input type="submit" class="btn btn-danger" value="Delete">
    </form>
    <form action="approve?page=<?php echo $_GET['page']; ?>&id=<?php echo $item['id']; ?>" method="POST">
        <input type="submit" class="btn btn-success" value="Approve">
    </form>
    <br>
<?php endforeach; ?>
