<?php foreach ($items as $item): ?>
    <a href="<?php echo "/articles/show?id={$item['id']}"; ?>"><?php echo $item['title']; ?></a><br>
    <button type="button" class="btn btn-danger">Delete</button>
    <button type="button" class="btn btn-success">Approve</button>
    <br><br>
<?php endforeach; ?>
