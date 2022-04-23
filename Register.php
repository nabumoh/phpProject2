<?php
include 'includes/signup.include.php';
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
        <link rel="stylesheet" href="Stylesheet/Style.css">
        <link rel="stylesheet" href="Stylesheet/register.css?v=<?php echo time(); ?>">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        <title>Sport</title>
</head>

<body>

        <!-- Header -->

        <header>
                <!-- row-->

                <div class="row">
                        <div class="logo">
                                <img src="./image/logo.png" alt="logo">
                        </div>
                        <!-- Main Nav -->

                        <ul class="main-nav">
                                <li><a href="index.php">Home</a></li>



                                <li class='active' 8><a href='Register.php'>Register</a></li>

                                <li><a href='SignIn.php'>SignIn</a></li>


                </div>

        </header>
        <!-- Article-->

        <article>
                <!-- Login box -->

                <div class="loginbox">
                        <!-- Avatar -->
                        <img src="./image/avatar.png" class="avatar" alt="">
                        <h1>Sign Up Here</h1>
                        <!--Form With POST Metohd-->
                        <!--Action("So We can send the data in the form to specifec page")-->
                        <form action="" method="POST">
                                <p>Full Name</p>
                                <!--The NAME Input-->

                                <input type="text" name="name" placeholder="Full Name...">
                                <p>Email</p>
                                <!--The EMAIL Input-->


                                <input type="text" name="email" placeholder="Email...">
                                <p>Username</p>
                                <!--The USERNAME Input-->


                                <input type="text" name="uid" placeholder="Username...">
                                <p>Password</p>
                                <!--The PASSWORD Input-->

                                <input type="password" name="pwd" placeholder="Password...">
                                <p>RePassword</p>
                                <!--The PASSWORD REPEAT Input-->

                                <input type="password" name="pwdrepeat" placeholder="Repeat Password...">
                                <!--The SUBMIT Button-->

                                <button type="submit" name="submit">Signup</button>
                    

                        </form>

                </div>
        </article>


        <!-- Left Side Footer -->

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
                        <!-- Footer Links -->

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