<?php if (isset($_SESSION['warning'])): ?>
    <?php echo \nl2br($_SESSION['warning']); ?>
    <?php unset($_SESSION['warning']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['success'])): ?>
    <?php echo \nl2br($_SESSION['success']); ?>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<div class="container">
    <h1>Create category</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title article</label>
            <input type="text" name="title" class="form-control" id="title"
                   aria-describedby="title">
        </div>
        <label for="category"></label><select name="category" id="category">
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['title']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary">Create category</button>
    </form>
</div>