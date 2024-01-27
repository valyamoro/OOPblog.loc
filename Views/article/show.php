<?php if ($_SESSION['user']['id'] !== $article['id_user'] || $_SESSION['user']['role'] !== '1'): ?>
    <a href="<?php echo "/articles/edit?id={$article['id']}"; ?>">Edit</a> <br><br>
<?php endif; ?>
<?php echo $article['id']; ?> <br>
<?php echo $article['title']; ?> <br>
<?php echo $article['content']; ?> <br>
<br>
<?php if (!empty($_SESSION['success'])): ?>
    <?php echo nl2br($_SESSION['success']); ?>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['warning'])): ?>
    <?php echo nl2br($_SESSION['warning']); ?>
    <?php unset($_SESSION['warning']); ?>
<?php endif; ?>
<div class="container">
    <?php if (!empty($_SESSION['user'])): ?>
        <form action="/comments/add" method="post">
            <div class="mb-3">
                <label for="content" class="form-label">Add commentary</label>
                <textarea name="content" class="form-control" id="content" rows="2"></textarea>
                <?php if (isset($_SESSION['validate']['content'])): ?>
                    <div id="content"
                         class="form-text text-danger"> <?php echo $_SESSION['validate']['content'][0]; ?> </div>
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
        <?php unset($warning); ?>
    <?php else: ?>
        <?php foreach ($comments as $comment): ?>
            Author: <?php echo $comment['firstName']; ?> <br>
            Comment: <?php echo $comment['content']; ?> <br>
            <br>
        <?php endforeach; ?>
    <?php endif; ?>
    <br>
</div>
