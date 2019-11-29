<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
</head>
<body>
<!--create a form-->
<form method="post" action="../Controllers/Signup.controller.php" enctype="multipart/form-data">
    <p>
        <label>Name:</label>
        <input type="text" name="name" >
        <!--add the error if name is empty-->
        <span><?php if(isset($nameErr)) {echo $nameErr; }?></span>
    </p>
    <p>
        <label>Email:</label>
        <input type="text" name="email">
        <!--add the error if email is empty or has a wrong pattern-->
        <span><?php if(isset($emailErr)) {echo $emailErr; }?></span>
    </p>
    <p>
        <label>UserName:</label>
        <input type="text" name="username">
        <!--add the error if username is empty or exist before-->
        <span><?php if(isset($usernameErr)) {echo $usernameErr; }?></span>
        <span><?php if(isset($userErr)) {echo $userErr; }?></span>
    </p>
    <p>
        <label>Password:</label>
        <input type="text" name="password">
        <!--add the error if password is empty-->
        <span><?php if(isset($passwordErr)) {echo $passwordErr; }?></span>
    </p>
    <!--add the error if image is empty-->
    <span><?php if(isset($imgErr)) {echo $imgErr; }?></span>
    <p>
        <label>Image:</label>
        <input type="file" name="img">
    </p>
    <input type="submit" name="btn">
</form>
<div>
    <?php if (count($errors) >= 1): ?>
        <?php foreach ($errors as $error): ?>
            <p class="error"> <?= $error ?> </p>
        <?php endforeach; ?>
    <?php elseif ($flag): ?>
        <p class="success">You Signed Up Successfully</p>
    <?php endif; ?>
</div>
</body>
</html>

