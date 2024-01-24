<?php if (!empty($_SESSION['warning'])): ?>
    <?php echo nl2br($_SESSION['warning']); ?>
    <?php unset($_SESSION['warning']); ?>
<?php else: ?>
    <?php foreach ($articles as $article): ?>
        <?php echo $article['title']; ?> <br>
        <?php echo $article['content']; ?> <br>
        <br>
    <?php endforeach; ?>
    <nav aria-label="Пример навигации по страницам">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="<?php echo $paginator->moveLeft() ?>" aria-label="Предыдущая">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php echo $paginator->generatePaginationLinks(); ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $paginator->moveRight() ?>" aria-label="Следующая">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
<?php endif; ?>

