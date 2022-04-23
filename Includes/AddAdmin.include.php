<?php
//?  We Check With (isset) If The Update Button was clicked We Get The Data With The Global POST Method

if (isset($_POST["Add"]))
  {    
    //! We Rquire The DATABASE Connection Page So we Can Have Access To Our SQL
    require_once 'dbh.include.php';
    require_once 'Users.php';
    $db       = new dbClass();
    $name      = $_POST["name"];
    $email     = $_POST["email"];
    $username  = $_POST["uid"];
    $pwd       = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    
    $SignUpUser = new User();
    $SignUpUser->users($name, $email, $username, $pwd, $pwdRepeat);
    
    if (empty($name)) {
      header("location: ../AddAdmin.php?Error=PleaseEnterName");
      exit();
  }
  if (empty($username)) {
      header("location: ../AddAdmin.php?Error=PleaseEnterUserName");
      exit();
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("location: ../AddAdmin.php?Error=PleaseEnterValidEmail");
      exit();
  }
  if (empty($pwd)) {
      header("location: ../AddAdmin.php?Error=PleaseEnterPassword");
      exit();
  }
  if ($pwd !== $pwdRepeat) {
      header("location: ../AddAdmin.php?Error=PasswordDosentMatch");
      exit();
  }
  
  $result=$db->UidExistsAdmin($SignUpUser);
  if ($result) {
    header("location: ../AddAdmin.php?Error=AdminAlreadyExists");
    exit();
   } 

   $result=$db->CreateAdmin($SignUpUser);
   if($result== 'Success')
   {
    header("location: ../includes/logout.include.php?Status=AdminAdded");
    exit();
   }
   if($result== 'Failed')
   {
    header("location: ../AddAdmin.php?Error=Admin-Was-Not-Added");
    exit();
   }





  }

?>