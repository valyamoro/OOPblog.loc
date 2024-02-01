<div class="container">
    <?php if (!empty($_SESSION['warning'])): ?>
        <?php displayMessages('warning'); ?>
    <?php endif; ?>
    <h1>Edit article</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title article</label>
            <input type="text" value="<?php echo $_SESSION['default_value']['title'] ?>" name="title"
                   class="form-control" id="title"
                   aria-describedby="title">
            <?php if (isset($_SESSION['validate']['title'])): ?>
                <div id="title" class="form-text"> <?php echo $_SESSION['validate']['title'][0]; ?> </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Article Content</label>
            <textarea name="content" class="form-control" id="content"
                      rows="8"><?php echo $_SESSION['default_value']['content']; ?>"</textarea>
            <?php if (isset($_SESSION['validate']['content'])): ?>
                <div id="password" class="form-text"> <?php echo $_SESSION['validate']['content'][0]; ?> </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Изображение</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>
        <button type="submit" class="btn btn-primary">Edit article</button>
    </form>
</div>
