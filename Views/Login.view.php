
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<div class="limiter">
    <form method="post" action="../Controllers/Login.controller.php">
					<span class="login100-form-title p-b-70">
						Please Enter Your Credentials
					</span>

        <div>
            <input class="input100" type="text" name="username">

        </div>

        <div>
            <input class="input100" type="password" name="password">

        </div>

        <div>
            <button >
                Login
            </button>
        </div>

        <?php if (isset($_SESSION['error'])) : ?>
            <p class="login-error"><?= $_SESSION['error'] ?></p>
        <?php endif ?>
    </form>
</div>

</body>
</html>
<?php
unset($_SESSION["error"]);
?>
