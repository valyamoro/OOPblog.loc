<div class="container">
    <?php if (!empty($_SESSION['warning'])): ?>
        <?php echo '<p class="msg"> ' . nl2br($_SESSION['warning']) . ' </p>'; ?>
        <?php unset($_SESSION['warning']); ?>
    <?php endif; ?>
    <h1>Edit article</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Title article</label>
            <input type="text" name="title" class="form-control" id="title"
                   aria-describedby="title">
            <?php if (isset($_SESSION['validate']['title'])): ?>
                <div id="title" class="form-text"> <?php echo $_SESSION['validate']['title'][0]; ?> </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Article Content</label>
            <textarea name="content" class="form-control" id="content" rows="8"></textarea>
            <?php if (isset($_SESSION['validate']['content'])): ?>
                <div id="password" class="form-text"> <?php echo $_SESSION['validate']['content'][0]; ?> </div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Create article</button>
    </form>
</div>