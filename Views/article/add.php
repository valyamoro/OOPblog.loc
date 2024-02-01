<?php if (!empty($_SESSION['message'])): ?>
    <?php displayMessages('message'); ?>
<?php endif; ?>
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
        <label for="id_category"></label><select name="id_category" id="id_category">
            <option value="0">Chose category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['title']; ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($validate['option'])): ?>
            <div id="content" class="form-text text-danger"> <?php echo $validate['option']; ?> </div>
        <?php endif; ?>
        <br>
        <div class="mb-3">
            <label for="image" class="form-label">Изображение</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>
        <?php if (isset($validate['image'])): ?>
            <div id="content" class="form-text text-danger"> <?php echo $validate['image'][0]; ?> </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Create article</button>
    </form>
</div>