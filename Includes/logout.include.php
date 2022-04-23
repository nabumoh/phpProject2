<?php 
//! Session_start Will Start The Session We Wrote In The Login function And We Use It
//! So We Can Identify That Specific UserName That LogedIn And This Page Is Used So We
//! Can Unset And Destroy This Session In The Time We LogOut From The UserName...
session_start();
session_unset();
//? If The Session Is Destroyed We Go To (Index.php) Home Page
session_destroy();
header("location: ../index.php");
exit();

?>