<?php
if (isset($_POST["login"])) {
    require_once 'dbh.include.php';
    require_once 'Users.php';
    $db = new dbClass();
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $SignInUser = new User();
    $SignInUser->users('', '', $username, $pwd, '');



    if (empty($username)) {
        header("location: ../SignIn.php?Error=PleaseEnterUserName");
        exit();
    }
    if (empty($pwd)) {
        header("location: ../SignIn.php?Error=PleaseEnterPassword");
        exit();
    }


   $result1 = $db->login($SignInUser);
     if($result1 == 'User Success')
     {
     header("location: ../index.php?SignIn=SignInSuccess");
     exit();
     }  
     if($result1 == 'User invalid password') 
     {
        header("location: ../SignIn.php?Error=User-Wrong-Password");
        exit();
     }
     if($result1 == 'Admin Success')
     {
        header("location: ../index.php?SignIn=Welcome-WebSite-Admin");
        exit();
     }
     if($result1 == 'Admin invalid password')
     {
        header("location: ../SignIn.php?Error=Admin-Invalid-Password");
        exit(); 
     }
     else if($result1 == 'invalid email')
     {
        header("location: ../SignIn.php?Error=Invalid-Email");
        exit(); 
     }


    
}


