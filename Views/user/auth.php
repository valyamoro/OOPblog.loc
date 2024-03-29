<div class="container">
    <?php if (!empty($_SESSION['warning'])): ?>
        <?php displayMessages('warning'); ?>
    <?php endif; ?>
    <h1>Authentication</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                   value="<?php echo $_POST['email'] ?? ''; ?>" required>
            <?php if (isset($validate['email'])): ?>
                <div id="email" class="form-text text-danger"> <?php echo $validate['email']; ?> </div>
            <?php else: ?>
                <div id="email" class="form-text">We'll never share your email with anyone else.</div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password"
                   aria-describedby="password_confirm" required>
            <?php if (isset($validate['password'])): ?>
                <div id="password" class="form-text text-danger"> <?php echo $validate['password']; ?> </div>
            <?php else: ?>
                <div id="password" class="form-text">We'll never share your password with anyone else.</div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Auth</button>
    </form>
</div>
