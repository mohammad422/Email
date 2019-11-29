<?php
#for names with " ";
function multiName($name)
{
    $pos = strpos($name, " ");
    if ($pos === false) {
        return $name;//it remains a string
    } else {
        $name = explode(" ", $name);//it converts to an array
        return $name;
    }
}

# checking if all the required fields are filled
function fieldFill()
{
    global $errors;
    $fill = !empty($_POST["name"]) &&  !empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["password"] && !empty($_FILES["img"]["name"]));
    if ($fill) {
        return true;
    } else {
        $errors[] = "Please fill all the necessary fields";
        return false;
    }
}
#check for name, family and city Names
function validName($name)
{
    global $errors;
    $regex = "/^([a-zA-Z' ]+)$/";
    if (!preg_match($regex, trim($_POST[$name]))) {
        $errors[] = "Please Enter a Valid " . $name;
        return false;

    } else {
        return true;
    }
}
#check for email pattern
function validEmail()
{
    global $errors;
    $regex = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/";
    if (!preg_match($regex, $_POST["email"])) {
        $errors[] = "Please Enter a Valid Email";
        return false;
    } else {
        return true;
    }
}

#check for username pattern
function validUsername()
{
    global $errors;
    /*
     * Username only can have alphabets,numbers,"." and "_"
     * Username can't have "." and "_" at the beginning or end of it.
     * Username size is between 5 and 20
     */
    $regex = "/^(?![_.])[a-z\d_.]{5,20}(?<![_.])$/i";
    if (!preg_match($regex, $_POST["username"])) {
        $errors[] = "Your username is not valid";
        return false;
    } else {
        return true;
    }
}


#check if name exists in password
function nameINPass()
{

    global $errors;
    $name = $_POST["name"];
    $password = $_POST["password"];
    $name2 = multiName($name);

    if (is_array($name2)) {

        foreach ($name2 as $value) {

            $validation = stripos($password, $value);
            if ($validation !== false) {

                $errors[] = "your Password can not have your name";
                return false;
            }
        }
        return true;
    } else {

        $validation = stripos($password, $name2);
        if ($validation !== false) {
            $errors[] = "your Password can not have your name";
            return false;
        } else {
            return true;
        }
    }
}


#check if email exists in password
function emailInPass()
{

    global $errors;
    $email = $_POST["email"];
    $password = $_POST["password"];

    # explode emailname and servername
    $email2 = explode("@", $email);
    $email_name = $email2[0];
    $validation = stripos($password, $email_name);

    if ($validation !== false) {

        $errors[] = "your Password can not have your email username";
        return false;
    } else {

        return true;
    }
}

#a function consists of all pass functions
function validPassword()
{

    return (nameINPass()  & emailInPass() );
}

## check all the fields are valid
function validateAll()
{

    return (validName("name")  & validEmail() & validUsername() & validPassword());
}