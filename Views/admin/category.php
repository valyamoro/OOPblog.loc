<script>
    (function () {
        window.history.replaceState({}, document.title, window.location.pathname);
    })();
</script>

<?php if (!empty($warning)): ?>
<?php echo \nl2br($warning); ?>
<?php endif; ?>
<?php if (isset($_GET['category_added']) && $_GET['category_added'] === 'true'): ?>
<div class="уведомление">Category was successful added!</div>
<?php endif; ?>
<?php if (isset($_GET['category_added']) && $_GET['category_added'] === 'false'): ?>
    <div class="уведомление">Category was not added!</div>
<?php endif; ?>
<div class="container">
    <h1>Create category</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title article</label>
            <input type="text" name="title" class="form-control" id="title"
                   aria-describedby="title">
        </div>
        Choose a parent category: <br>
        <label for="category"></label><select name="category" id="category">
            <option value="0">Without a parent category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['title']; ?></option>
            <?php endforeach; ?>
        </select> <br><br>
        <button type="submit" class="btn btn-primary">Create category</button>
    </form>
</div>