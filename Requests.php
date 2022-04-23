<?php
/*session_start() This Will start the sessionin the 
login user se we can identify the user who logged in*/
session_start();
//If We Clicked The Button Accept EveryThing In The If STATEMENT Will EXECUTE
if (isset($_POST["Accept"]))
{
    require_once 'includes/dbh.include.php';
    //? Identefier For The dbClass So We Can Use It
    $db        = new dbClass();
    // Calling The Function In The DataBase File And Return The Data As An Array
    $UserResult =$db-> showAllUsers();
    //! We Put The DATA In A NEW Variable So We Can Use It 
    $userName= $UserResult[0]['requests_Name'];
    $userEmail= $UserResult[0]['requests_Email'];
    $userUid= $UserResult[0]['requests_Uid'];
    $userPwd= $UserResult[0]['requests_Pwd'];
    $SignInUser = new User();
    // SEND The DATA To The User Class So We Can Call It Later In The dbClass Page
    $SignInUser->users( $userName,  $userEmail, $userUid, $userPwd, '');
    // Calling The Accept Request Function
    $result =$db->AcceptRequest($SignInUser);
    //? If The RESULT The Has Been Returned From The Function WERE TRUE
    //? Then It Will Show As A Good Alert Message OtherWise ERROR 
    if($result)
    {
        echo "<script>alert('Account Request Has Been Accepted!!! ') </script>";

    }
    else{
        echo "<script>alert('Unknown Error Occured!')  </script>";
    }


}
//If We Clicked The Button DECLINE EveryThing In The If STATEMENT Will EXECUTE
if (isset($_POST["Decline"]))
{
    require_once 'includes/dbh.include.php';
     //? Identefier For The dbClass So We Can Use It
    $db        = new dbClass();
    // Calling The Function In The DataBase File And Return The Data As An Array
    $UserResult =$db-> showAllUsers();
    //! We Put The DATA In A NEW Variable So We Can Use It 
    $userUid= $UserResult[0]['requests_Uid'];
    $SignInUser = new User();
    // SEND The DATA To The User Class So We Can Call It Later In The dbClass Page
    $SignInUser->users( '',  '', $userUid, '', '');
     // Calling The Reject Request Function
    $result =$db->RejectRequest($SignInUser);
    //? If The RESULT The Has Been Returned From The Function WERE TRUE
    //? Then It Will Show As A Good Alert Message OtherWise ERROR 
    if($result)
    {
        echo "<script>alert('Account Request Has Been Rejected!!! ') </script>";

    }
    else{
        echo "<script>alert('Unknown Error Occured!')  </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./Stylesheet/Style.css">
    <link rel="stylesheet" href="./Stylesheet/Requests.css?v=<?php echo time(); ?>">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Sport</title>
</head>

<body>
    <!-- Header-->

    <header>
        <div class="row">
            <div class="logo">
                <img src="./image/logo.png" alt="logo">
            </div>
            <!-- Main nav-->

            <ul class="main-nav">
                <li><a href="index.php">Home</a></li>
              <!-- PHP-->

                <?php
                // If The USER Who Logged In Is An Admin Then We Change The Navbar To Somthing So The Admin Can Access It
                   if (isset($_SESSION["UserAdmin"]))
                   {
                  
                     echo "<li><a href='AddAdmin.php'>Add New Admin</a></li>";
                     echo "<li class='active'><a href='Requests.php'>Requests</a></li>";
                     echo "<li><a href='includes/logout.include.php'>SignOut</a></li>";
                  
                   }
                   else
                   {
                       echo " <li><a href='Register.php'>Register</a></li>";
                   
                       echo " <li><a href='SignIn.php'>SignIn</a></li>";
                   }

                  ?>
            </ul>
        </div>
        <div class="title"> 
         <!-- Form Method POST-->

        <form action="" method="POST">
        <?php
        // If The USER Who Logged In Is An Admin Then We Change The Navbar To Somthing So The Admin Can Access It
        if(isset($_SESSION["UserAdmin"])){
            require_once 'includes/dbh.include.php';
            $db = new dbClass();
            // Calling To ShowAllUsers Function To Check If There Is Any New Requests
            $result =$db-> showAllUsers();
            echo "<h1> Welcome WebSite Admin ;)</h1>";
            if($result > 0)
            {
            echo "<h2>".$result[0]["requests_Message"]."</h2>";
                echo  ' <div class="button">';
                echo'<button type="decline" name="Decline" class="btn btn-two" >Decline Request</button>';
                echo '<button  type="accept" name="Accept" class="btn btn-one" >Accept Request</button></div>';
                echo "<h3>".$result[0]["requests_Date"]."</h3>";
            }  
            //If The ShowAllUsers Have No NEW Requests Then We Print This Down Below
             else 
             echo "<h3>No Pending Requests...</h3>";

            
        }else  echo "<h1>Welcome to my Fitness website</h1>";?>
            
            </form>
            <!-- Button link -->

            

        </div>


    </header>


    <footer class="footer-distributed">
        <!-- Right Side Footer -->

        <div class="footer-right">

            <a href="https://www.facebook.com/1mhmdhuss" target="blank"><i class="fa fa-facebook"></i></a>
            <a href="https://www.instagram.com/mhmdhus22/" target="blank"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-github"></i></a>

        </div>
        <!-- Left Side Footer -->

        <div class="footer-left">

            <p class="footer-links">
                <a href="index.php">Home</a>

                <a href="Register.php">Register</a>

                <a href="SignIn.php">SignIn</a>

            </p>

            <p>Mohammad hussien Victor Awes  &copy; 2020</p>
        </div>

    </footer>
</body>

</html>