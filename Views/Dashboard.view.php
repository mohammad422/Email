<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        input[type=email] {
            width: 100%;
            padding: 10px;
        }

        textarea {
            width: 100%;
            height: 200px;
        }
        a{
            text-decoration: none;
            padding: 5px;
            border:1px solid black;
            border-radius: 3px;
        }
    </style>
</head>
<body>
<a href="../Controllers/Signout.controller.php">Log Out</a>
<a href="../Controllers/Inbox.controller.php">Inbox</a>
<a href="../Controllers/Sent.controller.php">Sent</a>
<div style="width:60%;margin-left: auto;margin-right: auto;margin-bottom: 20px; border:1px solid black;border-radius: 5px;padding: 5px;background-color: aquamarine;">
    <form method="post" action="../Controllers/Dashboard.controller.php" enctype="multipart/form-data">
        <p>
            <label>From</label>
            <input type="email" name="from">
        </p>
        <p>
            <label>To</label>
            <input type="email" name="to">
        </p>
        <p>
            <label>Message</label>
            <textarea name="message"></textarea>
        </p>
        <p>
            <label>File</label>
            <input type="file" name="file">
        </p>

        <input type="submit">
    </form>
</div>

</body>
</html>

