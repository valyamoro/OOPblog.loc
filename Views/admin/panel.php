<?php if (empty($_SESSION['user']) || $_SESSION['user']['role'] === '0'): ?>
    <?php \header('Location: /articles'); ?>
<?php endif; ?>

<a href="/admins/category">Добавить новую категорию</a><br>
<a href="/admins/moderate?item=articles">Зайти на страницу рассмотрения статей</a><br>
<a href="/admins/moderate?item=comments">Зайти на страницу рассмотрения комментариев</a><br>
