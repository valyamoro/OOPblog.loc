<?php if (!empty($_SESSION['message'])): ?>
<?php echo \nl2br($_SESSION['message']); ?>
<?php unset($_SESSION['message']); ?>
<?php endif;?>
<div class="container">
    <h1>Create article</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title article</label>
            <input type="text" name="title" class="form-control" id="title"
                   aria-describedby="title">
            <?php if (isset($validate['title'])): ?>
                <div id="title" class="form-text text-danger"> <?php echo $validate['title'][0]; ?> </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Article Content</label>
            <textarea name="content" class="form-control" id="content" rows="8"></textarea>
            <?php if (isset($validate['content'])): ?>
                <div id="content" class="form-text text-danger"> <?php echo $validate['content'][0]; ?> </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Изображение</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>
        <button type="submit" class="btn btn-primary">Create article</button>
    </form>
</div>