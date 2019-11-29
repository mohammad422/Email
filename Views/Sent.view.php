<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sent</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        .title {
        /padding-top: 10px;
            height: 40px;

            border: 1px solid black;
            float: left;
            text-align: center;
        }

        .content {
            padding-top: 10px;
            height: 75px;

            border: 1px solid black;
            float: left;
            text-align: center;
        }
        </style>
</head>
<body>
<div style="width:70%; margin-left: auto;margin-right: auto;margin-bottom: 20px;height:500px;  text-align: center;">
    <h1>Sent</h1>
    <div class="title" style="width:29%"><b>To</b></div>
    <div class="title" style="width:30%"><b>Message</b></div>
    <div class="title" style="width:20%"><b>File</b></div>
    <div class="title" style="width:21%"><b>Date</b></div>
    <?php foreach ($emails as $email) : ?>
        <div class="content" style="width:12%">
            <?php if (isset($email["username"])): ?>
                <?= $email["username"] ?>
            <?php else : ?>
                <?= "this username is not found" ?>
            <?php endif; ?>
        </div>
        <div class="content" style="width:17%"><?= $email["uname"] ?></div>
        <div class="content" style="width:30%"><?= $email["message"] ?></div>
        <div class="content" style="width:20%"><?= $email["file"] ?></div>
        <div class="content" style="width:21%"><?= $email["datepost"] ?></div>
    <?php endforeach; ?>
</div>
</body>
</html>