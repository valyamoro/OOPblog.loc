<div class="container">
    <?php if (!empty($_SESSION['warning'])): ?>
        <?php displayMessages('warning'); ?>
    <?php endif; ?>
    <?php if (!empty($warning)): ?>
        <?php echo '<p class="msg"> ' . \nl2br($warning) . ' </p>'; ?>
    <?php endif; ?>
    <h1>Registration user</h1>
    <form action="" method="post">
        <div class="row">
            <div class="col">

                <div class="mb-3">
                    <label for="firstName" class="form-label">Firstname</label>

                    <input type="text" name="firstName" class="form-control" id="firstName"
                           aria-describedby="firstName" value="<?php echo $_POST['firstName'] ?? '' ?>" required>
                    <?php if (isset($validate['firstName'])): ?>
                        <div id="firstName"
                             class="form-text text-danger"> <?php echo $validate['firstName']; ?> </div>
                    <?php else: ?>
                        <div id="firstName" class="form-text">We'll never share your firstName with anyone else</div>
                    <?php endif; ?>

                </div>

            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="lastName" class="form-label">Lastname</label>
                    <input name="lastName" class="form-control" id="lastName" aria-describedby="lastName"
                           value="<?php echo $_POST['lastName'] ?? '' ?>" required>
                    <?php if (isset($validate['lastName'])): ?>
                        <div id="lastName" class="form-text text-danger"> <?php echo $validate['lastName']; ?> </div>
                    <?php else: ?>
                        <div id="lastName" class="form-text">We'll never share your lastName with anyone else.</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="Patronymic" class="form-label">Patronymic</label>
                    <input name="patronymic" class="form-control" id="Patronymic" aria-describedby="patronymic"
                           value="<?php echo $_POST['patronymic'] ?? '' ?>" required>
                    <?php if (isset($validate['patronymic'])): ?>
                        <div id="patronymic" class="form-text text-danger"> <?php echo $validate['patronymic']; ?>
                        </div>
                    <?php else: ?>
                        <div id="patronymic" class="form-text">We'll never share your patronymic with anyone else.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="email"
                       value="<?php echo $_POST['email'] ?? '' ?>" required>
                <?php if (isset($validate['email'])): ?>
                    <div id="email" class="form-text text-danger"> <?php echo $validate['email']; ?> </div>
                <?php else: ?>
                    <div id="email" class="form-text">We'll never share your email with anyone else.</div>
                <?php endif; ?>
            </div>
            <div class="col">
                <label for="phoneNumber" class="form-label">Phone number</label>
                <input type="text" name="phoneNumber" class="form-control" id="phoneNumber"
                       aria-describedby="phoneNumber"
                       value="<?php echo $_POST['phoneNumber'] ?? '' ?>" required>
                <?php if (isset($validate['phoneNumber'])): ?>
                    <div id="password" class="form-text text-danger"> <?php echo $validate['phoneNumber']; ?> </div>
                <?php else: ?>
                    <div id="phoneNumber" class="form-text">We'll never share your phone number with anyone else.</div>
                <?php endif; ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" aria-describedby="password"
                       required>
                <?php if (isset($validate['password'])): ?>
                    <div id="password" class="form-text text-danger"> <?php echo $validate['password']; ?> </div>
                <?php else: ?>
                    <div id="password" class="form-text">We'll never share your password with anyone else.</div>
                <?php endif; ?>
            </div>
            <div class="col">
                <label for="passwordConfirm" class="form-label">Confirm your password</label>
                <input type="password" name="passwordConfirm" class="form-control" id="passwordConfirm"
                       aria-describedby="passwordConfirm" required>
                <?php if (isset($validate['passwordConfirm'])): ?>
                    <div id="passwordConfirm"
                         class="form-text text-danger"> <?php echo $validate['passwordConfirm']; ?> </div>
                <?php else: ?>
                    <div id="password" class="form-text">We'll never share your password with anyone else.</div>
                <?php endif; ?>
            </div>
        </div>
        <br>

        <button type="submit" name="role" value="0" class="btn btn-primary">Registry</button>
        <?php if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === '1'): ?>
            <button type="submit" name="role" value="1" class="btn btn-danger">Registry like admin</button>
        <?php endif; ?>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
