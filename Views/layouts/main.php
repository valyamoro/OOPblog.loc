<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="/asserts/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/articles">Main page</a>
                </li>
                <?php if (!empty($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/articles/add">Add article</a>
                    </li>
                <?php endif; ?>

                <?php echo $menu; ?>

                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <?php if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === '1'): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/admins/panel">Admin panel</a>
                        </li>
                    <?php endif; ?>
                    <?php if (empty($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/users/auth">Login</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a class="nav-link active" aria-current="page" href="/users/profile">My profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/users/logout">Logout</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/add">Register</a>
                    </li>
                </ul>
                <form name="search" method="post" action="/articles/search">
                    <label>
                        <input type="search" id="search" name="search" placeholder="Поиск"
                               value="<?php echo $_POST['search'] ?? '' ?>">
                    </label>
                    <input type="submit" value="Поиск"/>
                    <?php if (!empty($_SESSION['validate'])): ?>
                        <?php echo \nl2br($_SESSION['validate']['content'][0]); ?>
                        <?php unset($_SESSION['validate']); ?>
                    <?php endif; ?>
                </form>
        </div>
    </div>
</nav>

<div class="container">
    {{content}}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
<body>
</body>

