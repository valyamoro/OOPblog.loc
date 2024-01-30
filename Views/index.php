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
<?php if ($paginator->calculateTotalPages() > 1): ?>
    ФИЛЬТР: <br>
    <a href="<?php echo "?page={$paginator->getCurrentPage()}&mode=desc" ?>">Сначала новые</a> <br>
    <a href="<?php echo "?page={$paginator->getCurrentPage()}&mode=asc" ?>">Сначала старые</a> <br>
    <br>
    <nav aria-label="navigation">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="<?php echo "{$paginator->moveLeft()}&mode={$paginator->getOrder()}" ?>"
                   aria-label="Prev">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php echo $paginator->generatePaginationLinks(); ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo "{$paginator->moveRight()}&mode={$paginator->getOrder()}" ?>"
                   aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
<?php endif; ?>
