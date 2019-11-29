<?php
require "../Config/Config.php";
//add user into database
function insertuser($name, $email, $username, $password, $img)
{
    global $connection;
    $sql = "INSERT INTO tbl_users (tbl_users.name,tbl_users.email,tbl_users.username,tbl_users.password,tbl_users.img) 
    VALUES ('$name','$email','$username','$password','$img')";
    mysqli_query($connection, $sql);
    mysqli_close($connection);
}
function getusername($name,$value)
{
    global $connection;
    #a querry for get all books
    $sql = "SELECT * FROM tbl_users WHERE $name = '$value'";
    $result = mysqli_query($connection, $sql);
    // $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $user= mysqli_fetch_assoc($result);
    return $user;
}
//get user by username and password
function getUser($username, $password)
{
    global $connection;

    $sql = "SELECT * FROM tbl_users WHERE username='$username' AND password = '$password'";
    $result = mysqli_query($connection, $sql);
    $user = mysqli_fetch_assoc($result);

    return $user; // return user
}

#if a username is exist or not
function userExist($username)
{

    global $connection;
    global $errors;

    $sql = "SELECT * FROM tbl_users WHERE username = '$username'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_all($result);
    mysqli_free_result($result);

    if (count($row) > 0) {

        $errors[] = "This username has been taken before.";
        return false;
    }
    return true;
}

#if an email is exist or not
function emailExist($email)
{

    global $connection;
    global $errors;

    $sql = "SELECT * FROM tbl_users WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_all($result);
    mysqli_free_result($result);

    if (count($row) > 0) {

        $errors[] = "This email has been taken before.";
        return false;
    }

    return true;

}

# if email and username exist or not
function emailAndUserExist($username, $email)
{
    return (userExist($username) & emailExist($email));
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * authenticate user
 *
 * @param $username
 * @param $password
 * @return array
 */
//function login($username, $password)
function login($username, $password)
{
    global $connection;

    $sql = "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $sql);
    /* if (mysqli_num_rows($result) < 1) {
         return false;
     }
     $row = mysqli_fetch_assoc($result);
     if (!password_verify($password, $row['password'])) {
         return false;
     }
     return true;*/
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $row['ID'];
    $rememberToken = generateRandomString(20);
    updateCurrentUserRememberToken($rememberToken);
    setcookie('remember', $rememberToken, time() + 3600, '/');
    return $row;
}


/**
 * fetch user data
 *
 * @param $userId
 * @return string[]|null
 */
function fetchUser($userId)
{
    global $connection;
    $sql = "select * from tbl_users where ID ='$userId'";
    $result = mysqli_query($connection, $sql);
    return mysqli_fetch_assoc($result);
}

/**
 * update authenticated user remember token
 *
 * @param $rememberToken
 * @return bool|mysqli_result
 */
function updateCurrentUserRememberToken($rememberToken = null)
{
    global $connection;
    $userId = $_SESSION['user_id'];
    $sql = "UPDATE tbl_users SET remember='$rememberToken' WHERE ID ='$userId'";
    return mysqli_query($connection, $sql);
}


function authenticateUserByCookie()
{
    global $connection;
    $rememberToken = $_COOKIE['remember'];
    $sql = "SELECT ID FROM tbl_users WHERE remember='$rememberToken'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) < 1) {
        return;
    }
    $user = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $user['ID'];
}
