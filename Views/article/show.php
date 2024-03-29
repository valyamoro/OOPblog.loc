<?php if (!empty($_SESSION['user']['id']) && ($_SESSION['user']['id'] === (int)$article['id_user'] || $_SESSION['user']['role'] === '1')): ?>
    <a href="<?php echo "/articles/edit?id={$article['id']}"; ?>">Edit</a> <br><br>
    <a href="<?php echo "/articles/delete?id={$article['id']}"; ?>">Delete</a> <br><br>
<?php endif; ?>
<?php if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === '1' && $article['is_blocked'] === 0): ?>
    <a href="<?php echo "/articles/block?id={$article['id']}"; ?>">Block</a> <br><br>
<?php endif; ?>
<?php if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === '1' && $article['is_blocked'] === 1): ?>
    <a href="<?php echo "/articles/unblock?id={$article['id']}"; ?>">Un block</a> <br><br>
<?php endif; ?>
Author: <br> <a href="/users/profile?id=<?php echo $article['id_user']; ?>"><?php echo $article['first_name']; ?></a>
<br><br>
Article:<br><?php echo $article['id']; ?> <br>
<?php echo $article['title']; ?> <br>
<?php echo $article['content']; ?> <br>
<br>
<?php if (!empty($_SESSION['success'])): ?>
    <?php displayMessages('success'); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['warning'])): ?>
    <?php displayMessages('warning'); ?>
<?php endif; ?>
<div class="container">
    <?php if (!empty($_SESSION['user'])): ?>
        <form action="/comments/add" method="post">
            <div class="mb-3">
                <label for="content" class="form-label">Add commentary</label>
                <textarea name="content" class="form-control" id="content"
                          rows="2"><?php echo $_SESSION['default_value']['comment'] ?? '' ?></textarea>
                <?php unset($_SESSION['default_value']); ?>
                <?php if (!empty($_SESSION['validate']['content'])): ?>
                    <div id="content"
                         class="form-text text-danger"> <?php echo $_SESSION['validate']['content']; ?> </div>
                    <?php unset($_SESSION['validate']['content']); ?>
                <?php endif; ?>
            </div>
            <button type="submit" name="id_article" value="<?php echo $_GET['id']; ?>" class="btn btn-primary">Add
                commentary
            </button>
        </form>
    <?php else: ?>
        You are not authorized! Please authorise for left a comments!
    <?php endif; ?>
    <br> <br>
    Comments: <br> <br>
    <?php if (!empty($warning)): ?>
        <?php echo \nl2br($warning); ?>
    <?php else: ?>
        <?php foreach ($comments as $comment): ?>
            Author: <a
                    href="/users/profile?id=<?php echo $comment['id_user']; ?>"><?php echo $comment['first_name']; ?></a>
            <br>
            Comment: <?php echo $comment['content']; ?> <br>
            <?php if ((!empty($_SESSION['user'])) && (($_SESSION['user']['id'] === $comment['id_user']) || ($_SESSION['user']['role'] === '1'))): ?>
                <a href="/comments/delete?id=<?php echo $comment['id_comment']; ?>">Delete</a>
            <?php endif; ?><br><br>
        <?php endforeach; ?>
    <?php endif; ?>
    <br>
</div>
<?php require_once __DIR__ . '/../pagination.php'; ?>
