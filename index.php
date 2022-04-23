<?php
/*session_start() This Will start the sessionin the
 login user se we can identify the user who logged in*/

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./Stylesheet/Style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Stylesheet/index.css?v=<?php echo time(); ?>">
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
                <li class="active"><a href="index.php">Home</a></li>
                <?php   
                    // If The USER Who Logged In Is An Admin Then We Change The Navbar To Somthing So The Admin Can Access It

                      if (isset($_SESSION["UserAdmin"]))
                       {
                        echo "<style>header{background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                            url(./image/BackImage33.jpg)}</style>";
                         echo "<li><a href='AddAdmin.php'>Add New Admin</a></li>";
                         echo "<li><a href='Requests.php'>Requests</a></li>";
                         echo "<li><a href='includes/logout.include.php'>SignOut</a></li>";

                       }
                        // If The USER Who Logged In Is An Regular User Then We Change The Navbar To Somthing So The Regular User Can Access It.

                       else if (isset( $_SESSION['RegularUser']))
                       {
                        echo "<style>header{background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                            url(./image/BackImage22.jpg)}</style>";
                         echo "<li><a href='Report.php'>Report</a></li>";

                        echo "<li><a href='includes/logout.include.php'>SignOut</a></li>";

                       }
                       else
                       {
                           // Else We Print The DEFAULT Way When No One Is LoggedIn.
                    
                           echo " <li><a href='Register.php'>Register</a></li>";
                       
                           echo " <li><a href='SignIn.php'>SignIn</a></li>";
                       }

                ?>
              </ul>
              <div class="title"> 
               <?php if (isset($_SESSION["UserAdmin"]))
               {
                 // If The USER Who Logged In Is An ADMIN Then We Change The Word To Somthing So The Admin Can See It.
                  echo "<h1> Welcome To The WebSite Admin ;)</h1>";
               }
             else  if (isset( $_SESSION['RegularUser']))
                  {
                  // If The USER Who Logged In Is An Regular User Then We Change The Words To Somthing So The Regular User SEE It.
                    echo "<h1> Welcome To The WebSite NewUser :D</h1>";
 
                  }
                  // Else We Print The DEFAULT Way When No One Is LoggedIn.

                  else echo "<h1>Welcome to my website</h1>"; 
                  
                  ?>
                          
            
            <!-- Button link -->

            <div class="button">
                <a href="https://www.youtube.com/watch?v=Kc2R8Z-EqO0" target="blank" class="btn btn-one">Watch
                    vedio</a>
                <a href="https://en.wikipedia.org/wiki/Sport" class="btn btn-two" target="blank">Explore more</a>

            </div>

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

            <p>Mohammad hussien Victor Awes &copy; 2020</p>
        </div>

    </footer>
</body>

</html>
