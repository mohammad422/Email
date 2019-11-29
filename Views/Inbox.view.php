<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inbox</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        .title {
            padding-top: 10px;
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
<div style="width:60%; margin: auto; text-align: center;">
    <h1>inbox</h1>
    <div class="title" style="width:24%"><b>From</b></div>
    <div class="title" style="width:35%"><b>Message</b></div>
    <div class="title" style="width:20%"><b>File</b></div>
    <div class="title" style="width:20%"><b>Date</b></div>
    <?php foreach ($inbox as $mail) : ?>
        <div class="content" style="width:24%"><?= $mail["email"] ?></div>
        <div class="content" style="width:35%"><?= $mail["message"] ?></div>
        <div class="content" style="width:20%"><?= $mail["file"] ?></div>
        <div class="content" style="width:21%"><?= $mail["datepost"] ?></div>
    <?php endforeach; ?>
</div>
</body>
</html>
