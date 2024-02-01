<?php if ($pagination->calculateTotalPages() > 1): ?>
    ФИЛЬТР: <br>
    <a href="<?php echo $pagination->getQueryString() . "page={$pagination->getCurrentPage()}&mode=desc" ?>">Сначала
        новые</a> <br>
    <a href="<?php echo $pagination->getQueryString() . "page={$pagination->getCurrentPage()}&mode=asc" ?>">Сначала
        старые</a> <br>
    <br>
    <nav aria-label="navigation">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="<?php echo "{$pagination->moveLeft()}&mode={$pagination->getOrder()}" ?>"
                   aria-label="Prev">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php echo $pagination->generatePaginationLinks($_GET); ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo "{$pagination->moveRight()}&mode={$pagination->getOrder()}" ?>"
                   aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
<?php endif; ?>

