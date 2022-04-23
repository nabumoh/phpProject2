<?php
//?  We Check With (isset) If The Submit Button was clicked We Get The Data With The Global POST Method


if (isset($_POST["submit"]))
{
    require_once 'dbh.include.php';
    require_once 'Users.php';
    $db = new dbClass();
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $SignUpUser = new User();
    $SignUpUser->users($name, $email, $username, $pwd, $pwdRepeat);

    if (empty($name))
    {
        header("location: ../PHPinVisualStudioCode/Register.php?Error=PleaseEnterName");
        exit();
    }
    if (empty($username))
    {
        header("location: ../PHPinVisualStudioCode/Register.php?Error=PleaseEnterUserName");
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("location: ../PHPinVisualStudioCode/Register.php?Error=PleaseEnterValidEmail");
        exit();
    }
    if (empty($pwd))
    {
        header("location: ../PHPinVisualStudioCode/Register.php?Error=PleaseEnterPassword");
        exit();
    }
    if ($pwd !== $pwdRepeat)
    {
        header("location: ../PHPinVisualStudioCode/Register.php?Error=PasswordDosentMatch");
        exit();
    }
    if ($db->UidExistsAdmin($SignUpUser))
    {

        header("location: ../PHPinVisualStudioCode/Register.php?Error=AdminAlreadyExist");
        exit();
    }
    if ($db->UidExists($SignUpUser))
    {

        header("location: ../PHPinVisualStudioCode/Register.php?Error=UserNameAlreadyExist");
        exit();
    }

    else
    {
        $result = $db->CreateUser($SignUpUser);
        if ($result == 'Success')
        {
            echo "<script>alert('Your Acount Request Is Now Pending For Approval. Please Wait For Confirmation. Thank You! ') </script>";

        }
        else if ($result == 'Failed'){
         echo "<script>alert('Unknown Error Occured!')  </script>";
       
        }
    }
}    

?>