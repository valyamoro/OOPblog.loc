<div class="container">
    <?php if (!empty($_SESSION['warning'])): ?>
        <?php echo '<p class="msg"> ' . nl2br($_SESSION['warning']) . ' </p>'; ?>
        <?php unset($_SESSION['warning']); ?>
    <?php endif; ?>
    <h1>Registration</h1>
    <form action="" method="post">
        <div class="row">
            <div class="col">

                <div class="mb-3">
                    <label for="firstName" class="form-label">Firstname</label>

                    <input type="text" name="firstName" class="form-control" id="firstName"
                           aria-describedby="firstName">
                    <?php if (isset($_SESSION['validate']['firstName'])): ?>
                        <div id="firstName"
                             class="form-text"> <?php echo $_SESSION['validate']['firstName'][0]; ?> </div>
                    <?php else: ?>
                        <div id="firstName" class="form-text">We'll never share your firstName with anyone else</div>
                    <?php endif; ?>

                </div>

            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="lastName" class="form-label">Lastname</label>
                    <input name="lastName" class="form-control" id="lastName" aria-describedby="lastName"></input>
                    <?php if (isset($_SESSION['validate']['lastName'])): ?>
                        <div id="lastName"
                             class="form-text"> <?php echo $_SESSION['validate']['lastName'][0]; ?> </div>
                    <?php else: ?>
                        <div id="lastName" class="form-text">We'll never share your lastName with anyone else.</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="Patronymic" class="form-label">Patronymic</label>
                    <input name="patronymic" class="form-control" id="Patronymic" aria-describedby="patronymic"></input>
                    <?php if (isset($_SESSION['validate']['patronymic'])): ?>
                        <div id="patronymic"
                             class="form-text"> <?php echo $_SESSION['validate']['patronymic'][0]; ?> </div>
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
                <input type="email" name="email" class="form-control" id="email"
                       aria-describedby="emailHelp">
                <?php if (isset($_SESSION['validate']['email'])): ?>
                    <div id="email" class="form-text"> <?php echo $_SESSION['validate']['email'][0]; ?> </div>
                <?php else: ?>
                    <div id="email" class="form-text">We'll never share your email with anyone else.</div>
                <?php endif; ?>
            </div>
            <div class="col">
                <label for="phoneNumber" class="form-label">Phone number</label>
                <input type="text" name="phoneNumber" class="form-control" id="phoneNumber"
                       aria-describedby="emailHelp">
                <?php if (isset($_SESSION['validate']['phoneNumber'])): ?>
                    <div id="phoneNumber" class="form-text"> <?php echo $_SESSION['validate']['phoneNumber'][0]; ?> </div>
                <?php else: ?>
                    <div id="phoneNumber" class="form-text">We'll never share your phone number with anyone else.</div>
                <?php endif; ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password"
                       aria-describedby="password_confirm">
                <?php if (isset($_SESSION['validate']['password'])): ?>
                    <div id="password" class="form-text"> <?php echo $_SESSION['validate']['password'][0]; ?> </div>
                <?php else: ?>
                    <div id="password" class="form-text">We'll never share your password with anyone else.</div>
                <?php endif; ?>
            </div>
            <div class="col">
                <label for="passwordConfirm" class="form-label">Confirm your password</label>
                <input type="password" name="passwordConfirm" class="form-control" id="passwordConfirm"
                       aria-describedby="passwordConfirm">
                <?php if (isset($_SESSION['validate']['passwordConfirm'])): ?>
                    <div id="password" class="form-text"> <?php echo $_SESSION['validate']['passwordConfirm'][0]; ?> </div>
                <?php else: ?>
                    <div id="password" class="form-text">We'll never share your password with anyone else.</div>
                <?php endif; ?>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Registry</button>
    </form>
</div>
<?php unset($_SESSION['validate']) ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
