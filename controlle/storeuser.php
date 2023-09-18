<?php
session_start();
include "../badabas/env.php";
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$email= $_REQUEST['email'];
$password = $_REQUEST['password'];
$encpassword = password_hash($password, PASSWORD_BCRYPT); 
$confirmpassword = $_REQUEST['confirmpassword'];
$errors = [];


if (empty($fname)){
    $errors['$fname_error'] = "your fastname is missing";
}

if (empty($lname)){
    $errors['$lname_error'] = "your lastname is missing";
}
if (empty($email)){
    $errors['$email_error'] = "your email is missing";
}
else if ( !filter_var($email, FILTER_VALIDATE_EMAIL)){

    $errors['$email_error'] = "pise enter yor balemail";
}

if (empty($password)){
    $errors['$password_error'] = "your passwoed is missing";

} else if (strlen($password) < 8){

    $errors['$password_error'] = "your passwoed to short";
} else if ($password != $confirmpassword){
    $errors['$password_error'] = "your passwoed dit not match";
}
if ( count($errors) > 0 ){
$_SESSION['register_errors'] = $errors;
header("location: ../backend/register.php");

} else{
    $query = "INSERT INTO users(fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$encPassword')";

    $result  = mysqli_query($conn, $query);
    if($result){
        header("Location: ../backend/login.php");
    }

}
