<?php if (!empty($_SESSION['user'])): ?>
<?php $_SESSION['message'] = 'You already authorized!' . "\n"; ?>
<?php \header('Location: /home'); ?>
<?php endif; ?>
<div class="container">
    <?php if (!empty($_SESSION['warning'])): ?>
        <?php echo '<p class="msg"> ' . \nl2br($_SESSION['warning']) . ' </p>'; ?>
        <?php unset($_SESSION['warning']); ?>
    <?php endif; ?>
    <h1>Authentication</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email"
                   aria-describedby="emailHelp">
            <?php if (isset($validate['email'])): ?>
                <div id="email" class="form-text text-danger"> <?php echo $validate['email']; ?> </div>
            <?php else: ?>
                <div id="email" class="form-text">We'll never share your email with anyone else.</div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password"
                   aria-describedby="password_confirm">
            <?php if (isset($validate['password'])): ?>
                <div id="password" class="form-text text-danger"> <?php echo $validate['password']; ?> </div>
            <?php else: ?>
                <div id="password" class="form-text">We'll never share your password with anyone else.</div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Auth</button>
    </form>
</div>